@extends('layouts.app')

@section('title', 'مدرسة الشهيد استفانوس للشمامسة')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Lalezar&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&display=swap');

/* تنسيقات عامة */
.school-page {
    background: #0A2A4F;
    color: white;
    font-family: 'Cairo', sans-serif;
    direction: rtl;
    padding: 20px;
    min-height: 100vh;
}

/* هيدر الصفحة */
.school-header {
    text-align: center;
    padding: 40px 20px;
    position: relative;
    background: linear-gradient(135deg, rgba(10, 42, 79, 0.9) 0%, rgba(10, 42, 79, 0.7) 100%);
    border-radius: 20px;
    margin-bottom: 40px;
    overflow: hidden;
}

.school-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('{{ asset('images/download.png') }}') repeat;
    opacity: 0.05;
    z-index: 0;
}

.school-title {
    font-family: 'Lalezar', 'Cairo', sans-serif;
    font-size: 3rem;
    color: #ffd700;
    margin-bottom: 20px;
    position: relative;
    z-index: 1;
    text-shadow: 0 2px 10px rgba(255, 215, 0, 0.3);
}

.school-subtitle {
    font-family: 'Amiri', serif;
    font-size: 1.5rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 30px;
    position: relative;
    z-index: 1;
}

/* قسم نبذة عن الشهيد */
.saint-section {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 40px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    position: relative;
    overflow: hidden;
}

.saint-section::before {
    content: '';
    position: absolute;
    top: -50px;
    left: -50px;
    width: 100px;
    height: 100px;
    background: url('{{ asset('images/scroll-corner.svg') }}') center/contain no-repeat;
    opacity: 0.15;
    transform: rotate(0deg);
}

.saint-section::after {
    content: '';
    position: absolute;
    bottom: -50px;
    right: -50px;
    width: 100px;
    height: 100px;
    background: url('{{ asset('images/scroll-corner.svg') }}') center/contain no-repeat;
    opacity: 0.15;
    transform: rotate(180deg);
}

.saint-content {
    display: flex;
    gap: 30px;
    align-items: center;
}

.saint-image {
    flex: 0 0 300px;
    height: 400px;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    position: relative;
    border: 4px solid #ffd700;
    box-shadow: 0 6px 24px rgba(255,215,0,0.18), 0 2px 12px rgba(0,0,0,0.18);
    border-radius: 50%;
    overflow: hidden;
    width: 220px;
    height: 220px;
    margin: 30px auto 0 auto;
    background: #fffbe6;
    display: flex;
    align-items: center;
    justify-content: center;
}

.saint-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    margin-top: 0;
    object-position: center 30%;
}

.saint-text {
    flex: 1;
    font-size: 1.1rem;
    line-height: 1.8;
    color: rgba(255, 255, 255, 0.9);
}

.saint-text p {
    margin-bottom: 20px;
}

.read-more-btn {
    display: inline-block;
    background: linear-gradient(135deg, #ffd700 0%, #e6c200 100%);
    color: #0a234f;
    padding: 12px 25px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease;
    margin-top: 20px;
}

.read-more-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
}

/* قسم نظام المدرسة */
.school-system {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 40px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.15);
}

.system-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.system-title {
    font-size: 2rem;
    color: #ffd700;
    margin: 0;
}

.admin-system-btn {
    background: linear-gradient(135deg, #ffd700 0%, #e6c200 100%);
    color: #0a234f;
    border: none;
    padding: 10px 20px;
    border-radius: 20px;
    cursor: pointer;
    font-weight: bold;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.admin-system-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
}

.system-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.system-item {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 15px;
    transition: all 0.3s ease;
}

.system-item:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateX(-5px);
}

.system-icon {
    width: 40px;
    height: 40px;
    background: rgba(255, 215, 0, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffd700;
    font-size: 1.2rem;
}

.system-text {
    flex: 1;
    font-size: 1.1rem;
}

/* قسم أهداف المدرسة */
.school-goals {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 40px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.15);
}

.goals-title {
    font-size: 2rem;
    color: #ffd700;
    margin-bottom: 30px;
    text-align: center;
}

.goals-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

.goal-card {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 15px;
    padding: 25px;
    text-align: center;
    transition: all 0.3s ease;
}

.goal-card:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-5px);
}

.goal-icon {
    font-size: 2.5rem;
    color: #ffd700;
    margin-bottom: 15px;
}

.goal-title {
    font-size: 1.3rem;
    color: #ffd700;
    margin-bottom: 15px;
}

.goal-text {
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.6;
}

/* Modal إدارة النظام */
.system-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.8);
    z-index: 2000;
    backdrop-filter: blur(5px);
}

.system-modal-content {
    position: relative;
    background: #0A2A4F;
    margin: 5% auto;
    padding: 20px;
    width: 80%;
    max-width: 800px;
    border-radius: 15px;
    box-shadow: 0 0 30px rgba(255, 215, 0, 0.2);
    border: 2px solid rgba(255, 215, 0, 0.3);
    animation: modalFadeIn 0.3s ease;
    max-height: 80vh;
    display: flex;
    flex-direction: column;
}

.system-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 15px;
    border-bottom: 2px solid rgba(255, 215, 0, 0.3);
}

.system-modal-header h2 {
    color: #ffd700;
    margin: 0;
    font-size: 1.8rem;
}

.close-modal {
    background: none;
    border: none;
    color: #ffd700;
    font-size: 2rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.close-modal:hover {
    transform: rotate(90deg);
    color: #fff;
}

.system-list-modal {
    flex: 1;
    overflow-y: auto;
    padding-right: 10px;
    margin-bottom: 20px;
    max-height: 400px;
}

.system-item-modal {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: rgba(255, 255, 255, 0.1);
    padding: 15px;
    margin-bottom: 10px;
    border-radius: 10px;
    transition: all 0.3s ease;
}

.system-item-modal:hover {
    background: rgba(255, 255, 255, 0.15);
}

.system-actions {
    display: flex;
    gap: 10px;
    align-items: center;
}

.system-actions button {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 1.2rem;
    transition: all 0.3s ease;
    padding: 5px;
}

.system-actions button:hover {
    transform: scale(1.1);
}

.system-text-modal {
    flex: 1;
    margin: 0 15px;
    text-align: right;
    display: flex;
    align-items: center;
    gap: 10px;
}

.system-text-modal i {
    color: #ffd700;
    font-size: 1.2em;
}

.add-system-form {
    margin-top: 20px;
}

.add-system-form h3 {
    color: #ffd700;
    margin-bottom: 15px;
}

.form-group {
    display: flex;
    gap: 10px;
}

#newSystemText {
    flex: 1;
    padding: 10px 15px;
    border: 2px solid rgba(255, 215, 0, 0.3);
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.1);
    color: #fff;
    font-size: 1rem;
}

.add-system-btn {
    background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.add-system-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(76, 175, 80, 0.4);
}
.header-image img {
            width: 600px;
            max-width: 100%;
            display: block;
            position: relative;
            z-index: 1;
            margin-bottom: 0;
            margin-top: 40px;
            pointer-events: none;
            -webkit-user-drag: none;
            box-shadow: none;
        }

/* التصميم المتجاوب */
@media (max-width: 1200px) {
    .saint-content {
        flex-direction: column;
    }
    
    .saint-image {
        width: 100%;
        max-width: 400px;
        height: 300px;
    }
}

@media (max-width: 900px) {
    .school-stats-row {
        display: grid !important;
        grid-template-columns: 1fr 1fr !important;
        gap: 18px !important;
        justify-items: center;
    }
    .school-stats-row > div {
        width: 100%;
        min-width: 0;
    }
}
@media (max-width: 768px) {
    .school-title {
        font-size: 2.5rem;
    }
    
    .school-subtitle {
        font-size: 1.2rem;
    }
    
    .saint-text {
        font-size: 1rem;
    }
    
    .system-title {
        font-size: 1.8rem;
    }
    
    .goals-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .school-title {
        font-size: 2rem;
    }
    
    .school-subtitle {
        font-size: 1rem;
    }
    
    .saint-section,
    .school-system,
    .school-goals {
        padding: 20px;
    }
    
    .system-item {
        flex-direction: column;
        text-align: center;
    }
    
    .system-icon {
        margin-bottom: 10px;
    }
    .school-stats-row {
        grid-template-columns: 1fr 1fr !important;
        gap: 10px !important;
        max-width: 98vw;
    }
}

.edit-news-input, .edit-system-input {
    background: #f7f7f7;
    color: #222;
    border: 2px solid #ffd700;
    border-radius: 12px;
    padding: 10px 18px;
    font-size: 1.1em;
    margin-left: 8px;
    outline: none;
    transition: border 0.2s, box-shadow 0.2s;
    min-width: 180px;
    max-width: 350px;
    box-shadow: 0 2px 8px rgba(255,215,0,0.08);
}
.edit-news-input:focus, .edit-system-input:focus {
    border: 2.5px solid #ffea70;
    box-shadow: 0 0 0 2px #ffe06644;
}
.edit-btn-save, .edit-btn-cancel {
    border-radius: 10px;
    font-size: 1.3em;
    padding: 7px 14px;
    margin-left: 6px;
    box-shadow: 0 2px 8px rgba(255,215,0,0.08);
    display: inline-flex;
    align-items: center;
    border: none;
    transition: background 0.2s, transform 0.2s;
}
.edit-btn-save {
    background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
    color: #fff;
}
.edit-btn-cancel {
    background: linear-gradient(135deg, #ff4444 0%, #d32f2f 100%);
    color: #fff;
}
.edit-btn-save:hover, .edit-btn-cancel:hover {
    transform: scale(1.08);
    filter: brightness(1.1);
}
.system-actions button i {
    font-size: 1.4em;
}

/* ====== نسخ تنسيقات بطاقات الخدمات من الرئيسية ====== */
.features-title {
    font-family: 'Cairo', sans-serif;
    font-size: 2.5rem;
    font-weight: 800;
    text-align: center;
    margin-bottom: 50px;
    color: #ffd700;
    text-shadow: 0 2px 10px rgba(255, 215, 0, 0.3);
    position: relative;
}
.features-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, transparent, #ffd700, transparent);
}
.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
}
.features-grid > div {
    box-shadow: 0 4px 24px #0a234f22;
    border-radius: 22px;
    border: 1.5px solid #ffd70055;
    transition: transform 0.25s, box-shadow 0.25s, background 0.25s;
    padding: 32px 18px 24px 18px;
    text-align: center;
    position: relative;
    cursor: pointer;
    overflow: hidden;
    background: rgba(10, 35, 79, 0.4);
}
.features-grid > div:hover {
    transform: translateY(-8px) scale(1.04);
    box-shadow: 0 12px 40px #ffd70044, 0 2px 18px #0a234f22;
    background: linear-gradient(135deg, #ffd700 0%, #fffbe6 100%);
}
.features-grid .feature-title {
    color: #ffd700;
    font-family: 'Cairo', sans-serif;
    font-size: 1.25rem;
    font-weight: 800;
    margin-bottom: 12px;
    transition: color 0.2s;
}
.features-grid > div:hover .feature-title {
    color: #0a234f;
}
.features-grid .feature-desc {
    color: #fff;
    font-size: 1.08rem;
    margin-bottom: 0;
    transition: color 0.2s;
}
.features-grid > div:hover .feature-desc {
    color: #0a234f;
}
.feature-icon {
    font-size: 3rem;
    color: #ffd700;
    margin-bottom: 20px;
    transition: transform 0.3s, color 0.2s;
}
.features-grid > div:hover .feature-icon {
    transform: scale(1.18) rotate(-6deg);
    color: #0a234f;
}
</style>

<div class="school-page">
    <!-- هيدر الصفحة -->
    <header class="school-header">
        <h1 class="school-title">مدرسة الشهيد إسطفانوس للشمامسة</h1>
        <p class="school-subtitle">"لأَنَّ الَّذِينَ تَشَمَّسُوا حَسَنًا، يَقْتَنُونَ لأَنْفُسِهِمْ دَرَجَةً حَسَنَةً وَثِقَةً كَثِيرَةً فِي الإِيمَانِ الَّذِي بِالْمَسِيحِ يَسُوعَ." (1 تي 3: 13).
        </p>
        <p class="school-subtitle">
            ".Ⲛⲏ ⲅⲁⲣ ⲉⲧⲁⲩϣⲉⲙϣⲓ ⲛ̀ⲕⲁⲗⲱⲥ ⲟⲩⲧⲱⲧⲉⲣ ⲉ̀ⲛⲁⲛⲉϥ: ⲡⲉⲧⲟⲩⲑⲁⲙⲓⲟ̀ ⲙ̀ⲙⲟϥ ⲛⲱⲟⲩ ⲛⲉⲙ ⲟⲩⲛⲓϣϯ ⲙ̀ⲡⲁⲣⲣⲏⲥⲓⲁ̀ ϧⲉⲛ ⲡⲓⲛⲁϩϯ ⲫⲏⲉⲧϧⲉⲛ Ⲡⲭ̅ⲥ̅ Ⲓⲏ̅ⲥ̅"
           
            <br>
            Ⲡⲣⲟⲥ Ⲧⲓⲙⲟⲑⲉⲟⲥ ⲁ̅  ⲅ̅ :ⲓ̅ⲅ̅</p>
    </header>

    <!-- قسم الإحصائيات -->
    <div class="school-stats-row" style="display: flex; justify-content: center; gap: 40px; margin-bottom: 30px; flex-wrap: wrap;">
        <div style="background:rgba(255,255,255,0.12); border-radius:18px; padding:18px 32px; box-shadow:0 2px 12px rgba(255,215,0,0.08); text-align:center;">
            <div style="font-size:2.2em; color:#ffd700;"><i class="fas fa-users"></i></div>
            <div style="font-size:1.2em; margin-top:8px;">عدد الطلاب</div>
            <div style="font-size:1.5em; font-weight:bold; margin-top:4px;">{{ $studentsCount ?? 0 }}</div>
        </div>
        <div style="background:rgba(255,255,255,0.12); border-radius:18px; padding:18px 32px; box-shadow:0 2px 12px rgba(255,215,0,0.08); text-align:center;">
            <div style="font-size:2.2em; color:#ffd700;"><i class="fas fa-church"></i></div>
            <div style="font-size:1.2em; margin-top:8px;">عدد الشمامسة</div>
            <div style="font-size:1.5em; font-weight:bold; margin-top:4px;">{{ $deaconsCount ?? 0 }}</div>
        </div>
        <div style="background:rgba(255,255,255,0.12); border-radius:18px; padding:18px 32px; box-shadow:0 2px 12px rgba(255,215,0,0.08); text-align:center;">
            <div style="font-size:2.2em; color:#ffd700;"><i class="fas fa-user-tie"></i></div>
            <div style="font-size:1.2em; margin-top:8px;">عدد الخدام</div>
            <div style="font-size:1.5em; font-weight:bold; margin-top:4px;">{{ $servantsCount ?? 0 }}</div>
        </div>
      
        <div style="background:rgba(255,255,255,0.12); border-radius:18px; padding:18px 32px; box-shadow:0 2px 12px rgba(255,215,0,0.08); text-align:center;">
            <div style="font-size:2.2em; color:#ffd700;"><i class="fas fa-layer-group"></i></div>
            <div style="font-size:1.2em; margin-top:8px;">عدد الفصول</div>
            <div style="font-size:1.5em; font-weight:bold; margin-top:4px;">{{ $classesCount ?? 0 }}</div>
        </div>
        <div style="background:rgba(255,255,255,0.12); border-radius:18px; padding:18px 32px; box-shadow:0 2px 12px rgba(255,215,0,0.08); text-align:center;">
            <div style="font-size:2.2em; color:#ffd700;"><i class="fas fa-calendar-alt"></i></div>
            <div style="font-size:1.2em; margin-top:8px;">سنوات الخدمة</div>
            <div style="font-size:1.5em; font-weight:bold; margin-top:4px;">{{ $yearsOfService ?? 0 }}</div>
        </div>
    </div>

    <!-- قسم نبذة عن الشهيد -->
    <section class="saint-section">
        <div class="saint-content">
            <div class="saint-image">
                <img src="{{ asset('images/saint-stephen.jpg') }}" alt="الشهيد اسطفانوس">
            </div>
            <div class="saint-text">
                <p>
                    هو أول شهداء المسيحية وأول الشمامسة أيضًا. وبما أن اسمه يوناني فيرجّح أنه كان هيلينيًا (أي أنه لم يكن يوناني الجنس بل يوناني اللغة والثقافة) أو أنه كان يهوديًا يتكلم اليونانية.
                </p>
                <p>
                    ولما اشتكى الهيلينيون المسيحيون في أورشليم من أن أراملهم كن يهملن (أعمال 6: 1) انتخب سبعة رجال من ضمنهم إستفانوس ليقوموا بأمر الخدمة اليومية وتوزيع التقدمات على الفقراء من المسيحيين (أعمال 6: 2- 6) وهؤلاء الرجال السبعة يعرفون بأول شمامسة في الكنيسة المسيحية.
                </p>
                <a href="{{ route('saint.stephen') }}" class="read-more-btn">
                    <i class="fas fa-book-open"></i>
                    اقرأ المزيد عن الشهيد
                </a>
            </div>
        </div>
    </section>

    <!-- قسم نظام المدرسة -->
    <section class="school-system">
        <div class="system-header">
            <h2 class="system-title">نظام المدرسة</h2>
            <button class="admin-system-btn" onclick="openSystemModal()">
                <i class="fas fa-cog"></i>
                إدارة النظام
            </button>
        </div>
        <ul class="system-list" id="systemList">
            <!-- سيتم ملؤها ديناميكياً -->
        </ul>
    </section>

    <!-- قسم أهداف المدرسة -->
    <section class="school-goals">
        <h2 class="features-title">أهداف المدرسة</h2>
        <div class="features-grid">
            <div>
                <div class="feature-icon">
                    <i class="fas fa-book-bible"></i>
                </div>
                <div class="feature-title">التعليم الروحي</div>
                <div class="feature-desc">تعليم الشمامسة مبادئ الإيمان المسيحي والكتاب المقدس بشكل عميق ومفصل.</div>
            </div>
            <div>
                <div class="feature-icon">
                    <i class="fas fa-hands-helping"></i>
                </div>
                <div class="feature-title">الخدمة الكنسية</div>
                <div class="feature-desc">بناء شخصية مسيحية لتورجية مرتبطة  بالكنيسة القبطية الأرثوذوكسية .</div>
            </div>
            <div>
                <div class="feature-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="feature-title">التنمية الشخصية</div>
                <div class="feature-desc">تنمية شخصية الشمامسة وبناء قادة مسيحيين للمستقبل.</div>
            </div>
        </div>
    </section>
</div>

<!-- Modal إدارة النظام -->
<div id="systemModal" class="system-modal">
    <div class="system-modal-content">
        <div class="system-modal-header">
            <h2>إدارة نظام المدرسة</h2>
            <button class="close-modal" onclick="closeSystemModal()">&times;</button>
        </div>
        <div class="system-list-modal">
            <!-- سيتم ملؤها ديناميكياً -->
        </div>
        <div class="add-system-form">
            <h3>إضافة بند جديد</h3>
            <div class="form-group">
                <input type="text" id="newSystemText" placeholder="نص البند الجديد">
                <button onclick="addSystem()" class="add-system-btn">
                    <i class="fas fa-plus"></i>
                    إضافة
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// بيانات نظام المدرسة
window.systemItems = [
    { id: 1, text: "الالتزام بحضور جميع الدروس والاجتماعات" },
    { id: 2, text: "المشاركة في خدمة القداسات الأسبوعية" },
    { id: 3, text: "الدراسة المنتظمة للكتاب المقدس" },
    { id: 4, text: "المشاركة في أنشطة المدرسة المختلفة" },
    { id: 5, text: "الالتزام بمواعيد التدريب على الترتيل" }
];

// تحميل البيانات المحفوظة
const savedSystem = localStorage.getItem('schoolSystem');
if (savedSystem) {
    window.systemItems = JSON.parse(savedSystem);
}

// تحديث قائمة النظام
window.updateSystemList = function() {
    const systemList = document.getElementById('systemList');
    systemList.innerHTML = '';

    window.systemItems.forEach((item, index) => {
        const li = document.createElement('li');
        li.className = 'system-item';
        li.innerHTML = `
            <div class="system-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="system-text">${item.text}</div>
        `;
        systemList.appendChild(li);
    });
}

// دوال إدارة النظام
window.openSystemModal = function() {
    document.getElementById('systemModal').style.display = 'block';
    window.updateSystemModalList();
}

window.closeSystemModal = function() {
    document.getElementById('systemModal').style.display = 'none';
}

window.updateSystemModalList = function() {
    const systemList = document.querySelector('.system-list-modal');
    systemList.innerHTML = '';

    window.systemItems.forEach((item, index) => {
        const div = document.createElement('div');
        div.className = 'system-item-modal';
        div.innerHTML = `
            <div class="system-text-modal">
                <i class="fas fa-check-circle"></i>
                <span id="system-text-${index}">${item.text}</span>
            </div>
            <div class="system-actions">
                <button onclick="editSystem(${index})">
                    <i class="fas fa-pen-to-square" style="color: #4CAF50;"></i>
                </button>
                <button onclick="deleteSystem(${index})">
                    <i class="fas fa-trash" style="color: #ff4444;"></i>
                </button>
            </div>
        `;
        systemList.appendChild(div);
    });
}

window.addSystem = function() {
    const newText = document.getElementById('newSystemText').value.trim();
    if (newText) {
        window.systemItems.unshift({
            id: Date.now(),
            text: newText
        });
        document.getElementById('newSystemText').value = '';
        window.updateSystemList();
        window.updateSystemModalList();
        window.saveSystem();
    }
}

window.editSystem = function(index) {
    const systemTextSpan = document.getElementById(`system-text-${index}`);
    const oldText = window.systemItems[index].text;
    systemTextSpan.innerHTML = `
        <input id="edit-input-${index}" class="edit-system-input" value="${oldText}">
        <button onclick="saveSystemEdit(${index})" class="edit-btn-save">
            <i class="fas fa-check"></i>
        </button>
        <button onclick="cancelSystemEdit(${index}, '${oldText.replace(/'/g, "\\'")}')" class="edit-btn-cancel">
            <i class="fas fa-times"></i>
        </button>
    `;
}

window.saveSystemEdit = function(index) {
    const newText = document.getElementById(`edit-input-${index}`).value.trim();
    if (newText) {
        window.systemItems[index].text = newText;
        window.updateSystemList();
        window.updateSystemModalList();
        window.saveSystem();
    }
}

window.cancelSystemEdit = function(index, oldText) {
    window.systemItems[index].text = oldText;
    window.updateSystemList();
    window.updateSystemModalList();
}

window.deleteSystem = function(index) {
    if (confirm('هل أنت متأكد من حذف هذا البند؟')) {
        window.systemItems.splice(index, 1);
        window.updateSystemList();
        window.updateSystemModalList();
        window.saveSystem();
    }
}

window.saveSystem = function() {
    localStorage.setItem('schoolSystem', JSON.stringify(window.systemItems));
}

// إغلاق النافذة عند النقر خارجها
window.onclick = function(event) {
    const modal = document.getElementById('systemModal');
    if (event.target == modal) {
        window.closeSystemModal();
    }
}

// تحديث القائمة عند تحميل الصفحة
document.addEventListener('DOMContentLoaded', function() {
    window.updateSystemList();
});

fetch('/api/study-classes')
  .then(res => res.json())
  .then(data => {
    // هنا اعرض الفصول في الصفحة
    console.log(data);
  });
</script>
@endsection 