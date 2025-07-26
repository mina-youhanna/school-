# import requests
# from bs4 import BeautifulSoup
# from datetime import date, datetime, timedelta
# import mysql.connector
# import re
# import calendar

# def fetch_seneksar_data(url, gregorian_date):
#     response = requests.get(url)
#     response.encoding = 'utf-8'
#     soup = BeautifulSoup(response.text, 'html.parser')

#     coptic_date = soup.select_one('.badge.bg-tari5')
#     coptic_date = coptic_date.text.strip() if coptic_date else ''

#     # قائمة الخاتمات (يمكنك زيادتها)
#     endings = [
#         "بركة صلواته فلتكن معنا",
#         "بركة صلواتهم فلتكن معنا",
#         "بركة صلواتهما فلتكن معنا",
#         "بركة صلواتها فلتكن معنا",
#         "لربنا المجد دائماً أبدياً آمين",
#         "له المجد في كنيسته إلى الأبد آمين",
#         "له المجد الدائم إلى الأبد آمين",
#         "له المجد والكرامة إلى ابد الآبدين ودهر الدهور امين",
#         "بركة صلواته فلتكن معنا. آمين. و لربنا المجد دائماً أبدياً آمين",
#         "بركة صلواتهم فلتكن معنا. و لربنا المجد دائماً أبدياً آمين",
#         "بركة صلواته فلتكن معنا و لربنا المجد دائماً أبدياً آمين",
#         "بركة صلواتها فلتكن معنا آمين."
#     ]
#     # بناء regex يلتقط أي جملة خاتمة (مع أو بدون نقطة أو آمين)
#     ending_regex = re.compile(r'(' + '|'.join([re.escape(e) for e in endings]) + r')[^\\n]*', re.UNICODE)

#     stories = []
#     saints_divs = soup.select('div[id^=saint]')
#     for saint_div in saints_divs:
#         title_tag = saint_div.find('h3')
#         title = title_tag.text.strip() if title_tag else ''
#         img_tag = saint_div.find('img')
#         image_url = img_tag['src'] if img_tag and img_tag.has_attr('src') else ''
#         paragraphs = [p.text.strip() for p in saint_div.find_all('p') if p.text.strip()]
#         content = ''
#         for p in paragraphs:
#             content += p + '\n'
#             if ending_regex.search(p):
#                 stories.append({
#                     'coptic_date': coptic_date,
#                     'gregorian_date': gregorian_date,
#                     'title': title,
#                     'content': content.strip(),
#                     'image_url': image_url
#                 })
#                 content = ''
#         # لو فيه محتوى متبقي لم يُحفظ (بدون خاتمة)، احفظه كقصة منفصلة (اختياري)
#         if content.strip():
#             stories.append({
#                 'coptic_date': coptic_date,
#                 'gregorian_date': gregorian_date,
#                 'title': title,
#                 'content': content.strip(),
#                 'image_url': image_url
#             })
#     return stories

# def normalize(text):
#     return re.sub(r'[.,،؛:!؟\s]+', '', text)

# endings = [
#     "بركة صلواته فلتكن معنا",
#     "بركة صلواتهم فلتكن معنا",
#     "لربنا المجد دائماً أبدياً آمين",
#     "بركة مخلّصنا الصالح فلتكن معنا. آمين.",
#     "شفاعتها المقدسة فلتكن معنا. آمين.",
#     "شفاعتها المقدسة فلتكن معنا. آمين.",
#     "شفاعته المقدسة فلتكن معنا. آمين."
# ]

# def insert_story_to_db(story):
#     try:
#         conn = mysql.connector.connect(
#             host='localhost',
#             user='root',
#             password='',  # لازم تكون نفس الباسورد بتاعت MySQL عندك
#             database='School',
#             port=3308      # أضف هذا السطر
#         )
#         cursor = conn.cursor()
        
#         # فحص إذا كانت القصة موجودة مسبقاً في نفس اليوم
#         check_sql = "SELECT id FROM seneksar WHERE title = %s AND gregorian_date = %s"
#         cursor.execute(check_sql, (story['title'], story['gregorian_date']))
#         existing = cursor.fetchone()
        
#         if existing:
#             print(f"القصة موجودة مسبقاً في نفس اليوم: {story['title']}")
#             cursor.close()
#             conn.close()
#             return
        
#         sql = """
#             INSERT INTO seneksar (coptic_date, gregorian_date, title, content, image_url)
#             VALUES (%s, %s, %s, %s, %s)
#         """
#         cursor.execute(sql, (
#             story['coptic_date'],
#             story['gregorian_date'],
#             story['title'],
#             story['content'],
#             story['image_url']
#         ))
#         conn.commit()
#         print("تم الإدخال فعلاً")
#     except Exception as e:
#         print("خطأ أثناء الإدخال:", e)
#     finally:
#         if 'cursor' in locals():
#             cursor.close()
#         if 'conn' in locals():
#             conn.close()

# if __name__ == "__main__":
#     # سحب كل أيام مارس الميلادي
#     year = 2025
#     month = 0
#     end_day = calendar.monthrange(year, month)[1]
#     start_date = datetime(year, month, 1)
#     end_date = datetime(year, month, end_day)
#     current_date = start_date
#     print(f"\n{'='*50}")
#     print(f"جاري سحب شهر أبريل {year}")
#     print(f"{'='*50}")
#     while current_date <= end_date:
#         day_str = f"{current_date.day:02d}"
#         month_str = f"{current_date.month:02d}"
#         gregorian_date = current_date.strftime("%Y-%m-%d")
#         print(f"\n--- اليوم {gregorian_date} ---")
#         url = f"https://madraset-elshamamsa.com/Seneksar.php?m={month_str}&d={day_str}"
#         print(f"الرابط: {url}")
#         try:
#             stories = fetch_seneksar_data(url, gregorian_date)
#             if stories:
#                 print(f"تم العثور على {len(stories)} قصة")
#                 for story in stories:
#                     insert_story_to_db(story)
#                     print(f"تم حفظ القصة: {story['title']}")
#             else:
#                 print("لا توجد قصص لهذا اليوم")
#         except Exception as e:
#             print(f"خطأ في اليوم {gregorian_date}: {e}")
#         # انتظار قليل بين الطلبات لتجنب الضغط على الخادم
#         import time
#         time.sleep(1)
#         current_date += timedelta(days=1)
#     print(f"\n{'='*50}")
#     print(f"تم الانتهاء من سحب شهر أبريل {year}!")
#     print(f"{'='*50}") 