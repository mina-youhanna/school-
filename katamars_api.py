import requests
from seleniumwire import webdriver
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.common.by import By
from time import sleep
import brotli
import json
import mysql.connector
from selenium.webdriver.support.ui import Select
from selenium.webdriver.common.action_chains import ActionChains

# الاتصال بقاعدة البيانات
conn = mysql.connector.connect(
    host="127.0.0.1",
    port=3308,
    user="root",
    password="",
    database="school"
)
cursor = conn.cursor()

def insert_reading(gregorian_date, coptic_date, data):
    sql = """
    INSERT INTO katamars_readings
    (gregorian_date, coptic_date, vesper_prayer, morning_prayer, polis, apraksees, kathilycon, gospel)
    VALUES (%s, %s, %s, %s, %s, %s, %s, %s)
    """
    cursor.execute(sql, (
        gregorian_date, coptic_date,
        data.get('vesperPrayer'),
        data.get('morningPrayer'),
        data.get('polis'),
        data.get('apraksees'),
        data.get('kathilycon'),
        data.get('gospel')
    ))
    conn.commit()

url = "https://katamars.avabishoy.com/api/Katamars/GetReadings"
params = {
    "year": 2025,
    "month": 7,
    "day": 17,  # جرب يوم تاني شغال في المتصفح
    "katamarsSourceId": 0,
    "synaxariumSourceId": 0
}
headers = {
    "accept": "*/*",
    "accept-encoding": "gzip, deflate, br, zstd",
    "accept-language": "en-US,en;q=0.9",
    "content-type": "application/json; charset=utf-8",
    "origin": "https://katamars.avabishoy.com",
    "referer": "https://katamars.avabishoy.com/Katamars",
    "sec-ch-ua": '"Not)A;Brand";v="8", "Chromium";v="138", "Microsoft Edge";v="138"',
    "sec-ch-ua-mobile": "?0",
    "sec-ch-ua-platform": '"Windows"',
    "sec-fetch-dest": "empty",
    "sec-fetch-mode": "cors",
    "sec-fetch-site": "same-origin",
    "user-agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0"
}
body = [
    {"fontSection": 2, "fontName": "Arial", "fontSize": 14, "isBold": False, "color": "#000000", "isRtl": True},
    {"fontSection": 1, "fontName": "Arial", "fontSize": 14, "isBold": False, "color": "#000000", "isRtl": True},
    {"fontSection": 0, "fontName": "Arial", "fontSize": 14, "isBold": False, "color": "#000000", "isRtl": True},
    {"fontSection": 4, "fontName": "Arial", "fontSize": 14, "isBold": False, "color": "#000000", "isRtl": True},
    {"fontSection": 5, "fontName": "Arial", "fontSize": 14, "isBold": False, "color": "#000000", "isRtl": True},
    {"fontSection": 3, "fontName": "Athanasius", "fontSize": 20, "isBold": False, "color": "#8B0000", "isRtl": True},
    {"fontSection": 7, "fontName": "Arial", "fontSize": 14, "isBold": False, "color": "#000000", "isRtl": True},
    {"fontSection": 8, "fontName": "Arial", "fontSize": 14, "isBold": False, "color": "#000080", "isRtl": True},
    {"fontSection": 6, "fontName": "Bwgrki", "fontSize": 16, "isBold": False, "color": "#ff8c00", "isRtl": True},
    {"fontSection": 10, "fontName": "Hebrew", "fontSize": 16, "isBold": False, "color": "#191970", "isRtl": True},
    {"fontSection": 9, "fontName": "Arial", "fontSize": 14, "isBold": False, "color": "#000000", "isRtl": True},
    {"fontSection": 11, "fontName": "Arial", "fontSize": 16, "isBold": False, "color": "#136fb1", "isRtl": True},
    {"fontSection": 12, "fontName": "Arial", "fontSize": 8, "isBold": False, "color": "#fe0707", "isRtl": True},
    {"fontSection": 13, "fontName": "Arial", "fontSize": 14, "isBold": False, "color": "#000000", "isRtl": True},
    {"fontSection": 14, "fontName": "Arial", "fontSize": 15, "isBold": False, "color": "#136fb1", "isRtl": True},
    {"fontSection": 15, "fontName": "Arial", "fontSize": 13, "isBold": False, "color": "#b41717", "isRtl": True}
]

response = requests.post(url, params=params, headers=headers, json=body)
print("Status:", response.status_code)
print("Content-Type:", response.headers.get("Content-Type"))
print("Response:")
print(response.text)

if response.headers.get("Content-Type", "").startswith("application/json"):
    data = response.json()
    fields = ["vesperPrayer", "morningPrayer", "polis", "apraksees", "kathilycon", "gospel"]
    for field in fields:
        print(f"{field}:")
        print(data.get(field, "غير موجود"))
        print("-" * 40)
else:
    print("الاستجابة ليست JSON أو فارغة.")

# إعداد الشهور القبطية
coptic_months = ["كيهك", "طوبه"]
coptic_day = 23  # يبدأ من 23 كيهك
coptic_month_index = 0  # 0 = كيهك

# فقط يوم 1/1
# إعداد التاريخ الميلادي والقبطي
selected_year = 2025
selected_month = 1
selected_day = 1
gregorian_date = f"{selected_year}-01-01"
coptic_date = f"{coptic_day} {coptic_months[coptic_month_index]}"

# selenium
service = Service('C:/Users/user/Downloads/chromedriver-win64/chromedriver-win64/chromedriver.exe')
driver = webdriver.Chrome(service=service)
driver.get("https://katamars.avabishoy.com/Katamars")
sleep(30)  # انتظر تحميل الصفحة

selected_year = 2025
selected_month = 1

for day in range(1, 32):
    cmd = input(f"اضغط y لسحب يوم {day}/{selected_month}/{selected_year} أو q للخروج: ").strip().lower()
    if cmd != 'y':
        print("تم الإنهاء.")
        break

    # جلب كل عناصر select الخاصة بالتاريخ بعد كل ريلود
    selects = driver.find_elements(By.CSS_SELECTOR, "select.form-select")
    if len(selects) < 3:
        raise Exception("لم أجد كل عناصر التاريخ!")

    # السنة
    year_select = Select(selects[0])
    year_select.select_by_value(str(selected_year))
    driver.execute_script("arguments[0].dispatchEvent(new Event('change', { bubbles: true }));", selects[0])
    sleep(1)

    # الشهر
    month_select = Select(selects[1])
    month_select.select_by_value(str(selected_month))
    driver.execute_script("arguments[0].dispatchEvent(new Event('change', { bubbles: true }));", selects[1])
    sleep(1)

    # اليوم
    day_select = Select(selects[2])
    day_select.select_by_value(str(day))
    driver.execute_script("arguments[0].dispatchEvent(new Event('change', { bubbles: true }));", selects[2])
    sleep(1)

    # اضغط زر السهم (>)
    arrow_button = driver.find_element(By.XPATH, '//button[contains(text(), ">")]')
    arrow_button.click()
    sleep(2)  # انتظر تفعيل الزر

    # جرب عمل ريلود للصفحة
    driver.refresh()
    sleep(30)  # انتظر تحميل الصفحة من جديد

    # بعد الريلود يمكنك محاولة جلب البيانات من driver.requests كالمعتاد

driver.quit()
