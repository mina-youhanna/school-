import requests
from bs4 import BeautifulSoup
import mysql.connector

# بيانات الاتصال بقاعدة البيانات
db = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
    port=3308,           # إذا كنت تستخدم 3308
    database="school"
)
cursor = db.cursor()

new_testament_books = [
    {"number": 50, "name": "إنجيل متى", "chapters": 28},
    {"number": 51, "name": "إنجيل مرقس", "chapters": 16},
    {"number": 52, "name": "إنجيل لوقا", "chapters": 24},
    {"number": 53, "name": "إنجيل يوحنا", "chapters": 21},
    {"number": 54, "name": "سفر أعمال الرسل", "chapters": 28},
    {"number": 55, "name": "الرسالة إلى أهل رومية", "chapters": 16},
    {"number": 56, "name": "الرسالة الأولى إلى أهل كورنثوس", "chapters": 16},
    {"number": 57, "name": "الرسالة الثانية إلى أهل كورنثوس", "chapters": 13},
    {"number": 58, "name": "الرسالة إلى أهل غلاطية", "chapters": 6},
    {"number": 59, "name": "الرسالة إلى أهل أفسس", "chapters": 6},
    {"number": 60, "name": "الرسالة إلى أهل فيلبي", "chapters": 4},
    {"number": 61, "name": "الرسالة إلى أهل كولوسي", "chapters": 4},
    {"number": 62, "name": "الرسالة الأولى إلى أهل تسالونيكي", "chapters": 5},
    {"number": 63, "name": "الرسالة الثانية إلى أهل تسالونيكي", "chapters": 3},
    {"number": 64, "name": "الرسالة الأولى إلى تيموثاوس", "chapters": 6},
    {"number": 65, "name": "الرسالة الثانية إلى تيموثاوس", "chapters": 4},
    {"number": 66, "name": "الرسالة إلى تيطس", "chapters": 3},
    {"number": 67, "name": "الرسالة إلى فليمون", "chapters": 1},
    {"number": 68, "name": "الرسالة إلى العبرانيين", "chapters": 13},
    {"number": 69, "name": "رسالة يعقوب الرسول", "chapters": 5},
    {"number": 70, "name": "رسالة بطرس الأولى", "chapters": 5},
    {"number": 71, "name": "رسالة بطرس الثانية", "chapters": 3},
    {"number": 72, "name": "رسالة يوحنا الأولى", "chapters": 5},
    {"number": 73, "name": "رسالة يوحنا الثانية", "chapters": 1},
    {"number": 74, "name": "رسالة يوحنا الثالثة", "chapters": 1},
    {"number": 75, "name": "رسالة يهوذا", "chapters": 1},
    {"number": 76, "name": "سفر رؤيا يوحنا", "chapters": 22},
]

for book in new_testament_books:
    book_number = book["number"]      # هذا هو رقم السفر على الموقع (24)
    book_name = book["name"]
    total_chapters = book["chapters"]
    for chapter_number in range(1, total_chapters + 1):
        url = f"https://st-takla.org/Bibles/BibleSearch/showChapter.php?book={book_number}&chapter={chapter_number}"
        response = requests.get(url)
        response.encoding = 'utf-8'
        soup = BeautifulSoup(response.text, 'html.parser')
        chapter_div = soup.find('div', {'id': 'bodytext'})

        if chapter_div:
            chapter_text = chapter_div.get_text(separator='\n', strip=True)
            sql = """
                INSERT INTO new_bible_chapters (book_num, book_name, chapter_text, chapter_number)
                VALUES (%s, %s, %s, %s)
            """
            values = (book_number, book_name, chapter_text, chapter_number)
            cursor.execute(sql, values)
            db.commit()
            print(f"تم حفظ إصحاح {chapter_number} من سفر {book_name} بنجاح!")
        else:
            print(f"لم يتم العثور على نص الإصحاح رقم {chapter_number} من سفر {book_name}!")

print("تم الانتهاء من جميع الأسفار المطلوبة.")
