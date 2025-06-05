@extends('layouts.app')

@section('title', 'سيرة القديسة دميانة الشهيدة')

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

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes shimmer {
    0% { background-position: -1000px 0; }
    100% { background-position: 1000px 0; }
}

@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
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

.saint-image {
    max-width: 300px;
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.2);
    margin: 20px auto;
    display: block;
    animation: float 6s ease-in-out infinite;
}

.priest-quote {
    background: var(--glass-bg);
    border: 1.5px solid var(--gold);
    border-radius: 20px;
    padding: 30px;
    margin: 40px auto;
    max-width: 800px;
    text-align: center;
    color: #fff;
    font-family: 'Amiri', serif;
    font-size: 1.2rem;
    line-height: 2;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    backdrop-filter: blur(10px);
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
    .saint-image {
        max-width: 200px;
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
        <h1 class="saint-title">القديسة دميانة الشهيدة</h1>
        <div class="saint-subtitle">شفيعة كنيسة القديسة دميانة والانباء توماس السائح</div>
        <div class="quote-box">
            "طوباك يا ستى دميانة الشهيدة، عذاباً كثيراً نلت من الجنود العنيدة"
        </div>
    </div>
</div>

<div class="quick-info">
    <div class="info-card">
        <i class="fas fa-calendar-alt"></i>
        <h3>تاريخ الاستشهاد</h3>
        <p>١٣ طوبة<br>(٢٣ يناير)</p>
    </div>
    <div class="info-card">
        <i class="fas fa-map-marker-alt"></i>
        <h3>مكان الميلاد</h3>
        <p>البرلس والزعفران<br>بوادي السيسبان</p>
    </div>
    <div class="info-card">
        <i class="fas fa-church"></i>
        <h3>شفيعة الكنيسة</h3>
        <p>كنيسة القديسة دميانة<br>والانباء توماس السائح</p>
    </div>
</div>


<div class="saint-story">
    <p>
    وُلدت من أبوين مسيحيين تقيين في أواخر القرن الثالث، كان أبوها مرقس واليًا على البرلس والزعفران بوادي السيسبان. إذ بلغت العام الأول من عمرها تعمدت في دير الميمة جنوب مدينة الزعفران، وأقام والدها مأدبة فاخرة للفقراء والمحتاجين لمدة ثلاثة أيام، بعد فترة انتقلت والدتها.<br><br>
    
    تقدم أحد الأمراء إلى والدها يطلب يدها، وكانت معروفة بتقواها ومحبتها للعبادة مع جمالها وغناها وأدبها. عرض الوالد الأمر عليها، فأجابته: "لماذا تريد زواجي وأنا أود أن أعيش معك؟ هل تريدني أن أتركك؟"<br><br>
    
    تعجب والدها لإجابتها هذه، فأرجأ الحديث عن الزواج. لاحظ على ابنته أنها عشقت الكتاب المقدس وارتوت به، وكانت تلجأ إلى حجرتها الخاصة تسكب دموع الحب الغزيرة أمام الله مخلصها، كما لاحظ تعلقها الشديد بالكنيسة مع كثرة أصوامها وصلواتها، وحضور كثير من الفتيات صديقاتها إليها يقضين وقتهن معها في حياة نسكية تتسم بكثرة الصلوات مع التسابيح المستمرة.<br><br>
    
    في سن الثامنة عشر كشفت عن عزمها على حياة البتولية، فرحب والدها بهذا الاتجاه. ولتحقيق هذه الرغبة بنى لها قصرًا في جهة الزعفران بناءً على طلبها، لتنفرد فيه للعبادة، واجتمع حولها أربعون من العذارى اللواتي نذرن البتولية.<br><br>
    
    فرحت البتول الطاهرة دميانة لمحبة والدها لها التي فاقت المحبة العاطفية المجردة، إذ قدم ابنته الوحيدة ذبيحة حب لله.<br><br>
    
    عاشت القديسة مع صاحباتها حياة نُسكية رائعة. امتزج الصوم بالصلاة مع التسبيح الذي حوَّل القصر إلى سماء يُسمع فيها صوت التهليل المستمر.<br><br>
    
    في أثناء الاضطهاد الذي أثاره دقلديانوس ضعف أبوها مرقس وبخر للأوثان. فما أن سمعت دميانة هذا الخبر حتى خرجت من عزلتها لتقابل والدها. طلبت القديسة دميانة من صديقاتها العذارى أن يصمن ويُصلين لأجل خلاص والدها حتى يرجع عن ضلاله.<br><br>
    
    التقت القديسة بوالدها، وفي شجاعةٍ وبحزمٍ قالت له: "كنت أود أن أسمع خبر موتك عن أن تترك الإله الحقيقي". كما قالت له: "اعلم يا والدي أنك إذا تماديت في هذا الطغيان لست أعرفك وسأكون بريئة منك هنا وأمام عرش الديان حيث لا يكون لك نصيب في الميراث الأبدي الذي أعده الله لمحبيه وحافظي عهده".<br><br>
    
    ألّهبت هذه الكلمات والدموع قلب مرقس، فبكى بكاءً مرًا وندم على ما ارتكبه. في توبة صادقة بروح التواضع المملوء رجاءً قال لها: "مباركة هي هذه الساعة التي رأيتك فيها يا ابنتي. فقد انتشلتيني من الهوة العميقة التي ترديت فيها. وتجددت حياتي استعدادًا لملاقاة ربى العظيم الذي أؤمن أنه يقبلني إليه".<br><br>
    
    وبروح الرجاء شكر الله الذي أيقظ قلبه قائلًا: "أشكرك يا إلهي لأنك نزعت ظلمة الكفر عن قلبي. الفخ انكسر ونحن نجونا..." فتركها للوقت وذهب إلى إنطاكية لمقابلة دقلديانوس وجهر أمامه بالإيمان، وندم عما أتاه من تبخير للأصنام.<br><br>
    
    تعجّب الإمبراطور لتحوّل هذا الوالي المتسم بالطاعة، والذي ترك إيمانه وبخر للأوثان أنه يجاهر بإيمانه بكل قوة. وبخ مرقس الإمبراطور على جحده الإيمان، وحثه على الرجوع إلى الإيمان الحيّ. لم يتسرع الإمبراطور في معاقبته بل استخدم محاولات كثيرة لجذبه إليه، وإذ لم يتراجع مرقس ثارت ثائرة الطاغية، وأمر بقطع رأسه. وكان ذلك في الخامس من أبيب، في عيد الرسل.<br><br>
    
    انتشر الخبر في كل الولاية وتهلل قلب ابنته القديسة دميانة، فقد نجا والدها من الهلاك الأبدي ليُشارك مسيحه أمجاده. وفي نفس الوقت حزن الإمبراطور على مرقس، إذ كان موضع اعتزازه وتقديره.<br><br>
    
    بعد أيام علم دقلديانوس أن ابنته دميانة هي السبب في رجوع مرقس إلى الإيمان المسيحي، فأرسل إليها بعض الجنود، ومعهم آلات التعذيب، للانتقام منها ومن العذارى اللواتي يعشن معها. شاهدت القديسة الجند قد عسكروا حول القصر وأعدوا آلات التعذيب، فجمعت العذارى وبروح النصرة أعلنت أن الإمبراطور قد أعد كل شيء ليُرعبهم، لكن وقت الإكليل قد حضر، فمن أرادت التمتع به فلِتنتظر، وأما الخائفة فلتهرب من الباب الخلفي. فلم يوجد بينهن عذراء واحدة تخشى الموت. بفرحٍ شديدٍ قُلن أنهم متمسكات بمسيحهن ولن يهربن.<br><br>
    
    التقى القائد بالقديسة وأخبرها بأن الإمبراطور يدعوها للسجود للآلهة ويقدم لها كنوزًا كثيرة ويُقيمها أميرة عظيمة. أما هي فأجابته: "أما تستحي أن تدعو الأصنام آلهة، فليس إله سوى رب السماء والأرض. وأنا ومن معي مستعدات أن نموت من أجل اسمه".<br><br>
    
    اغتاظ القائد وأمر أربعة جنود بوضعها داخل الهنبازين لكي تُعْصَر. وكانت العذارى يبكين وهنّ ينظرن إليها تُعصر. أُلقيت في السجن وهي أشبه بميتة، فحضر رئيس الملائكة ميخائيل في منتصف الليل ومسح كل جراحاتها.<br><br>
    
    في الصباح دخل الجند السجن لينقلوا خبر موتها للقائد، فكانت دهشتهم أنهم لم يجدوا أثرًا للجراحات في جسمها. أعلنوا ذلك للقائد، فثار جدًا وهو يقول: "دميانة ساحرة! لابد من إبطال سحرها!" إذ رأتها الجماهير صرخوا قائلين: "إننا نؤمن بإله دميانة"، وأمر القائد بقتلهم.<br><br>
    
    ازداد القائد حنقًا ووضع في قلبه أن ينتقم من القديسة بمضاعفة العذابات، حاسبًا أنها قد ضلَّلت الكثيرين.<br><br>
    
    أمر بتمشيط جسمها بأمشاط حديدية، وتدليكه بالخل والجير، أما هي فكانت متهللة. إذ حسبت نفسها غير أهلٍ لمشاركة السيد المسيح آلامه.<br><br>
    
    أُلقيت في السجن، وفي اليوم الثاني ذهب القائد بنفسه إلى السجن حاسبًا أنه سيجدها جثة هامدة، لكنه انهار حين وجدها سليمة تمامًا، فقد ظهر لها رئيس الملائكة ميخائيل وشفاها.<br><br>
    
    في ثورة عارمة بدأ يُعذبها بطرق كثيرة ككسر جمجمتها وقلع عينيها وسلخ جلدها، لكن حمامة بيضاء نزلت من السماء وحلّقت فوقها فصارت القديسة معافاة.<br><br>
    
    كلما حاول القائد تعذيبها كان الرب يتمجد فيها. أخيرًا أمر بضربها بالسيف هي ومن معها من العذارى، فنلن جميعًا أكاليل الشهادة. وقبل أن يهوي السيف على رقبة القديسة دميانة قالت: "إني أعترف بالسيد المسيح، وعلى اسمه أموت، وبه أحيا إلى الأبد". وكان ذلك في 13 طوبة.<br><br>
    
    مازال جسد الشهيدة دميانة في كنيستها التي شيدتها لها الملكة هيلانة أم الملك قسطنطين، والكائنة قرب بلقاس في شمال الدلتا. قام البابا الكسندروس بتدشينها في اليوم الثاني عشر من شهر بشنس.
    </p>
</div>

<div class="priest-quote">
    <p>
    عندما أقمنا الذبيحة الإلهية على المذبح المقام فوق قبرها جالت بخاطرنا هذه المشاعر المتبادلة :<br>
    الرب يسوع على المذبح مذبوح لأجل القديسة دميانة وهي تحت المذبح مذبوحة لأجل السيد المسيح.<br>
    فوق المذبح ذاك الذي سيق كشاه للذبح وتحت المذبح تلك التي من أجل المسيح حسبت نفسها كغنم للذبح.<br>
    فوق المذبح ذاك الذي مات لأجلها وتحت المذبح تلك التي ماتت كل النهار من أجله.<br>
    <br>
    - القمص بيشوي كامل
    </p>
</div>

<div class="saint-tamgeed" style="background:rgba(255,255,255,0.13); border-radius:20px; box-shadow:0 4px 30px rgba(0,0,0,0.10); border:1.5px solid #ffd700; padding:40px 20px; margin:40px auto; max-width:900px;">
    <img src="{{ asset('images/القديسة-دميانة.jpg') }}" alt="القديسة دميانة الشهيدة" style="max-width:180px; border-radius:16px; box-shadow:0 4px 32px rgba(10, 35, 79, 0.18), 0 0 0 5px rgba(255, 215, 0, 0.18); background:#fffbe6; display:block; margin:0 auto 30px auto;">
    <h2 class="saint-tamgeed-title" style="font-size:2rem; color:#ffd700; margin-bottom:30px; font-family:'Lalezar','Cairo',sans-serif; text-align:center;">كلمات مديح القديسة دميانة الشهيدة</h2>
    <div class="saint-tamgeed-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 0 30px; direction: rtl; max-width: 600px; margin: 0 auto;">
        <div><span>عظيمة بالحقيقة</span><span>كرامتك يا قديسة</span></div>
        <div><span>قد صرت رفيقه</span><span>لشهداء الكنيسه</span></div>
        <div><span>عظيمة بالحقيقة</span><span>أيضا اجتهادك</span></div>
        <div><span>قد صرت عريقه</span><span>في كل أمجادك</span></div>
        <div><span>طوباك يا ستي</span><span>دميانة الشهيدة</span></div>
        <div><span>عذابا كثيرا نلتي</span><span>من الجنود العنيدة</span></div>
        <div><span>طوباك يا مسمية</span><span>دميانة القديسة</span></div>
        <div><span>عذاباتك قوية</span><span>وأكاليلك نفيسة</span></div>
        <div><span>أيتها العفيفة</span><span>دميانة المختارة</span></div>
        <div><span>الجنود العنيفة</span><span>منك صارت محتارة</span></div>
        <div><span>تركت الأرضيات</span><span>وكل ما فيها</span></div>
        <div><span>وغويت السماويات</span><span>وأحببت أقاصيها</span></div>
        <div><span>أحببت البتولية</span><span>وأنت كنت صغيرة</span></div>
        <div><span>في سن الطفولية</span><span>يا نجمة منيرة</span></div>
        <div><span>أحببت الطهارة</span><span>أيتها القديسة</span></div>
        <div><span>وصرت كمنارة</span><span>لأولاد الكنيسة</span></div>
        <div><span>أحببت الانعزال</span><span>عن الجبلة البشرية</span></div>
        <div><span>وتحليت بالكمال</span><span>كالطقوس النورانية</span></div>
        <div><span>أحببت البراري</span><span>وسكنت نواحيها</span></div>
        <div><span>وأيضا الرب الباري</span><span>أسطع نورك فيها</span></div>
        <div><span>طلبت من أبيك</span><span>برجا منفردا</span></div>
        <div><span>لتعبدي باريك</span><span>وتركتي العالم أجمع</span></div>
        <div><span>فأجاب لك طلبك</span><span>وبنى لك قصرا جميلا</span></div>
        <div><span>حسب سؤال قلبك</span><span>للتسابيح والترتيل</span></div>
        <div><span>اخترت أربعين عذراء</span><span>موصوفات بالطهارة</span></div>
        <div><span>وظفرتن بالنعمة</span><span>ونطقتن بمهارة</span></div>
        <div><span>حتى جعلتن جنود</span><span>من أفعالكم مخزية</span></div>
        <div><span>لما تبعتن المعبود</span><span>يا بكر ونقية</span></div>
        <div><span>وأيضا مرقس أبيك</span><span>لما تبع الكافر</span></div>
        <div><span>ردتيه بمعانيك</span><span>ولفظك الباهر</span></div>
        <div><span>طوباك طوباك</span><span>يا من تعاليت</span></div>
        <div><span>أنيريني بضياك</span><span>لأنك قويت</span></div>
        <div><span>طوباك طوباك</span><span>يا من قد انتصرت</span></div>
        <div><span>اقبليني في حماك</span><span>لأنك ظفرت</span></div>
        <div><span>سألت أنا الخاطي</span><span>من بكرة وبتول</span></div>
        <div><span>أن ترفع صلاتي</span><span>وتساعدني حين أقول</span></div>
        <div><span>يا كوكب مشرق</span><span>في سيرة العذارى</span></div>
        <div><span>كوني لي منوري</span><span>في وسط الخطاة</span></div>
        <div><span>يا من صبرت</span><span>على كل عذاب</span></div>
        <div><span>صلي من أجلي</span><span>لكي أنال الثواب</span></div>
        <div><span>الكل يقولون يا إله</span><span>دميانة اعنا أجمعين</span></div>
    </div>
    <div style="text-align:center; color:#ffd700; font-size:1.1rem; margin-top:30px; font-family:'Amiri', serif;">بصلاتك يا قديسة دميانة</div>
</div>
@endsection 