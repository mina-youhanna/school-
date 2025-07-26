# import requests
# import datetime
# import mysql.connector
# import json

# conn = mysql.connector.connect(
#     host="127.0.0.1",
#     port=3308,
#     user="root",
#     password="",
#     database="school"
# )
# cursor = conn.cursor()

# headers = {
#     "Referer": "https://katamars.avabishoy.com/Katamars",
#     "Origin": "https://katamars.avabishoy.com",
#     "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0",
#     "Content-Type": "application/json; charset=utf-8",
#     "Accept": "*/*"
# }

# payload = [
#     {"fontSection":2,"fontName":"Arial","fontSize":14,"isBold":False,"color":"#000000","isRtl":True,"isSelected":True,"language":3},
#     {"fontSection":1,"fontName":"Arial","fontSize":14,"isBold":False,"color":"#000000","isRtl":True,"isSelected":False,"language":2},
#     {"fontSection":0,"fontName":"Arial","fontSize":14,"isBold":False,"color":"#000000","isRtl":True,"isSelected":False,"language":1},
#     {"fontSection":4,"fontName":"Arial","fontSize":14,"isBold":False,"color":"#000000","isRtl":True,"isSelected":False,"language":5},
#     {"fontSection":5,"fontName":"Arial","fontSize":14,"isBold":False,"color":"#000000","isRtl":True,"isSelected":False,"language":6},
#     {"fontSection":3,"fontName":"Athanasius","fontSize":20,"isBold":False,"color":"#8B0000","isRtl":True,"isSelected":False,"language":4},
#     {"fontSection":7,"fontName":"Arial","fontSize":14,"isBold":False,"color":"#000000","isRtl":True,"isSelected":False,"language":8},
#     {"fontSection":8,"fontName":"Arial","fontSize":14,"isBold":False,"color":"#000080","isRtl":True,"isSelected":False,"language":9},
#     {"fontSection":6,"fontName":"Bwgrki","fontSize":16,"isBold":False,"color":"#ff8c00","isRtl":True,"isSelected":False,"language":7},
#     {"fontSection":10,"fontName":"Hebrew","fontSize":16,"isBold":False,"color":"#191970","isRtl":True,"isSelected":False,"language":11},
#     {"fontSection":9,"fontName":"Arial","fontSize":14,"isBold":False,"color":"#000000","isRtl":True,"isSelected":False,"language":10},
#     {"fontSection":11,"fontName":"Arial","fontSize":16,"isBold":False,"color":"#136fb1","isRtl":True,"isSelected":False,"language":0},
#     {"fontSection":12,"fontName":"Arial","fontSize":8,"isBold":False,"color":"#fe0707","isRtl":True,"isSelected":False,"language":0},
#     {"fontSection":13,"fontName":"Arial","fontSize":14,"isBold":False,"color":"#000000","isRtl":True,"isSelected":False,"language":0},
#     {"fontSection":14,"fontName":"Arial","fontSize":15,"isBold":False,"color":"#136fb1","isRtl":True,"isSelected":False,"language":0},
#     {"fontSection":15,"fontName":"Arial","fontSize":13,"isBold":False,"color":"#b41717","isRtl":True,"isSelected":False,"language":0}
# ]

# year = 2025
# start_date = datetime.date(year, 12, 1)
# end_date = datetime.date(year, 12, 31)  # من 1/12 إلى 31/12
# current_date = start_date

# while current_date <= end_date:
#     url = f"https://katamars.avabishoy.com/api/Katamars/GetReadings?year={year}&month={current_date.month}&day={current_date.day}&katamarsSourceId=1&synaxariumSourceId=0"
#     response = requests.post(url, headers=headers, json=payload)
#     print(f"{current_date}: {response.status_code}")
#     if response.status_code == 200:
#         try:
#             data = json.loads(response.text)
#             # استخراج القيم المطلوبة من الجيسون
#             titleText = data.get('titleText', None)
#             verse = data.get('verse', None)
#             vesperPrayer = data.get('vesperPrayer', None)
#             morningPrayer = data.get('morningPrayer', None)
#             polis = data.get('polis', None)
#             apraksees = data.get('apraksees', None)
#             kathilycon = data.get('kathilycon', None)
#             gospel = data.get('gospel', None)
#             # تحديد التاريخ القبطي لشهر 12
#             day_of_dec = (current_date - datetime.date(year, 12, 1)).days + 1
#             if day_of_dec <= 9:
#                 coptic_date = f"{21 + day_of_dec} هاتور"  # من 22 هاتور إلى 30 هاتور
#             else:
#                 coptic_date = f"{day_of_dec - 9} كيهك"  # من 1 كيهك إلى 22 كيهك
#             # إدخال البيانات في قاعدة البيانات
#             insert_query = """
#                 INSERT INTO katamars_readings (
#                     gregorian_date, coptic_date, vesper_prayer, morning_prayer, polis, apraksees, kathilycon, gospel, titleText, verse
#                 ) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
#             """
#             cursor.execute(insert_query, (
#                 current_date,
#                 coptic_date,
#                 vesperPrayer,
#                 morningPrayer,
#                 polis,
#                 apraksees,
#                 kathilycon,
#                 gospel,
#                 titleText,
#                 verse
#             ))
#             conn.commit()

#             # بعد تنفيذ cursor.execute(insert_query, (...))
#             reading_id = cursor.lastrowid

#             prophecies = data.get('prophecies', [])
#             if prophecies:
#                 for prophecy in prophecies:
#                     prophecy_id = prophecy.get('id')
#                     ref_text = prophecy.get('refText')
#                     description = prophecy.get('description')
#                     prophecy_query = """
#                         INSERT INTO katamars_prophecies (reading_id, prophecy_id, ref_text, description)
#                         VALUES (%s, %s, %s, %s)
#                     """
#                     cursor.execute(prophecy_query, (reading_id, prophecy_id, ref_text, description))
#                 conn.commit()

#         except Exception as e:
#             print(f"Error processing {current_date}: {e}")
#     else:
#         print(f"Failed to fetch data for {current_date}")
#     current_date += datetime.timedelta(days=1)