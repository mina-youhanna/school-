@extends('layouts.app')

@section('title', 'سيرة القديس الأنبا توماس السائح')

@section('content')
<style>
:root {
    --gold: #ffd700;
    --gold-light: #fffbe6;
    --gold-dark: #b8860b;
    --navy: #0a234f;
    --navy-light: #1a237e;
    --glass-bg: rgba(255,255,255,0.1);
    --glass-border: rgba(255,255,255,0.2);
}
body{
    background-image: url('../images/download.png');
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes shimmer {
    0% { background-position: -1000px 0; }
    100% { background-position: 1000px 0; }
}

.saint-hero {
    position: relative;
    min-height: 500px;
    background: linear-gradient(135deg, var(--navy) 0%, var(--navy-light) 100%);
    border-radius: 30px;
    overflow: hidden;
    margin: 40px auto;
    max-width: 1200px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    animation: fadeIn 1s ease-out;
}

.saint-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(255,215,0,0.1) 0%, rgba(255,215,0,0) 100%);
    z-index: 1;
}

.saint-hero-content {
    position: relative;
    z-index: 2;
    padding: 60px 40px;
    text-align: center;
    color: #fff;
}

.saint-title {
    font-family: 'Lalezar', 'Cairo', sans-serif;
    font-size: 3.5rem;
    font-weight: 800;
    background: linear-gradient(90deg, var(--gold) 30%, var(--gold-light) 100%);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    margin-bottom: 20px;
    text-shadow: 0 2px 12px rgba(255,215,0,0.3);
    animation: shimmer 3s infinite linear;
    background-size: 1000px 100%;
}

.saint-subtitle {
    font-family: 'Cairo', sans-serif;
    font-size: 1.4rem;
    color: var(--gold);
    margin-bottom: 30px;
    line-height: 1.6;
}

.quote-box {
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    border-radius: 20px;
    padding: 30px;
    margin: 30px auto;
    max-width: 800px;
    text-align: center;
    color: #fff;
    font-family: 'Amiri', serif;
    font-size: 1.3rem;
    line-height: 2;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    backdrop-filter: blur(10px);
}

.quick-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin: 40px auto;
    max-width: 1000px;
}

.info-card {
    background: var(--glass-bg);
    border: 2px solid var(--gold);
    border-radius: 15px;
    padding: 20px;
    text-align: center;
    color: #fff;
    transition: transform 0.3s ease;
}

.info-card:hover {
    transform: translateY(-5px);
}

.info-card i {
    font-size: 2rem;
    color: var(--gold);
    margin-bottom: 10px;
}

.info-card h3 {
    font-family: 'Lalezar', 'Cairo', sans-serif;
    font-size: 1.2rem;
    margin-bottom: 10px;
    color: var(--gold);
}

.info-card p {
    font-family: 'Cairo', sans-serif;
    font-size: 1rem;
    line-height: 1.6;
}

.saint-story {
    background: var(--glass-bg);
    border: 2px solid var(--gold);
    border-radius: 20px;
    padding: 40px;
    margin: 40px auto;
    max-width: 900px;
    color: #fff;
    font-size: 1.15rem;
    line-height: 2.1;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    backdrop-filter: blur(10px);
    font-family: 'Amiri', serif;
}

.saint-date {
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
    border-radius: 15px;
    padding: 20px 30px;
    margin: 40px auto;
    max-width: 500px;
    text-align: center;
    color: var(--navy);
    font-size: 1.25rem;
    font-weight: bold;
    box-shadow: 0 4px 15px rgba(255,215,0,0.3);
}

.saint-tamgeed {
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    border-radius: 20px;
    padding: 40px;
    margin: 40px auto;
    max-width: 1000px;
    color: #fff;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    backdrop-filter: blur(10px);
}

.saint-tamgeed-title {
    color: var(--gold);
    font-size: 2rem;
    font-family: 'Lalezar', 'Cairo', sans-serif;
    margin-bottom: 30px;
    text-align: center;
    text-shadow: 0 2px 12px rgba(255,215,0,0.3);
}

.tamgeed-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin: 0 auto;
    padding: 0;
    list-style: none;
}

.tamgeed-list li {
    background: rgba(255,255,255,0.05);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 15px;
    transition: transform 0.3s ease;
}

.tamgeed-list li:hover {
    transform: translateX(5px);
}

.tamgeed-list li b {
    color: var(--gold);
    display: block;
    margin-bottom: 5px;
    font-family: 'Lalezar', 'Cairo', sans-serif;
}

.saint-tamgeed-flex {
    display: flex;
    flex-wrap: wrap;
    gap: 40px;
    justify-content: center;
    align-items: flex-start;
}

.saint-tamgeed-col {
    max-width: 240px;
    color: #fff;
    font-family: 'Cairo','Amiri',serif;
    font-size: 1.15rem;
    line-height: 2.1;
}

.saint-tamgeed-col span {
    display: block;
    margin-top: 8px;
}

@media (max-width: 768px) {
    .saint-title {
        font-size: 2.5rem;
    }
    .saint-subtitle {
        font-size: 1.2rem;
    }
    .quote-box {
        padding: 20px;
        font-size: 1.1rem;
    }
    .saint-story {
        padding: 20px;
    }
    .tamgeed-list {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 600px) {
    .saint-tamgeed-flex {
        flex-direction: row;
        gap: 10px;
    }
    .saint-tamgeed-col {
        max-width: 48%;
        font-size: 0.98rem;
    }
}
</style>

<div class="saint-hero">
    <div class="saint-hero-content">
        <h1 class="saint-title">الأنبا توماس السائح</h1>
        <div class="saint-subtitle">شفيع كنيسة القديسة دميانه والأنبا توماس السائح</div>
        <div class="quote-box">
            "طوبى للذى يحرق خديه بدموع محبة الرب لأن ماؤها يلين الأرض الناشفة"
        </div>
    </div>
</div>

<div class="quick-info">
    <div class="info-card">
        <i class="fas fa-calendar-alt"></i>
        <h3>تاريخ النياحة</h3>
        <p>٢٧ بشنس ١٦٨ للشهداء<br>(٢٧ مايو ٤٥٢م)</p>
    </div>
    <div class="info-card">
        <i class="fas fa-map-marker-alt"></i>
        <h3>مكان الميلاد</h3>
        <p>قرية شنشيف<br>(عرب بني واصل - ساقلته)</p>
    </div>
    <div class="info-card">
        <i class="fas fa-church"></i>
        <h3>شفيع الكنيسة</h3>
        <p>كنيسة القديسة دميانه<br>والأنبا توماس السائح</p>
    </div>
</div>

<div class="saint-story">
    <p>
    ولد القديس بقرية شنشيف والتي تعرف حالياً باسم: "عرب بني واصل" مركز ساقلته، محافظة سوهاج، من أبوين مسيحيين محبين لله، ربياه وأدباه بآداب الكنيسة.<br><br>
    المراجع الموجودة حتى الآن لم توضح السنة التي ولد فيها الأنبا توماس، إلا أنه من الواضح أنه عاش حياة تزيد عن مائة سنة ولا تتعدى مائة وثلاثين سنة.<br><br>
    اشتاق القديس إلى السيرة الرهبانية، فخرج وسكن في جبل شنشيف القريب من قريته، وفي أحضان الجبل اختار مغارة عاش فيها حياة العزلة والنسك، متعبداً لله، مجاهداً بقوة وقلب مملوء بالقداسة، مداوماً على الصلاة ليلاً ونهاراً، وكان طعامه مرة واحدة في الأسبوع.<br><br>
    تأثر الأنبا توماس بالقديس العظيم الأنبا أنطونيوس مؤسس الرهبنة، فأحب حياة العزلة الفردية، ولم يكن يخالط الإخوة (الرهبان) إلا وقت الصلاة.<br><br>
    ومع ذلك لم يبخل الأنبا توماس بالمشورة لأحد من الإخوة بل كان يستمع إليه بنقاوة قلب وطول أناة.<br><br>
    كان يذهب إليه بين الحين والآخر بعض الآباء الرهبان والمتوحدين الذين يسكنون الجبل، طلباً للإرشاد الروحي وأخذ البركة.<br><br>
    وكان يذهب إليه بين الحين والآخر القديس الأنبا شنوده رئيس المتوحدين.<br><br>
    (قد يكون القديس الأنبا توماس بمثابة المرشد الروحي للأنبا شنوده أو العكس)<br><br>
    كان الأنبا شنوده يحث أبناءه دائما أن يذهبوا ويستفيدوا من بهاء جبل شنشيف ومن الأنبا توماس.<br><br>
    كان القديس ذا صوت هادئ في التسبيح لله -كصوت الملائكة، حافظاً الكتب المقدسة، كاملاً في الفضائل المسيحية.<br><br>
    أعطاه الله موهبة عمل الآيات والعجائب، مثل شفاء الأمراض وإخراج الشياطين.<br><br>
    كانت صلواته وأصوامه لها قوة وقدرة شديدة لإزعاج الشياطين وهروبهم، وكان لا يستطيع عدو الخير أن يقهره أو يهزمه.<br><br>
    شهد عنه الأنبا شنوده قائلاً: إنه لم يكن أحد يعادله وان السيد المخلص خاطبه فماً بفم وإن الملائكة حضروا عنده مراراً كثيرة.<br><br>
    أعطاه الله أيضاً موهبة النبوة، ومعرفة بعض أحداث المستقبل، إذ عرفه الروح القدس بيوم نياحته.<br><br>
    وفي أثناء زيارة القديس الأنبا شنوده إلى القديس الأنبا توماس -بجبل شنشيف، قال له الأنبا توماس إني سأفارقك، وقد أخبرني الرب أنك ستلحق بي بعد أيام.<br><br>
    فطلب الأنبا شنوده علامة من القديس.<br><br>
    فقال له: إن الحجر الموجود خارج مسكنك سينقسم إلى نصفين عند مفارقة نفسي من جسدي.<br><br>
    لما قرب وقت انتقال الأنبا توماس من هذا العالم الفاني، ظهر له رب المجد، وعزاه وقواه، ووعده بأن هذا المكان سيبنى فيه كنيسة على اسمه، ويأتون إليها من كل البلاد ويكون اسمه شائعاً. وأخبره بأنه بعد ثلاثة أيام سيترك الجسد وينال إكليل الحياة الدائم، ثم أعطاه السلام وصعد إلى السماء.<br><br>
    تنيح القديس بشيخوخة حسنه في اليوم السابع والعشرين من شهر بشنس سنة 168 للشهداء الموافق 452 م تقريباً.<br><br>
    عند انتقال القديس الأنبا توماس إلى السماء، كان الأنبا شنوده رئيس المتوحدين واقفاً خارج قلايته، فرأى الحجر الذي كان يجلس عليه قد انشق إلى نصفين، ففي الحال تنهد القديس وقال: لقد عدمت برية شنشيف سراجها المنير.<br><br>
    ولما قال هذا أبصر رئيس الملائكة رافائيل يشير إليه بيده اليمين ويقول: السلام لك يا خليل الله وحبيب سائر القديسين، هلم لنستر جسد القديس الأنبا توماس.<br><br>
    فقام القديس الأنبا شنوده وأخذ معه الأنبا ويصا تلميذه والأنبا يوساب الحكيم ومار أخنوخ والأنبا تمرينوس ليكفنوا الأنبا توماس.<br><br>
    كفنوا الجسد ودفنوه في المكان الذي كان ساكناً فيه.<br><br>
    وفي وقت تكفينه كان حاضراً السيد المسيح له المجد، وداود النبي.<br><br>
    ولقد تحققت نبوءة الأنبا توماس عن نياحة الأنبا شنوده رئيس المتوحدين، في اليوم السابع من أبيب.<br><br>
    بركة صلاتهم تكون معنا. أمين
    </p>
</div>

<div class="saint-tamgeed" style="background:rgba(255,255,255,0.13); border-radius:20px; box-shadow:0 4px 30px rgba(0,0,0,0.10); border:1.5px solid #ffd700; padding:40px 20px; margin:40px auto; max-width:900px;">
    <img src="{{ asset('images/stthomas (3).jpg') }}" alt="الأنبا توماس السائح" style="max-width:180px; border-radius:16px; box-shadow:0 4px 32px rgba(10, 35, 79, 0.18), 0 0 0 5px rgba(255, 215, 0, 0.18); background:#fffbe6; display:block; margin:0 auto 30px auto;">
    <h2 class="saint-tamgeed-title" style="font-size:2rem; color:#ffd700; margin-bottom:30px; font-family:'Lalezar','Cairo',sans-serif; text-align:center;">كلمات مديح الأنبا توماس السائح</h2>
    <div class="saint-tamgeed-flex">
        <div class="saint-tamgeed-col" style="text-align:right;">
            <span>افتح فاى بالتسبيح</span>
            <span>السلام لك والمديح</span>
            <span>قديس من بيت شريف</span>
            <span>ليس لك مثيل</span>
            <span>بقوة الهية</span>
            <span>وسكنت البرية</span>
            <span>وتركت العالم وجيت</span>
            <span>وللمجد اشتهيت</span>
            <span>كنت محبا للاله</span>
            <span>بخوفه ورضاه</span>
            <span>يا كوكب مشرق منير</span>
            <span>سائح مالكش نظير</span>
            <span>طوباك يا ابن بولا العظيم</span>
            <span>وعلى طقس مستقيم</span>
            <span>امنت بالديان</span>
            <span>حصون وفخاخ الشيطان</span>
            <span>لمحبتك للاله ايسوس</span>
            <span>تحيطه نى انجيلوس</span>
            <span>زارك القديس العظيم</span>
            <span>لامور تهم الديان</span>
            <span>بقوة الرب الجبار</span>
            <span>بدون سفينة للابحار</span>
            <span>لما دنت ايام القديس</span>
            <span>اعلمته بالطقوس</span>
            <span>اعلمته باليوم والساعة</span>
            <span>واعطيته علامة</span>
            <span>اخبرته برحيلك</span>
            <span>ليحضر تجنيزك</span>
            <span>رتل النبى داود</span>
            <span>مبارك الاتى باسم الودود</span>
            <span>صعد الرب القدوس</span>
            <span>وحوله انجيلوس</span>
            <span>جاهدت فى حياتك</span>
            <span>بقوة زهدك وصلاتك</span>
            <span>طوباك ايها البار</span>
            <span>ذكرك يملا الاقطار</span>
            <span>اسمك على كل لسان</span>
            <span>الى ان ياتى الديان</span>
            <span>اشفع فينا يا قديس</span>
            <span>بصلاتك امام القدوس</span>
            <span>تفسير اسمك فى افواة</span>
            <span>الكل يقولون يا اله</span>
        </div>
        <div class="saint-tamgeed-col" style="text-align:left;">
            <span>واصيح بلسان فصيح</span>
            <span>السلام لك يا انبا توماس</span>
            <span>من قرية تدعى شنشيف</span>
            <span>السلام لك يا انبا توماس</span>
            <span>تركت البشرية</span>
            <span>السلام لك يا انبا توماس</span>
            <span>الى برية شنشيف</span>
            <span>السلام لك يا انبا توماس</span>
            <span>للصوم والصلاة</span>
            <span>السلام لك يا انبا توماس</span>
            <span>كنت بالروح مستنير</span>
            <span>السلام لك يا انبا توماس</span>
            <span>لاقتدائك الكريم</span>
            <span>السلام لك يا انبا توماس</span>
            <span>وهزمت بالايمان</span>
            <span>السلام لك يا انبا توماس</span>
            <span>زارك مرارا القدوس</span>
            <span>السلام لك يا انبا توماس</span>
            <span>شنودة رئيس المتوحدين</span>
            <span>السلام لك يا انبا توماس</span>
            <span>زارك وزرته بالتكرار</span>
            <span>السلام لك يا انبا توماس</span>
            <span>والمقابلة بالفردوس</span>
            <span>السلام لك يا انبا توماس</span>
            <span>ليكون لاولاده آية</span>
            <span>السلام لك يا انبا توماس</span>
            <span>واعطيته دليلك</span>
            <span>السلام لك يا انبا توماس</span>
            <span>بقيثارة و عود</span>
            <span>السلام لك يا انبا توماس</span>
            <span>بروحك للفردوس</span>
            <span>السلام لك يا انبا توماس</span>
            <span>واكمات سعياتك</span>
            <span>السلام لك يا انبا توماس</span>
            <span>فى سائر الديار</span>
            <span>السلام لك يا انبا توماس</span>
            <span>ذكرك يا ابن الايمان</span>
            <span>السلام لك يا انبا توماس</span>
            <span>واخزى عنا ابليس</span>
            <span>السلام لك يا انبا توماس</span>
            <span>كل المؤمنين</span>
            <span>الانبا توماس اعنا اجمعين</span>
        </div>
    </div>
    <div style="text-align:center; color:#ffd700; font-size:1.1rem; margin-top:30px; font-family:'Amiri', serif;">بصلاتك يا أنبا توماس</div>
</div>
@endsection 