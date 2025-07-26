@extends('layouts.app')

@section('title', 'القراءات اليومية')

@section('content')
<div class="container py-5">
    @if($coptic_date)
        <div class="text-center mb-3" style="font-size:1.5em; color:#FFD700;">
            التاريخ القبطي: {{ $coptic_date }}
        </div>
    @endif
    <div class="mb-4" style="border-radius: 20px;">
        <div class="card-body p-0">
            <h2 class="text-center mb-4" style="color: #FFD700; font-weight: bold;">القراءات اليومية</h2>
            <div class="row mb-3 justify-content-center">
                <div class="col-md-4 mb-2 d-flex align-items-center justify-content-center">
                    <!--
                    <button id="prev-day-btn" class="btn btn-secondary mx-2" style="min-width: 80px;">اليوم السابق</button>
                    -->
                    <input type="date" id="date-picker" class="form-control text-center mx-2" value="{{ request('date', date('Y-m-d')) }}" style="max-width: 200px;">
                    <button id="search-date-btn" class="btn btn-primary mx-2" style="min-width: 80px;">بحث</button>
                </div>
            </div>
            <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
                <button class="reading-btn btn btn-lg px-4 py-2 reading-btn-gold" data-reading="العشية">العشية</button>
                <button class="reading-btn btn btn-lg px-4 py-2 reading-btn-blue" data-reading="باكر">باكر</button>
                <button class="reading-btn btn btn-lg px-4 py-2 reading-btn-gold" data-reading="البولس">البولس</button>
                <button class="reading-btn btn btn-lg px-4 py-2 reading-btn-blue" data-reading="الكاثوليكون">الكاثوليكون</button>
                <button class="reading-btn btn btn-lg px-4 py-2 reading-btn-gold" data-reading="الإبركسيس">الإبركسيس</button>
                <button class="reading-btn btn btn-lg px-4 py-2 reading-btn-blue" data-reading="السنكسار">السنكسار</button>
                <button class="reading-btn btn btn-lg px-4 py-2 reading-btn-gold" data-reading="الإنجيل">الإنجيل</button>
            </div>
            <div id="reading-content-box" class="p-4 rounded shadow-sm text-center mb-4" style="background: rgba(10,42,79,0.85); color: #fff; min-height: 120px; display: none;">
                <h4 id="reading-title" style="color: #FFD700;"></h4>
                <div id="reading-content"></div>
            </div>
            <div id="seneksar-content-box" class="p-4 rounded shadow-sm text-center mb-4" style="background: rgba(10,42,79,0.85); color: #fff; min-height: 120px; display: none;">
                <h4 class="seneksar-title">السنكسار</h4>
                <div id="seneksar-content">
                    @php
                        $shown_titles = [];
                    @endphp
                    @php
                        $blessingEndings = [
                            'له المجد في كنيسته إلى الأبد آمين',
                            'بركة شفاعة هؤلاء الأطفال الشهداء فلتكن معنا. و لربنا المجد دائماً أبدياً آمين',
                            'بركة صلوات الجميع فلتكن معنا. و لربنا المجد دائماً أبدياً آمين',
                            'بركة صلواتهم فلتكن معنا. آمبن.',
                            'شفاعة رئيس الملائكة الجليل رافائيل تكون معنا آمين.',
                            'شفاعتها فلتكن معنا. آمين.',
                            'بركة صلواتهم فلتكن معنا. آمين.',
                            'بركة صلواته فلتكن معنا. و لربنا المجد دائماً أبدياً آمين.',
                            'بركة صلواته فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.',
                            'بركة صلواته فلتكن معنا. آمبن.',
                            'بركة صلواته فلتكن معنا. آمين.',
                            'بركة صلواته فلتكن معنا. آمين',
                            'بركة صلواته فلتكن معنا. و لربنا المجد دائماً أبدياً آمين',
                            'بركة صلواته فلتكن معنا. و لربنا المجد دائماً أبدياً آمين',
                            'بركة صلواتهما فلتكن معنا. و لربنا المجد دائماً أبدياً آمين',
                            'بركة صلواتهم فلتكن معنا. و لربنا المجد دائماً أبدياً آمين',
                            'بركة صلواته فلتكن معنا آمين',
                            'بركة صلواتها فلتكن معنا. آمين',
                            'له المجد والكرامة إلى ابد الآبدين ودهر الدهور امين.',
                            'له المجد الدائم إلى الأبد آمين',
                            'بركة مخلصنا الصالح الذي اعتمد لأجلنا فلتشملنا جميعاً آمين.',
                            'بركة صلواته فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.',
                            'بركة صلواتهما فلتكن معنا. آمبن.',
                            'بركة صلواتهما فلتكن معنا. آمين.',
                            'بركة صلوات القديس أباكلوج فلتكن معنا. آمبن.',
                            'بركة صلواتها فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.',
                            'بركة صلواتها فلتكن معنا. آمين.',
                            'بركة صلوات هذا الشهيد الطاهر فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.',
                            'بركة القديس مارمرقس الرسول فلتكن معنا. آمبن.',
                            'بركة صلوات الجميع فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.',
                            'بركة صلوات القديس أبا فيس فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.',
                            'شفاعته المقدسة فلتكن معنا. آمين.',
                            'بركة هذا النبي العظيم فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.',
                            'بركة صلوات هؤلاء القديسين فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.',
                            'شفاعتها المقدسة فلتكن معنا. آمبن.',
                            'شفاعتها المقدسة فلتكن معنا. آمين.',
                            'بركة صلواتها فلتكن معنا. آمبن.',
                            'بركة صلواته فلتكن معنا، و لربنا المجد دائماً أبدياً آمين',
                            'بركة صلواته فلتكن معنا، و لربنا المجد دائماً أبدياً آمين',
                            'بركة صلواتهم فلتكن معنا آمين.',
                            'بركة صلواته المقدسة فلتكن معنا آمين.',
                            'بركة صلوات آباء هذا المجمع فلتكن معنا آمين.',
                            'بركة صلواتهم فلتكن معنا و لربنا المجد دائما أبديا آمين.',
                            'بركة صلاة القديس باسيليوس فلتكن معنا آمين.',
                            'بركة الصليب المجيد فلتكن معنا آمين.',
                            'بركة الصليب المجيد فلتكن معنا آمين.',
                            'بركة هذه الأعياد فلتكن معنا آمين.',
                            'بركة صلواتها فلتكن معنا، و لربنا المجد دائماً أبديا آمين.',
                            'بركة صلواتها فلتكن معنا، و لربنا المجد دائماً أبديا آمين.',
                            'بركة صلوات هذا القديس فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.',
                            'بركة صلوات الرسول فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.',
                            'بركة صلواتهما فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.',
                            'بركة صلوات القديس الشهيد إيسوذوروس فلتكن معنا. و لربنا المجد دائماً أبدياً آمين.',
                            'فتنيّحوا بسلام و نالوا أكاليل الشهادة.بركة صلواتهم فلتكن معنا. آمين',
                            'بركة الصليب المجيد فلتكن معنا. و لربنا المجد دائماً أبدياً آمين.',
                            'بركة القديس يوحنا المعمدان فلتكن معنا. آمين.',
                            'بركة شفاعته المقدسة فلتكن معنا. آمين.',
                            'بركة صلواته فلتكن معنا، و لربنا المجد دائماً أبديا آمين.',
                            'بركة صلواته فلتكن معنا و لربنا المجد دائماً أبديا آمين.',
                            'بركة صلواتهما فلتكن معنا، و لربنا المجد دائماً أبديا آمين.',
                            'بركة صلوات القديس البابا ديونيسيوس فلتكن معنا، و لربنا المجد دائماً أبديا آمين.',
                            'بركة مخلصنا الصالح فلتكن معنا آمين.',
                            'بركة صلوات القديس مار مرقس الإنجيلي الرسول فلتكن معنا آمين.',
                            'شفاعة القديسة العذراء مريم فلتكن معنا آمين.',
                            'شفاعتهم فلتكن معنا آمين.',
                            'بركة صلواته فلتكن معنا، و لربنا المجد الدائم إلى الأبد آمين.',
                            'شفاعة هذا الملاك الجليل فلتكن معنا آمين.',
                            'شفاعته فلتكن معنا آمين.',
                            'له المجد الدائم إلى الأبد آمين.',
                            'بركة شفاعتها فلتكن معنا. آمين.',
                            'و لربنا المجد دائماً أبدياً آمين.',
                            'بركة صلواتهم فلتكن معنا. آمين',
                            'بركة صلواتها فلتكن معنا. و لربنا المجد دائماً أبدياً آمين.',
                            'فليشملنا ببركاته و يعيننا. آمين.',
                            'بركة بُشرى الخلاص فلتكن معنا. آمين',
                            'شفاعته المقدسة فلتكن معنا. آمين',
                            'بركته المقدسة فلتكن معنا. آمين',
                            'و لإلهنا المجد دائماً أبدياً آمين.',
                            'بركة مخلّصنا الصالح فلتكن معنا. آمين.',
                            'فليشملنا ببركته المقدسة آمين.',
                            'له المجد دائماً أبدياً آمين.',
                            'بركة صلاة هذا النبي العظيم فلتكن معنا. آمين.',
                            'بركة صلوات القديس متاؤس فلتكن معنا ولربنا المجد دائماً أبدياً آمين',
                            'بركة صلوات الناسك العابد واللاهوتي البارع ديديموس الضرير فلتكن معنا ولربنا المجد دائماً أبدياً آمين',
                            'بركة شفاعة رئيس الملائكة ميخائيل فلتكن معنا. آمين',
                            'بركة صلوات القديس مار مينا العجايبي فلتكن معنا. آمين.',
                            'بركة القديس مار مرقس الرسول الإنجيلي فلتكن معنا. و لربنا المجد دائماً أبدياً آمين',
                            'شفاعتها المقدسة فلتكن معنا. آمين',
                            'بركة صلواته فلتكن معنا. و لربنا المجد دائماً أبدياً. آمين.',
                            'بركة صلواته فلتكن معنا.و لربنا المجد دائماً أبدياً آمين.',
                            'بركة صلواته فلتكن معنا. ولربنا المجد دائماً أبدياً آمين.',
                            'بركة صلوات وشفاعات هذا القديس العظيم السابق الصابغ فلتكن معنا. آمين.',
                            'بركة الشهيد مار مينا العجايبى فلتكن معنا. ولربنا المجد دائماً أبدياً آمين',
                            'بركة صلواته فلتكن معنا آمين.',
                            'بركة صلواتهما فلتكن معنا. آمين',
                            'بركة صلوات القديس العظيم الأنبا إشعياء فلتكن معنا. و لربنا المجد دائماً أبدياً آمين',
                            'شفاعته فلتكن معنا. آمين.',
                            'بركة صلواتها فلتكن معنا. ولربنا المجد دائماً أبدياً آمين.',
                            'بركة صلوات القديس العظيم مرقوريوس أبي سيفين فلتكن معنا. آمين.',
                            'بركة صلوات القديس أندراوس فلتكُن معنا . آمين.',
                            'بركة صلواتها فلتكن معنا. و لربنا المجد دائماً أبدياً آمين',
                            'بركة صلواتها فلتكن معنا آمين.',
                            'بركة صلواته فلتكن معنا و لربنا المجد دائماً أبدياً آمين',
                            'بركة صلواتها فلتكن معنا آمين.',
                            'شفاعة القديسة الطاهرة مريم فلتكن معنا. آمين.',
                            'بركة صلوات هذا النبي العظيم فلتكن معنا. آمين.',
                            'بركة صلواتهما فلتكن معنا آمين.',
                            'نطلب من الله أن يجدد حياتنا و يحفظنا بغير خطية بشفاعة القديسة العذراء مريم و طلبات جميع الشهداء الأطهار آمين.',
                            'فليعطنا الرب نعمة الاحتمال ببركة صلوات هذا الصديق العظيم آمين.',
                            'الله يرحمنا بشفاعة سيدتنا كلنا العذراء والدة الإله و صلوات الشهيد وادامون المؤمن الطاهر و لربنا المجد دائماً أبدياً آمين',
                            'بركة هذا العيد المجيد فلتكن معنا. آمين.'
                        ];
                        // إزالة التكرار
                        $blessingEndings = array_unique($blessingEndings);
                        // بناء regex
                        $blessingPattern = '/(^|[\\s\\n\\r])(' . implode('|', array_map(function($ending) {
                            return preg_quote($ending, '/');
                        }, $blessingEndings)) . ')(?=$|[\\s\\n\\r])/ui';
                    @endphp
                    @foreach($seneksar as $i => $story)
                        @php
                            $story_hash = md5($story->title . '|' . mb_substr($story->content, 0, 100));
                        @endphp
                        @if(in_array($story_hash, $shown_titles)) @continue @endif
                        @php
                            $shown_titles[] = $story_hash;
                        @endphp
                        @php
                            // قطع النص عند أول ظهور لأي خاتمة
                            if (preg_match($blessingPattern, $story->content, $match, PREG_OFFSET_CAPTURE)) {
                                $content_cut = mb_substr($story->content, 0, $match[0][1] + mb_strlen($match[0][0]));
                            } else {
                                $content_cut = $story->content;
                            }
                            // لا تقطع النص، اعرضه كله بجانب الصورة
                            $side_text = $content_cut;
                            $bottom_text = '';
                        @endphp
                        <div class="seneksar-story mb-5 pb-4" style="border-bottom:1px solid #FFD70033; overflow: hidden;">
                            <div class="seneksar-text-box text-right px-4 seneksar-mobile-stack">
                                <h2 class="seneksar-title" style="color:#FFD700; font-weight:bold; font-size:2.2em; margin-bottom:1em;">{{ $story->title }}</h2>
                                @if($story->image_url)
                                    <img src="{{ $story->image_url }}" alt="{{ $story->title }}"
                                        class="seneksar-img-float"
                                        style="float:right; margin-left:2em; margin-bottom:1em; max-width:400px; max-height:520px; border:4px solid #FFD700; border-radius:18px; background:#fff; padding:6px; box-shadow:0 4px 24px #FFD70055, 0 2px 12px #0002;">
                                @endif
                                <div style="font-size:1.25em;line-height:2.1; color:#fff;">
                                    {!! nl2br(
                                        preg_replace(
                                            $blessingPattern,
                                            '$1<span class="seneksar-blessing" style="color:#FFD700; font-weight:bold; font-size:1.15em;">$2</span>',
                                            e($side_text)
                                        )
                                    ) !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @php
        $groupedReadings = $readings;
    @endphp
    @if(!isset($readings) || !count($readings))
        <div class="alert alert-warning text-center">لا توجد قراءات في قاعدة البيانات.</div>
    @endif
    @if(isset($prophecies) && count($prophecies))
        <button class="reading-btn btn btn-lg px-4 py-2 reading-btn-gold" id="prophecies-btn" style="margin-bottom: 10px;">النبوات</button>
    @endif
    @if(isset($prophecies) && count($prophecies))
        <div id="prophecies-content-box" class="p-4 rounded shadow-sm text-center mb-4" style="background: rgba(10,42,79,0.85); color: #fff; min-height: 120px; display: none;">
            <h4 style="color: #FFD700;">النبوات</h4>
            @foreach($prophecies as $prophecy)
                <div class="mb-3">
                    <div style="color:#FFD700; font-weight:bold;">{{ $prophecy->ref_text }}</div>
                    <div>{!! $prophecy->description !!}</div>
                </div>
            @endforeach
        </div>
    @endif
    <footer class="text-center mt-5" style="color: #FFD700; font-weight: 400; font-size: 1em; background: none; border: none;">
        <span>جميع الحقوق محفوظة &copy; مدرسة الشمامسة {{ date('Y') }}</span>
    </footer>
</div>
<style>
    .reading-btn-gold {
        background: #FFD700;
        color: #0A2A4F;
        font-weight: bold;
        border: none;
        transition: all 0.2s;
    }
    .reading-btn-blue {
        background: #0A2A4F;
        color: #FFD700;
        font-weight: bold;
        border: none;
        transition: all 0.2s;
    }
    .reading-btn-gold:hover, .reading-btn-blue:focus {
        background: #0A2A4F !important;
        color: #FFD700 !important;
        box-shadow: 0 0 10px #FFD70055;
        outline: none;
    }
    .reading-btn-blue:hover, .reading-btn-gold:focus {
        background: #FFD700 !important;
        color: #0A2A4F !important;
        box-shadow: 0 0 10px #FFD70055;
        outline: none;
    }
    #reading-content-box {
        background: rgba(10,42,79,0.85); /* نفس خلفية السنكسار */
        color: #fff !important;           /* الخط أبيض */
        border-radius: 18px;
        box-shadow: 0 4px 24px #FFD70055, 0 2px 12px #0002;
        padding: 2.5em 2em;
        font-size: 1.25em;
        line-height: 2.1;
        margin-bottom: 2.5em;
        text-align: right;
        min-height: 120px;
        white-space: normal !important;
        word-break: break-word !important;
        overflow-wrap: break-word !important;
        direction: rtl;
    }
    .reading-section-title, .reading-main-title {
        color: #FFD700 !important;
        font-weight: bold;
        font-size: 2em;
        margin-bottom: 1.2em;
        text-align: center !important;
        letter-spacing: 1px;
        text-shadow: 0 2px 8px #0006, 0 0 20px #FFD70055;
    }
    .reading-reference {
        color: #FF1744 !important;
        font-size: 1.3em !important;
        font-weight: bold !important;
        text-align: center !important;
        display: block;
        margin-bottom: 1.2em;
        margin-top: 0.8em;
        letter-spacing: 0.5px;
        text-shadow: 0 2px 8px #0003;
    }
    .reading-hallelujah, .reading-glory {
        color: #FFD700 !important;
        font-weight: bold;
        font-size: 1.3em;
        text-align: center !important;
        display: block;
        margin: 1.2em auto 1em auto;
        letter-spacing: 1px;
    }
    #reading-content-box p, #reading-content-box div, #reading-content-box span {
        /* color: #fff !important; */  /* <-- احذف أو علّق هذا السطر */
        font-size: 1.15em;
        font-weight: 400;
        background: none !important;
        text-align: center !important;
        direction: rtl !important;
        white-space: normal !important;
        word-break: break-word !important;
        overflow-wrap: break-word !important;
        line-height: 2.1;
    }
    #reading-content-box h4,
    #reading-content-box .reading-section-title {
        color: #FFD700;
        font-weight: bold;
        font-size: 2em;
        margin-bottom: 1em;
        text-align: right;
    }
    #reading-content-box .reading-conclusion {
        color: #FFD700CC;
        font-style: italic;
        margin-top: 18px;
        font-size: 1.15em;
        letter-spacing: 0.5px;
    }
    #reading-content-box div[style*="font-weight:bold; color:red"] {
        color: #FFD700 !important;
        font-size: 1.3em !important;
        margin-top: 1.5em !important;
        margin-bottom: 0.7em !important;
        font-weight: bold !important;
    }
    #reading-content-box * {
        font-size: 1.35em;
        background: none !important;
        text-align: center !important; /* <-- اجعل كل شيء في المنتصف */
        direction: rtl !important;
        white-space: normal !important;
        word-break: break-word !important;
        overflow-wrap: break-word !important;
        line-height: 2.1;
    }
    #reading-content-box .reading-btn {
        background: #FFD700;
        color: #0A2A4F;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        padding: 0.5em 1.5em;
        margin: 0.5em;
        transition: all 0.2s;
    }
    #reading-content-box > div {
        margin-bottom: 2.2em !important;
    }
    #reading-content-box div[style*="color:#FFD700"] {
        font-size: 1.15em;
    }
    #reading-content-box, #reading-content, .seneksar-bottom-text, .seneksar-text-box {
        white-space: normal !important;
        word-break: break-word !important;
        overflow-wrap: break-word !important;
        direction: rtl; /* لو النص عربي */
        text-align: right;
    }
    @media (max-width: 600px) {
        #reading-content-box {
            font-size: 1em;
        }
        #reading-content-box h4 {
            font-size: 1.2em;
        }
    }
    footer {
        background: none !important;
        border: none !important;
        box-shadow: none !important;
    }
    .seneksar-story {
        background: rgba(10,42,79,0.7);
        border-radius: 18px;
        padding: 2em 1em 2em 1em;
        margin-bottom: 2.5em;
        display: flex;
        flex-wrap: wrap;
        align-items: flex-start;
        justify-content: center;
    }
    .seneksar-img-box {
        margin-left: 2em;
        margin-right: 2em;
    }
    .seneksar-story h2 {
        color: #FFD700;
        font-size: 2.2em;
        font-weight: bold;
        margin-bottom: 1em;
        text-align: right;
    }
    .seneksar-blessing {
        color: #FFD700 !important;
        font-weight: bold !important;
        font-size: 1.15em !important;
        display: block !important;
        margin-top: 1em !important;
        text-align: center !important;
        background: rgba(255, 215, 0, 0.1) !important;
        padding: 0.5em !important;
        border-radius: 8px !important;
    }
    .seneksar-img-box img.seneksar-img {
        margin-bottom: 1em;
        border: 4px solid #FFD700;
        box-shadow: 0 4px 24px #FFD70055, 0 2px 12px #0002;
        border-radius: 18px;
        background: #fff;
        padding: 6px;
        max-width: 400px;
        max-height: 520px;
        width: 100%;
        object-fit: cover;
    }
    .seneksar-text-box {
        max-width: 600px;
        min-width: 300px;
        /* لا يوجد max-height أو overflow */
    }
    .seneksar-bottom-text {
       width: 100% !important;
       flex-basis: 100% !important;
       margin-top: 2em;
       padding: 0 2em;
        /* لو فيه مشكلة في التداخل */
        box-sizing: border-box;
    }
    @media (max-width: 900px) {
        .seneksar-img-box img.seneksar-img {
            max-width: 95vw;
            max-height: 250px;
        }
        .seneksar-text-box, .seneksar-bottom-text {
            max-width: 100% !important;
            padding: 0 0.5em !important;
        }
    }
    #reading-content-box,
    #reading-content,
    .seneksar-bottom-text,
    .seneksar-text-box {
        white-space: normal !important;
        word-break: break-word !important;
        overflow-wrap: break-word !important;
        overflow-x: hidden !important;
        max-width: 100% !important;
        box-sizing: border-box !important;
        direction: rtl !important;
        text-align: right !important;
    }
    .seneksar-story {
        flex-wrap: wrap !important;
    }
    #reading-content-box * {
        white-space: normal !important;
        word-break: break-word !important;
        overflow-wrap: break-word !important;
        overflow-x: hidden !important;
        max-width: 100% !important;
        box-sizing: border-box !important;
        direction: rtl !important;
        text-align: right !important;
    }
    .seneksar-story {
        align-items: flex-start !important;
    }
    .seneksar-img-box {
        flex-shrink: 0;
    }
    .seneksar-text-box {
        flex: 1 1 350px;
        min-width: 300px;
        max-width: 600px;
        margin-top: 1em;
    }
    @media (max-width: 768px) {
        .seneksar-story {
            flex-direction: column !important;
            align-items: center !important;
        }
    }
    @media (max-width: 768px) {
        .seneksar-story {
            flex-direction: column !important;
            align-items: stretch !important;
        }
        .seneksar-img-box,
        .seneksar-text-box {
            max-width: 100% !important;
            width: 100% !important;
            margin: 0 !important;
            text-align: center !important;
            padding: 0 !important;
        }
        .seneksar-img-box img {
            max-width: 95vw !important;
            height: auto !important;
            margin-bottom: 1em !important;
        }
        .seneksar-text-box {
            margin-top: 0.5em !important;
        }
    }
    .seneksar-img-float {
        float: right;
        margin-left: 2em;
        margin-bottom: 1em;
        max-width: 400px;
        max-height: 520px;
        border: 4px solid #FFD700;
        border-radius: 18px;
        background: #fff;
        padding: 6px;
        box-shadow: 0 4px 24px #FFD70055, 0 2px 12px #0002;
    }
    @media (max-width: 768px) {
        .seneksar-img-float {
            float: none !important;
            display: block;
            margin: 0 auto 1em auto !important;
            max-width: 95vw !important;
            height: auto !important;
        }
        .seneksar-title {
            text-align: center !important;
            font-size: 1.3em !important;
            margin-bottom: 0.7em !important;
        }
        .seneksar-mobile-stack {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 !important;
        }
        .seneksar-mobile-stack > * {
            width: 100% !important;
            max-width: 100% !important;
            text-align: center !important;
        }
    }
    /* أزل أي overflow أو height يسبب سكرول */
    .seneksar-story,
    .seneksar-text-box,
    .seneksar-mobile-stack {
        overflow: visible !important;
        max-height: none !important;
        height: auto !important;
    }
    @media (max-width: 768px) {
        .seneksar-story,
        .seneksar-text-box,
        .seneksar-mobile-stack {
            overflow: visible !important;
            max-height: none !important;
            height: auto !important;
        }
    }
    .seneksar-title {
        text-align: center !important;
        font-size: 2.2em;
        color: #FFD700;
        font-weight: bold;
        margin-bottom: 1em;
    }
    .reading-main-title {
        color: #FFD700 !important;
        font-weight: bold;
        font-size: 2.2em;
        margin-bottom: 1.2em;
        text-align: center !important;
        letter-spacing: 1px;
        display: block;
    }
    .reading-reference {
        color: #ff3333 !important;
        font-size: 1.1em;
        font-weight: bold;
        text-align: center !important;
        display: block;
        margin-bottom: 1em;
        margin-top: 0.5em;
    }
    .reading-glory-center {
        color: #FFD700 !important;
        font-weight: bold !important;
        font-size: 1.2em !important; /* نفس حجم هللويا */
        text-align: center !important;
        margin: 1.5em auto 1.2em auto;
        letter-spacing: 1px;
        display: block;
        background: none;
        text-shadow: 0 2px 8px #0006, 0 0 20px #FFD70055;
    }
    .reading-hallelujah-center {
        color: #FFD700 !important;
        font-weight: bold !important;
        font-size: 1.2em !important; /* أصغر من قبل */
        text-align: center !important;
        margin: 1.5em auto 1.2em auto;
        letter-spacing: 1px;
        display: block;
        background: none !important;
        text-shadow: 0 2px 8px #0006, 0 0 20px #FFD70055;
        border-radius: 0 !important;
        box-shadow: none !important;
        padding: 0 !important;
    }
    #reading-content-box > div, #reading-content-box > div > div, #reading-content-box .reading-reference, #reading-content-box .reading-glory-center, #reading-content-box .reading-hallelujah-center {
        text-align: center !important;
        margin-left: auto !important;
        margin-right: auto !important;
    }
    #reading-content-box .reading-reference,
    #reading-content-box [style*="color:#136bf1"],
    #reading-content-box [style*="color:#0000ff"] {
        color: #FF1744 !important;
        background: none !important;
    }

    #reading-content-box p,
    #reading-content-box div[style*="color:#000000"],
    #reading-content-box span[style*="color:#000000"] {
        color: #fff !important;
    }
    #reading-content-box p[style*="color:#136bf1"],
    #reading-content-box p[style*="color:#0000ff"],
    #reading-content-box p[style*="color: #136bf1"],
    #reading-content-box p[style*="color: #0000ff"] {
        color: #FF1744 !important;
        background: none !important;
    }
    #reading-content-box [style*="color:#136bf1"],
    #reading-content-box [style*="color:#0000ff"],
    #reading-content-box [style*="color: #136bf1"],
    #reading-content-box [style*="color: #0000ff"] {
        color: #FF1744 !important;
        background: none !important;
    }
</style>
<script>
    // عرض التاريخ الميلادي تلقائيًا
    document.addEventListener('DOMContentLoaded', function() {
        const now = new Date();
        const gregorian = now.toLocaleDateString('ar-EG', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        const gregorianElem = document.getElementById('gregorian-date');
        if (gregorianElem) {
            gregorianElem.textContent = gregorian;
        }
        // زر البحث بجانب التاريخ
        const btn = document.getElementById('search-date-btn');
        const input = document.getElementById('date-picker');
        if (!btn) {
            console.log('❌ زر البحث غير موجود أو الـ id غير صحيح!');
            return;
        }
        if (!input) {
            console.log('❌ input التاريخ غير موجود أو الـ id غير صحيح!');
            return;
        }
        btn.addEventListener('click', function() {
            console.log('✅ تم الضغط على زر البحث');
            const date = input.value;
            console.log('📅 التاريخ المختار:', date);
            if(date) {
                const url = '?date=' + date;
                console.log('➡️ سيتم تحويل الصفحة إلى:', url);
                window.location.href = url;
            } else {
                console.log('❌ لم يتم اختيار تاريخ!');
            }
        });
        // دعم الضغط على Enter في حقل التاريخ
        document.getElementById('date-picker').addEventListener('keydown', function(e) {
            if(e.key === 'Enter') {
                document.getElementById('search-date-btn').click();
            }
        });
    });
    // عبارات الخاتمة المميزة
    const blessingEndings = [
        "له المجد في كنيسته إلى الأبد آمين",
        "بركة شفاعة هؤلاء الأطفال الشهداء فلتكن معنا. و لربنا المجد دائماً أبدياً آمين",
        "بركة صلوات الجميع فلتكن معنا. و لربنا المجد دائماً أبدياً آمين",
        "بركة صلواتهم فلتكن معنا. آمبن.",
        "بركة صلواتهم فلتكن معنا. آمين.",
        "بركة صلواته فلتكن معنا. و لربنا المجد دائماً أبدياً آمين.",
        "بركة صلواته فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.",
        "بركة صلواته فلتكن معنا. آمبن.",
        "بركة صلواته فلتكن معنا. آمين.",
        "بركة صلواته فلتكن معنا. آمين",
        "بركة صلواته فلتكن معنا. و لربنا المجد دائماً أبدياً آمين",
        "بركة صلواته فلتكن معنا. و لربنا المجد دائماً أبدياً آمين",
        "بركة صلواتهما فلتكن معنا. و لربنا المجد دائماً أبدياً آمين",
        "بركة صلواتهم فلتكن معنا. و لربنا المجد دائماً أبدياً آمين",
        "بركة صلواته فلتكن معنا آمين",
        "بركة صلواتها فلتكن معنا. آمين",
        "له المجد والكرامة إلى ابد الآبدين ودهر الدهور امين.",
        "له المجد الدائم إلى الأبد آمين",
        "بركة مخلصنا الصالح الذي اعتمد لأجلنا فلتشملنا جميعاً آمين.",
        "بركة صلواته فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.",
        "بركة صلواتهما فلتكن معنا. آمبن.",
        "بركة صلواتهما فلتكن معنا. آمين.",
        "بركة صلوات القديس أباكلوج فلتكن معنا. آمبن.",
        "بركة صلواتها فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.",
        "بركة صلواتها فلتكن معنا. آمين.",
        "بركة صلوات هذا الشهيد الطاهر فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.",
        "بركة القديس مارمرقس الرسول فلتكن معنا. آمبن.",
        "بركة صلوات الجميع فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.",
        "بركة صلوات القديس أبا فيس فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.",
        "شفاعته المقدسة فلتكن معنا. آمين.",
        "بركة هذا النبي العظيم فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.",
        "بركة صلوات هؤلاء القديسين فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.",
        "شفاعتها المقدسة فلتكن معنا. آمبن.",
        "شفاعتها المقدسة فلتكن معنا. آمين.",
        "بركة صلواتها فلتكن معنا. آمبن.",
        "بركة صلوات هذا القديس فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.",
        "بركة صلوات الرسول فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.",
        "بركة صلواتهما فلتكن معنا. و لربنا المجد دائماً أبدياً آمبن.",
        "بركة صلوات القديس الشهيد إيسوذوروس فلتكن معنا. و لربنا المجد دائماً أبدياً آمين.",
        "فتنيّحوا بسلام و نالوا أكاليل الشهادة.بركة صلواتهم فلتكن معنا. آمين",
        "بركة الصليب المجيد فلتكن معنا. و لربنا المجد دائماً أبدياً آمين.",
        "بركة القديس يوحنا المعمدان فلتكن معنا. آمين.",
        "بركة شفاعته المقدسة فلتكن معنا. آمين.",
        "و لربنا المجد دائماً أبدياً آمين.",
        "بركة صلواتهم فلتكن معنا. آمين",
        "بركة صلواتها فلتكن معنا. و لربنا المجد دائماً أبدياً آمين.",
        "فليشملنا ببركاته و يعيننا. آمين.",
        "بركة بُشرى الخلاص فلتكن معنا. آمين",
        "له المجد دائماً أبدياً آمين.",
        "فليحفظنا الرب من مكائد الشرير. و لإلهنا المجد دائماً أبدياً آمين."
    ];
    const blessingRegex = new RegExp('(^|[\\s\\n\\r])(' + blessingEndings.map(e => e.replace(/[.*+?^${}()|[\\]\\]/g, '\\$&')).join('|') + ')(?=$|[\\s\\n\\r])', 'g');
    function highlightBlessings(text) {
        text = text.replace(/([\n\r]?)(\s*)[\(\[]?والمجد\s+لله\s+دائماً[\)\]]?(\s*)/gi, function(match) {
            return '<div class="reading-glory-center">والمجد لله دائماً</div>';
        });
        text = text.replace(/([\n\r]?)(\s*)هللويا[.!؟،\s]*/gi, function(match) {
            return '<div class="reading-hallelujah-center">هللويا.</div>';
        });
        return text;
    }
    // جلب القراءات من السيرفر (هتكون جروب حسب النوع)
    const readings = @json($readings);
    document.querySelectorAll('.reading-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const key = this.getAttribute('data-reading');
            const box = document.getElementById('reading-content-box');
            const seneksarBox = document.getElementById('seneksar-content-box');
            const title = document.getElementById('reading-title');
            const content = document.getElementById('reading-content');
            // إخفاء كل الصناديق أولاً
            box.style.display = 'none';
            seneksarBox.style.display = 'none';

            if (key === 'السنكسار') {
                seneksarBox.style.display = 'block';
                return; // عشان ما يكملش باقي الكود
            }

            if (readings[key] && readings[key].length > 0) {
                title.textContent = '';
                // جروب حسب section_title
                const groupedBySection = {};
                readings[key].forEach(r => {
                    if (!groupedBySection[r.section_title]) groupedBySection[r.section_title] = [];
                    groupedBySection[r.section_title].push(r);
                });
                let html = '';
                for (const sectionTitle in groupedBySection) {
                    // العنوان الرئيسي في المنتصف وبالذهبي
                    html += `<div class="reading-section-title reading-main-title">${sectionTitle}</div>`;
                    let topReference = '';
                    let gospelBox = '';
                    // ابحث عن أول قراءة مزمور وأول قراءة إنجيل
                    let psalmReading = groupedBySection[sectionTitle].find(r =>
                        (r.reading_title && /مزمور|المزمور|مزامير|psalm/i.test(r.reading_title)) ||
                        (r.book_translation && /مزمور|المزمور|مزامير|psalm/i.test(r.book_translation))
                    );
                    let gospelReading = groupedBySection[sectionTitle].find(r =>
                        (r.reading_title && /إنجيل|الإنجيل|gospel/i.test(r.reading_title)) ||
                        (r.book_translation && /إنجيل|الإنجيل|gospel/i.test(r.book_translation))
                    );
                    // المرجع بالاحمر ووسط الصفحة
                    if (psalmReading) {
                        topReference = `<div class="reading-reference">${psalmReading.book_translation ? psalmReading.book_translation + ' : ' : ''}${psalmReading.ref ?? ''}</div>`;
                    }
                    if (gospelReading) {
                        gospelBox = `<div class="reading-reference">${gospelReading.book_translation ? gospelReading.book_translation + ' : ' : ''}${gospelReading.ref ?? ''}</div>`;
                    }
                    let gospelInserted = false;
                    let psalmEnded = false;
                    groupedBySection[sectionTitle].forEach(reading => {
                        let insertGospelBox = '';
                        let readingHtml = '';
                        // إذا كانت القراءة مزمور
                        if (!psalmEnded && (
                            (reading.reading_title && /مزمور|المزمور|مزامير|psalm/i.test(reading.reading_title)) ||
                            (reading.book_translation && /مزمور|المزمور|مزامير|psalm/i.test(reading.book_translation))
                        )) {
                            // ابحث عن آخر "هللويا"
                            const hallelujahRegex = /(هللويا[!\.؟\،\,\s]*)/gi;
                            let contentText = reading.content ?? '';
                            let lastMatch;
                            let match;
                            while ((match = hallelujahRegex.exec(contentText)) !== null) {
                                lastMatch = match;
                            }
                            if (lastMatch) {
                                // قسم النص إلى قبل وبعد آخر "هللويا"
                                const index = lastMatch.index + lastMatch[0].length;
                                const before = contentText.slice(0, index); // يشمل "هللويا"
                                const after = contentText.slice(index);
                                readingHtml = `
                                    <div>${reading.introduction ?? ''}</div>
                                    <div>${highlightBlessings(before.replace(/\n/g, '<br>'))}</div>
                                `;
                                // أضف صندوق الإنجيل بعد الخاتمة
                                insertGospelBox = gospelBox;
                                // إذا لم يوجد نص بعد هللويا، لا تضف شيء، وإذا وجد أضفه بعد الصندوق
                                if (after && after.trim().length > 0) {
                                    readingHtml += `<div>${highlightBlessings(after.replace(/\n/g, '<br>'))}</div>`;
                                }
                                psalmEnded = true;
                            } else {
                                // لم توجد "هللويا"، ضع الصندوق في نهاية نص المزمور
                                readingHtml = `
                                    <div>${reading.introduction ?? ''}</div>
                                    <div>${highlightBlessings((reading.content ?? '').replace(/\n/g, '<br>'))}</div>
                                `;
                                insertGospelBox = gospelBox;
                                psalmEnded = true;
                            }
                        } else if (psalmEnded && !gospelInserted && (
                            (reading.reading_title && /إنجيل|الإنجيل|gospel/i.test(reading.reading_title)) ||
                            (reading.book_translation && /إنجيل|الإنجيل|gospel/i.test(reading.book_translation))
                        )) {
                            // أول قراءة إنجيل بعد المزمور
                            let gospelReference = '';
                            if (reading.book_translation || reading.ref) {
                                gospelReference = `<div class="reading-reference">${reading.book_translation ? reading.book_translation + ' : ' : ''}${reading.ref ?? ''}</div>`;
                            }
                            readingHtml = `
                                ${gospelReference}
                                <div>${highlightBlessings((reading.content ?? '').replace(/\n/g, '<br>'))}</div>
                            `;
                            gospelInserted = true;
                        } else {
                            // باقي القراءات
                            readingHtml = `
                                <div>${reading.introduction ?? ''}</div>
                                <div>${highlightBlessings((reading.content ?? '').replace(/\n/g, '<br>'))}</div>
                                ${reading.conclusion ? `<div class="reading-glory-center">${reading.conclusion}</div>` : ''}
                                ${reading.html ? `<div style="margin-top:10px;">${reading.html}</div>` : ''}
                            `;
                        }
                        html += `<div style="margin-bottom: 1.5em; text-align:center !important;">
                            ${topReference}
                            ${readingHtml}
                            ${insertGospelBox}
                        </div>`;
                        topReference = '';
                    });
                }
                content.innerHTML = html;
            } else {
                title.textContent = '';
                content.textContent = 'لا توجد قراءة بعد';
            }
            box.style.display = 'block';
        });
    });
    @if(isset($prophecies) && count($prophecies))
    document.getElementById('prophecies-btn').addEventListener('click', function() {
        document.getElementById('prophecies-content-box').style.display = 'block';
        document.getElementById('reading-content-box').style.display = 'none';
        document.getElementById('seneksar-content-box').style.display = 'none';
    });
    @endif
</script>
@endsection 