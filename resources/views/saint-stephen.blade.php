@extends('layouts.app')

@section('title', 'الشهيد اسطفانوس - أول الشمامسة وأول الشهداء')

@section('content')
<style>
@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Lalezar&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&display=swap');

.saint-page {
    background: transparent;
    color: white;
    font-family: 'Cairo', sans-serif;
    direction: rtl;
    padding: 0;
    min-height: 100vh;
}

.saint-header {
    text-align: center;
    padding: 40px 20px 0 20px;
    position: relative;
    background: linear-gradient(135deg, rgba(10, 42, 79, 0.95) 0%, rgba(10, 42, 79, 0.8) 100%);
    border-radius: 0 0 30px 30px;
    margin-bottom: 0;
    overflow: hidden;
}

.saint-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('{{ asset('images/coptic-pattern.png') }}') repeat;
    opacity: 0.07;
    z-index: 0;
}

.saint-title {
    font-family: 'Lalezar', 'Cairo', sans-serif;
    font-size: 2.7rem;
    color: #ffd700;
    margin-bottom: 10px;
    position: relative;
    z-index: 1;
    text-shadow: 0 2px 10px rgba(255, 215, 0, 0.3);
}

.saint-subtitle {
    font-family: 'Amiri', serif;
    font-size: 1.3rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 10px;
    position: relative;
    z-index: 1;
}

.saint-main-card {
    background: rgba(20, 40, 80, 0.93);
    border-radius: 24px;
    margin: 30px auto 0 auto;
    max-width: 1100px;
    box-shadow: 0 4px 32px rgba(0,0,0,0.13);
    padding: 32px 18px 18px 18px;
    display: flex;
    flex-direction: column;
    align-items: center;
    border: 1.5px solid #ffd70033;
}

.saint-image {
    width: 220px;
    height: 220px;
    border-radius: 50%;
    margin: 70px auto 18px auto;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 6px solid #ffd700;
    box-shadow: 0 8px 32px 0 rgba(255,215,0,0.18), 0 2px 12px rgba(0,0,0,0.18);
    background: #fffbe6;
    overflow: hidden;
    position: relative;
    z-index: 2;
    transition: box-shadow 0.3s, transform 0.3s;
}
.saint-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    transition: transform 0.3s;
}
.saint-image:hover {
    box-shadow: 0 12px 40px 0 #ffd70099, 0 2px 12px rgba(0,0,0,0.18);
    transform: scale(1.04);
}
.saint-image:hover img {
    transform: scale(1.06) rotate(-2deg);
}

.saint-info-grid-custom {
    display: flex;
    flex-direction: row;
    gap: 24px;
    justify-content: center;
    align-items: stretch;
    width: 100%;
    max-width: 900px;
    margin: 0 auto 30px auto;
}
.info-card {
    flex: 1 1 0;
    background: rgba(255, 255, 255, 0.10);
    border-radius: 15px;
    padding: 28px 18px;
    text-align: center;
    border: 2.5px solid #ffd700;
    box-shadow: 0 2px 10px rgba(255,215,0,0.10);
    margin-bottom: 0;
    transition: all 0.3s ease;
    min-width: 0;
    max-width: 300px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.info-card:hover {
    transform: translateY(-5px) scale(1.03);
    border-color: #ffd70099;
    box-shadow: 0 5px 15px rgba(255, 215, 0, 0.13);
}
.info-icon {
    font-size: 2.1rem;
    color: #ffd700;
    margin-bottom: 10px;
}
.info-card h3 {
    color: #ffd700;
    font-size: 1.1rem;
    margin-bottom: 7px;
    font-family: 'Cairo', sans-serif;
}
.info-card p {
    color: rgba(255, 255, 255, 0.93);
    font-size: 1.08rem;
    margin: 0;
}

.saint-text-card {
    background: rgba(255,255,255,0.07);
    border-radius: 18px;
    padding: 28px 24px;
    margin: 0 0 30px 0;
    box-shadow: 0 2px 12px rgba(255,215,0,0.07);
    border: 1.5px solid #ffd70022;
    font-size: 1.13rem;
    line-height: 2.1;
    color: #eaeaea;
    text-align: center;
    max-width: 900px;
    margin-left: auto;
    margin-right: auto;
}

.hymn-section {
    background: rgba(255, 255, 255, 0.07);
    border-radius: 18px;
    padding: 28px 18px 18px 18px;
    margin-bottom: 40px;
    box-shadow: 0 2px 12px rgba(255,215,0,0.07);
    border: 1.5px solid #ffd70022;
    max-width: 900px;
    margin-left: auto;
    margin-right: auto;
}
.hymn-title {
    font-size: 2rem;
    color: #ffd700;
    margin-bottom: 30px;
    text-align: center;
    font-family: 'Lalezar', 'Cairo', sans-serif;
}
.hymn-text {
    font-family: 'Amiri', serif;
    font-size: 1.18rem;
    line-height: 2.1;
    color: #fff;
    text-align: center;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.2em 32px;
    padding: 0 10px 10px 10px;
}
.hymn-line {
    display: contents;
}
.hymn-line span {
    min-width: 120px;
    display: inline-block;
}

@media (max-width: 900px) {
    .saint-main-card { max-width: 98vw; }
    .hymn-section, .saint-text-card { max-width: 98vw; }
    .saint-info-grid-custom {
        gap: 14px;
    }
}
@media (max-width: 768px) {
    .saint-title { font-size: 2rem; }
    .saint-header { padding: 30px 8px 0 8px; }
    .saint-image { width: 150px; height: 150px; margin-top: -75px; }
    .saint-info-grid-custom {
        gap: 12px;
    }
    .hymn-title { font-size: 1.3rem; }
    .hymn-text {
        grid-template-columns: repeat(2, 1fr);
        gap: 0.2em 10px;
        font-size: 1.05rem;
    }
    .hymn-line span { min-width: unset; }
    .saint-main-card { padding: 18px 2px 8px 2px; }
    .saint-text-card { padding: 16px 6px; font-size: 1rem; }
}
@media (max-width: 480px) {
    .saint-title { font-size: 1.2rem; }
    .saint-header { padding: 18px 2px 0 2px; }
    .saint-image { width: 90px; height: 90px; margin-top: -45px; }
}
@media (max-width: 600px) {
    .saint-info-grid-custom {
        gap: 12px;
    }
    .info-row {
        flex-direction: row;
        gap: 10px;
    }
    .info-row:not(.single-center) {
        flex-wrap: wrap;
    }
    .info-row .info-card {
        min-width: 0;
        flex: 1 1 45%;
        font-size: 0.98rem;
        padding: 14px 4px;
    }
    .info-row.single-center .info-card {
        flex: 1 1 90%;
        max-width: 90vw;
        margin: 0 auto;
    }
}
</style>

<div class="saint-page">
    <header class="saint-header">
        <h1 class="saint-title">الشهيد اسطفانوس</h1>
        <p class="saint-subtitle">أول الشمامسة وأول الشهداء</p>
    </header>

    <div class="saint-main-card">
        <div class="saint-image">
            <img src="{{ asset('images/saint-stephen.jpg') }}" alt="الشهيد اسطفانوس">
        </div>
        <div class="saint-info-grid-custom">
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-church"></i>
                </div>
                <h3>شفيع المدرسة</h3>
                <p>مدرسة الشهيد اسطفانوس</p>
            </div>
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3>مكان الميلاد</h3>
                <p>أورشليم</p>
            </div>
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3>تاريخ النياحة</h3>
                <p>1 طوبة (37م)</p>
            </div>
        </div>
        <div class="saint-text-card">
            <p>
                اسم يوناني معناه "تاج" أو "إكليل من الزهور" wreath, crown، ويُكْتَب في العربية بأكثر من صيغة، مثل: استفانوس - اسطفانوس - استيفانوس.<br>
                وهو اسم أول شهداء المسيحية وأول الشمامسة أيضًا. وبما أن اسمه يوناني فيرجّح أنه كان هيلينيًا (أي أنه لم يكن يوناني الجنس بل يوناني اللغة والثقافة) أو أنه كان يهوديًا يتكلم اليونانية.<br>
                ولما اشتكى الهيلينيون المسيحيون في أورشليم من أن أراملهم كن يهملن (أعمال 6: 1) انتخب سبعة رجال من ضمنهم إستفانوس ليقوموا بأمر الخدمة اليومية وتوزيع التقدمات على الفقراء من المسيحيين (أعمال 6: 2- 6) وهؤلاء الرجال السبعة يعرفون بأول شمامسة في الكنيسة المسيحية.<br>
                ويصف الكتاب المقدس استفانوس بأنه رجل ممتلئ من الإيمان والروح القدس (أعمال 6: 5) وأنه كان يصنع قوات وعجائب (أعمال 6: 8) وكان ينادي بالرسالة بحكمة (أعمال 6: 10).<br>
                ولما لم يتمكن بعض من هؤلاء اليهود الهيلينيين أن يجاوبوا استفانوس أو يقاوموا قوة الحكمة والروح التي كانت فيه اخترعوا ضده شكايات زور، فدسّوا رجالًا مأجورين يقولون أننا سمعناه يجدف على الله وعلى موسى وأنه تكلم ضد الشريعة وضد الهيكل. وقدمت هذه الشكاوى إلى مجمع السنهدريم (أعمال 6: 9- 14).<br>
                وقد سَجَّل لنا سفر الأعمال ملخصًا للدفاع المجيد الذي قدمه استفانوس (أع 7: 1- 53) فأبان أولًا أنه يعطي المجد كله لله (أع 7: 2)، وأنه يكرم موسى (أع 7: 20- 43) والناموس (أع 7: 38، 53) والهيكل (أع 7: 47).<br>
                وقد رفض المجلس أن يستمع لاستفانوس بعد هذا، أما هو فقال أنه يرى السماوات مفتوحة وابن الإنسان قائمًا عن يمين الله (أعمال 7: 54- 56) عندئذ أخرجوه خارج المدينة، ربما من الباب الذي يُدعى اليوم "باب استفانوس"، ورجموه.<br>
                وكان وهم يرجمونه يقول "أيها الرب يسوع اقبل روحي" ثم طلب من الرب غفران خطيتهم بسبب رجمه. وشاول الذي أصبح فيما بعد بولس، رسول يسوع المسيح العظيم، كان راضيًا بِرَجْم استفانوس (أعمال 8: 1) وكان يحرس ثياب الذين رجموه (أعمال 7: 58).
            </p>
        </div>
        <div class="hymn-section">
            <h2 class="hymn-title">مديح الشهيد اسطفانوس</h2>
            <div class="hymn-text">
                <div class="hymn-line"><span>السلام لك يا اسطفانوس</span><span>يا رئيس الشمامسة</span></div>
                <div class="hymn-line"><span>السلام لك يا اسطفانوس</span><span>يا اول الشهداء</span></div>
                <div class="hymn-line"><span>الرسل اختاروا</span><span>شمامسة سبعة</span></div>
                <div class="hymn-line"><span>رجالا مملوئين</span><span>من كل نعمة</span></div>
                <div class="hymn-line"><span>ميكانور وبروخوس</span><span>تيمون وفيلبس</span></div>
                <div class="hymn-line"><span>برميناس ونيقولاس</span><span>و اولهم اسطفانوس</span></div>
                <div class="hymn-line"><span>قديسنا اسطفانوس</span><span>كان يصنع الايات</span></div>
                <div class="hymn-line"><span>وعجائب عظام</span><span>وأيضًا معجزات</span></div>
                <div class="hymn-line"><span>فحسده الشيطان</span><span>وايضا اليهود</span></div>
                <div class="hymn-line"><span>فحرك ايناسا</span><span>كانوا عنده شهود</span></div>
                <div class="hymn-line"><span>فى شهادتهم كاذبين</span><span>وظهروا مخادعين</span></div>
                <div class="hymn-line"><span>ليتهموا الامين</span><span>وعليه قائلين</span></div>
                <div class="hymn-line"><span>يجدف على الله</span><span>هذا الانسان</span></div>
                <div class="hymn-line"><span>وايضا على موسي</span><span>وهيكل سليمان</span></div>
                <div class="hymn-line"><span>فوقف وتكلم</span><span>عن محبة الله</span></div>
                <div class="hymn-line"><span>ولخص و شرح</span><span>ما قد جاء فى التوراة</span></div>
                <div class="hymn-line"><span>وختم خطابه</span><span>تبكيت ضمائرهم</span></div>
                <div class="hymn-line"><span>على كل ما فعلوه</span><span>هم وابائهم</span></div>
                <div class="hymn-line"><span>ايا من الانبياء</span><span>اباكم اطاعوا</span></div>
                <div class="hymn-line"><span>وكذلك يسوع المسيح</span><span>قتلتوه و صلبتوه</span></div>
                <div class="hymn-line"><span>فغتاظوا و حنقوا</span><span>بقلوبهم و اخذوه</span></div>
                <div class="hymn-line"><span>وفى خارج المدينة</span><span>هناك قد رجموه</span></div>
                <div class="hymn-line"><span>فشخص اسطفانوس</span><span>ونظر الى السموات</span></div>
                <div class="hymn-line"><span>فراى مجد الله</span><span>وحوله قوات</span></div>
                <div class="hymn-line"><span>فقال ها انا انظر</span><span>السموات مفتوحة</span></div>
                <div class="hymn-line"><span>وابن الانسان قائم</span><span>عن يمين الله</span></div>
                <div class="hymn-line"><span>فصلى للاله</span><span>بنية نقية</span></div>
                <div class="hymn-line"><span>يارب لا تقم لهم</span><span>هذه الخطية</span></div>
                <div class="hymn-line"><span>يسوع المسيح</span><span>غفر لصالبيه</span></div>
                <div class="hymn-line"><span>والقديس اسطفانوس</span><span>قد سامح راجميه</span></div>
                <div class="hymn-line"><span>فى يوم واحد طوبة</span><span>يا حبيب ايسوس</span></div>
                <div class="hymn-line"><span>يوم انتقالك</span><span>الى الفردوس</span></div>
                <div class="hymn-line"><span>ويوم 15 توت</span><span>فى السنة القبطية</span></div>
                <div class="hymn-line"><span>تذكار نقل جسدك</span><span>لمدينة القسطنطينية</span></div>
                <div class="hymn-line"><span>ابنائك الشمامسة</span><span>اذكرهم فى صلاتك</span></div>
                <div class="hymn-line"><span>ليبشروا بالانجيل</span><span>ويقتدون بصفاتك</span></div>
                <div class="hymn-line"><span>اذكرنا كلنا</span><span>امام رب القوات</span></div>
                <div class="hymn-line"><span>لنحظى بوجودنا</span><span>فى ملكوت السموات</span></div>
                <div class="hymn-line"><span>تفسير اسمك فى افواه</span><span>كل المؤمنين</span></div>
                <div class="hymn-line"><span>الكل يقولون يا اله</span><span>القديس اسطفانوس اعنا اجمعين</span></div>
            </div>
        </div>
    </div>
</div>
@endsection 