import requests
from bs4 import BeautifulSoup
import mysql.connector
import time
import json
import re

# إعدادات الاتصال بقاعدة البيانات
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    database="school",
    port=3308,
    charset="utf8mb4"
)
cursor = db.cursor()

base_url = "https://stgeorgesaman.com"
section_url = "https://stgeorgesaman.com/libraries/hymns-library/occasionsandfeasts/nairouz/raising-incense-of-matins-vespers-nairouz/"
headers = {
    "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36"
}

res = requests.get(section_url, headers=headers)
soup = BeautifulSoup(res.text, "html.parser")

# استخرج كل الروابط التي نصها "تصفح اللحن" أو "قراءة والاستماع الي اللحن"
hymn_links = []
for a in soup.find_all('a', href=True):
    text = a.text.strip()
    if "تصفح اللحن" in text or "قراءة والاستماع الي اللحن" in text:
        href = a['href']
        full_url = base_url + href if not href.startswith("http") else href
        if full_url not in hymn_links:
            hymn_links.append(full_url)

for hymn_url in hymn_links:
    print(f"جاري معالجة: {hymn_url}")
    res = requests.get(hymn_url, headers=headers)
    hymn_soup = BeautifulSoup(res.text, "html.parser")

    # اجمع كل العناصر التي تحمل كلاس العنوان
    all_titles = []
    for tag in hymn_soup.find_all(['h1', 'h2', 'div', 'span'], class_="elementor-heading-title"):
        text = tag.get_text(separator=" ", strip=True)
        # تجاهل العناصر الفارغة أو التي تحتوي فقط على رموز أو صور
        if text and len(text) > 1:
            all_titles.append(text)

    # اطبع النتائج لمراجعة ما يتم التقاطه
    for i, t in enumerate(all_titles):
        print(f"all_titles[{i}]: {repr(t)}")

    skip_titles = {"عربي", "قبطي", "قبطي معرب"}

    # تجاهل أول عنوان إذا كان "مكتبة الألحان"
    if all_titles and "مكتبة الألحان" in all_titles[0]:
        all_titles = all_titles[1:]

    # خذ فقط أول عنصرين (العنوان العربي والقبطي)
    while len(all_titles) < 2:
        all_titles.append("")

    title_arabic = all_titles[0]
    title_coptic = all_titles[1]
    coptic_ar_title = ""  # إذا أردت العنوان القبطي المعرب من التايتل

    # بناء العنوان النهائي
    title_lines = [title_arabic, title_coptic]
    title = "\n".join(title_lines)

    # جلب صورة اللحن بشكل أدق
    image_url = None

    # مثال: إذا كانت الصورة داخل ديف بكلاس معين
    image_section = hymn_soup.find("div", class_="hymn-image")
    if image_section:
        img = image_section.find("img")
        if img and img.get("src"):
            image_url = img["src"]

    # إذا لم نجدها، جرب البحث عن أول صورة بعد العنوان
    if not image_url and hymn_soup.find("h1"):
        h1 = hymn_soup.find("h1")
        next_img = h1.find_next("img")
        if next_img and next_img.get("src"):
            image_url = next_img["src"]

    # إذا لم نجدها، fallback إلى أول صورة في الصفحة (كما في الكود القديم)
    if not image_url:
        img = hymn_soup.find("img")
        if img and img.get("src"):
            image_url = img["src"]

    # الصوت
    audio_tag = hymn_soup.find("audio")
    audio_url = audio_tag.find("source")['src'] if audio_tag and audio_tag.find("source") else None

    # فيديو يوتيوب
    youtube_url = None
    iframe = hymn_soup.find("iframe")
    if iframe and "youtube" in iframe.get("src", ""):
        youtube_url = iframe["src"]

    # الهزات (نص أو صورة)
    notation_text = ""
    notation_image_url = None
    notation_section = hymn_soup.find(lambda tag: tag.name in ['div', 'p', 'pre'] and ("هزات" in tag.text or "نغمة" in tag.text))
    if notation_section:
        notation_text = notation_section.text.strip()
        img = notation_section.find("img")
        if img:
            notation_image_url = img['src']

    # المصدر/المرتل
    source = ""
    for li in hymn_soup.find_all("li"):
        if "المرتل" in li.text or "المصدر" in li.text:
            source = li.text.strip()

    # التصنيفات (breadcrumb)
    categories = [x.text.strip() for x in hymn_soup.select('.breadcrumb a')]
    breadcrumb = " > ".join(categories)

    # ابحث عن عنصر فيه كلمة "التصنيف:"
    category = ""
    category_tag = hymn_soup.find(lambda tag: tag.name in ['div', 'span', 'p', 'strong'] and "التصنيف" in tag.text)
    if category_tag:
        text = category_tag.get_text(separator=" ", strip=True)
        if "التصنيف:" in text:
            category = text.split("التصنيف:")[-1].strip()
        else:
            category = text.strip()

    def extract_section_text(soup, section_name):
        for tag in soup.find_all(['h3', 'h4', 'h2']):
            if section_name in tag.text:
                next_tag = tag.find_next(['div', 'p', 'pre'])
                if next_tag:
                    return next_tag.get_text(separator="\n", strip=True)
        return ''

    # نص اللحن عربي/قبطي/قبطي معرب
    arabic = extract_section_text(hymn_soup, "عربي")
    coptic = extract_section_text(hymn_soup, "قبطي")
    coptic_ar = extract_section_text(hymn_soup, "قبطي معرب")

    sql = """
        INSERT INTO hymns
        (title, image_url, breadcrumb, arabic, coptic, coptic_ar, source, url, audio_url, youtube_url, notation_text, notation_image_url, created_at, updated_at)
        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, NOW(), NOW())
    """
    cursor.execute(sql, (
        title,      # هنا الثلاثة مع بعض
        image_url,
        breadcrumb,
        arabic,
        coptic,     # القبطي فقط
        coptic_ar,  # القبطي المعرب فقط
        source,
        hymn_url,
        audio_url,
        youtube_url,
        notation_text,
        notation_image_url
    ))
    db.commit()
    time.sleep(1)

cursor.close()
db.close()