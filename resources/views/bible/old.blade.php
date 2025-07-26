@extends('layouts.app')
@section('content')
<style>
    .bible-main-title {
        color: #ffd700;
        font-size: 2.5em;
        font-weight: bold;
        text-align: center;
        margin-bottom: 30px;
        margin-top: 20px;
        letter-spacing: 2px;
        text-shadow: 0 2px 8px #0004;
    }
    .bible-flex-row {
        display: flex;
        flex-wrap: wrap;
        gap: 32px;
        justify-content: center;
        margin-bottom: 30px;
    }
    .bible-col {
        min-width: 320px;
        flex: 1 1 320px;
        text-align: center;
    }
    .bible-books-list, .bible-chapters-list {
        list-style: none;
        padding: 0;
        margin: 0 0 25px 0;
        text-align: center;
    }
    .bible-books-list li, .bible-chapters-list li {
        display: inline-block;
        margin: 6px 4px;
    }
    .bible-books-list a, .bible-chapters-list a {
        color: #fff !important;
        border: 1.5px solid #ffd700;
        background: transparent;
        border-radius: 8px;
        padding: 7px 18px;
        font-size: 1.1em;
        font-weight: bold;
        transition: 0.2s;
        text-decoration: none;
        box-shadow: 0 2px 8px #ffd70022;
    }
    .bible-books-list a.active, .bible-chapters-list a.active {
        background: #ffd700;
        color: #0a234f !important;
    }
    .bible-books-list a:hover, .bible-chapters-list a:hover {
        background: #ffd700;
        color: #0a234f !important;
        text-decoration: none;
    }
    .bible-chapter-content {
    color: #fff;
    padding: 28px 18px;
    border-radius: 16px;
    font-size: 1.3em;
    margin-top: 30px;
    box-shadow: 0 2px 16px #0002;
    direction: rtl;
    line-height: 2.1;
    position: relative;
    z-index: 10;
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    border: 1px solid rgba(255, 215, 0, 0.3);
    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
}
    .bible-chapter-content h4 {
        color: #ffd700;
        font-size: 1.5em;
        margin-bottom: 18px;
        font-weight: bold;
    }
    label {
        color: #fff;
        font-weight: bold;
        margin-bottom: 10px;
        display: block;
        text-align: center;
    }
    .form-select {
        background: rgba(10,35,79,0.85);
        color: #fff;
        border: 1.5px solid #ffd700;
        border-radius: 8px;
        font-size: 1.1em;
        min-width: 220px;
        text-align: right;
    }
    .form-select:disabled {
        opacity: 0.6;
        background: #223355;
        color: #bbb;
    }
    
    /* تعديل لون الـ selected option */
    .form-select option:checked {
        background-color: #ffd700 !important;
        color: #0a234f !important;
    }
    
    /* لون الخيار المختار في Firefox */
    .form-select option[selected] {
        background-color: #ffd700 !important;
        color: #0a234f !important;
    }
    
    /* Verse styling - الآية بجانب الرقم */
    .verse-line {
        display: flex;
        flex-direction: row;      /* مهم: نخليها row مش row-reverse */
        align-items: center;
        margin-bottom: 15px;
        direction: rtl;
        font-size: 1.1em;
        line-height: 1.8;
        text-align: right;
        white-space: normal;
        justify-content: flex-end; /* عشان كل حاجة تيجي يمين */
        width: 100%;
    }
    
    .verse-number {
        color: #ffd700;
        font-weight: bold;
        min-width: 30px;
        background-color: rgba(255, 215, 0, 0.15);
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        line-height: 30px;
        margin-left: 10px;   
        margin-right: 0;
        vertical-align: middle;
        font-size: 1.1em;
        flex-shrink: 0;
    }
    
    .verse-text {
        display: block;
        text-align: right;
        flex: 1 1 0;
        white-space: normal;
        padding: 3px 0;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        letter-spacing: 0.5px;
        vertical-align: middle;
        /* أهم سطرين لضمان أن الكلام يبدأ من اليمين */
        direction: rtl;
        margin-right: 0;
    }
</style>

<div class="container">
    <div class="bible-main-title">العهد القديم</div>

    <!-- قائمة منسدلة لاختيار السفر -->
    <div class="bible-selects-row">
        <!-- اختيار السفر -->
        <form method="get" action="{{ route('bible.old.chapters', 0) }}" id="bookForm" style="margin:0;">
            <select name="book" id="bookSelect" class="form-select">
                <option value="">اختر السفر</option>
                @foreach($books as $b)
                    <option value="{{ $b->book_number }}" @if(isset($book_number) && $book_number == $b->book_number) selected @endif>
                        {{ $b->book_name }}
                    </option>
                @endforeach
            </select>
        </form>

        <!-- اختيار الإصحاح -->
        <form method="get" id="chapterForm" style="margin:0;">
            <select name="chapter" id="chapterSelect" class="form-select" @if(!isset($chapters)) disabled @endif>
                <option value="">اختر الإصحاح</option>
                @if(isset($chapters))
                    @foreach($chapters as $ch)
                        <option value="{{ $ch->chapter_number }}"
                            @if(isset($chapter) && $chapter->chapter_number == $ch->chapter_number) selected @endif>
                            {{ $ch->chapter_number }}
                        </option>
                    @endforeach
                @endif
            </select>
        </form>
    </div>

    {{-- 
<div class="bible-flex-row">
    <!-- قائمة الأسفار -->
    <div class="bible-col">
        <label>الأسفار:</label>
        <ul class="bible-books-list">
            @foreach($books as $b)
                <li>
                    <a href="{{ route('bible.old.chapters', $b->book_number) }}"
                       @if(isset($book_number) && $book_number == $b->book_number) class="active" @endif>
                        {{ $b->book_name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- قائمة الإصحاحات -->
    @isset($chapters)
    <div class="bible-col">
        <label>الإصحاحات:</label>
        <ul class="bible-chapters-list">
            @foreach($chapters as $ch)
                <li>
                    <a href="{{ route('bible.old.show', [$book_number, $ch->chapter_number]) }}"
                       @if(isset($chapter) && $chapter->chapter_number == $ch->chapter_number) class="active" @endif>
                        {{ $ch->chapter_number }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    @endisset
</div>
--}}

@if(isset($book_number) && $book_number && isset($chapter) && isset($chapter->chapter_number) && $chapter->chapter_number)
    @php
        // معالجة نص الإصحاح: استخراج العنوان (أول سطر) وباقي الآيات
        $chapter_lines = preg_split('/\r\n|\r|\n/', $chapter->chapter_text ?? '');
        $chapter_title = count($chapter_lines) ? array_shift($chapter_lines) : '';
        $verses = $chapter_lines;
    @endphp

    <div class="bible-chapter-content" style="
        color: #fff;
        padding: 35px 25px;
        border-radius: 24px;
        border: 2.5px solid #ffd700;
        box-shadow: 0 4px 32px #ffd70044;
        font-size: 1.3em;
        margin: 40px auto 0 auto;
        direction: rtl;
        line-height: 2.1;
        max-width: 1000px;
        min-width: 400px;
        position: relative;
        z-index: 10;
        -webkit-backdrop-filter: blur(5px);
    ">
        <h4 style="color:#ffd700; font-size:2em; text-align:center; font-weight:bold; margin-bottom:18px;">
            {{ $book->book_name ?? '' }} - إصحاح {{ $chapter->chapter_number ?? '' }}
        </h4>
        @if($chapter_title)
            <div style="color:#ffd700; font-size:1.4em; text-align:center; font-weight:bold; margin-bottom:18px;">
                {{ $chapter_title }}
            </div>
        @endif
        <div>
            @php $i = 1; @endphp
            @php
                $pendingNumber = null;
            @endphp
            @foreach($verses as $verse)
                @php
                    $verse = trim($verse);
                @endphp

                {{-- لو السطر رقم فقط --}}
                @if(preg_match('/^(\d+)$/u', $verse, $matches))
                    @php
                        $pendingNumber = $matches[1];
                    @endphp

                {{-- لو السطر فيه رقم ونص معًا --}}
                @elseif(preg_match('/^(\d+)\s+(.+)$/u', $verse, $matches))
                    <div class="verse-line">
                        <span class="verse-number">{{ $matches[1] }}</span>&nbsp;
                        <span class="verse-text">{{ $matches[2] }}</span>
                    </div>
                    @php $pendingNumber = null; @endphp

                {{-- لو السطر نص فقط --}}
                @elseif($verse !== '')
                    <div class="verse-line">
                        @if($pendingNumber)
                            <span class="verse-number">{{ $pendingNumber }}</span>&nbsp;
                        @endif
                        <span class="verse-text">{{ $verse }}</span>
                    </div>
                    @php $pendingNumber = null; @endphp
                @endif
            @endforeach
        </div>
    </div>
@endif

<script>
    document.getElementById('bookSelect').addEventListener('change', function() {
        var bookNumber = this.value;
        if(bookNumber) {
            window.location.href = '/old-testament/' + bookNumber;
        } else {
            window.location.href = '/old-testament';
        }
    });

    var chapterSelect = document.getElementById('chapterSelect');
    if(chapterSelect) {
        chapterSelect.addEventListener('change', function() {
            var chapterNumber = this.value;
            var bookNumber = "{{ $book_number ?? '' }}";
            if(chapterNumber && bookNumber) {
                window.location.href = '/old-testament/' + bookNumber + '/' + chapterNumber;
            }
        });
    }
    
    // إضافة JavaScript لتلوين الخيار المختار
    document.addEventListener('DOMContentLoaded', function() {
        const selects = document.querySelectorAll('.form-select');
        selects.forEach(function(select) {
            select.addEventListener('change', function() {
                // إعادة تعيين لون جميع الخيارات
                for(let i = 0; i < this.options.length; i++) {
                    this.options[i].style.backgroundColor = '';
                    this.options[i].style.color = '';
                }
                // تلوين الخيار المختار
                if(this.selectedIndex > 0) {
                    this.options[this.selectedIndex].style.backgroundColor = '#ffd700';
                    this.options[this.selectedIndex].style.color = '#0a234f';
                }
            });
            
            // تطبيق اللون على الخيار المختار عند تحميل الصفحة
            if(select.selectedIndex > 0) {
                select.options[select.selectedIndex].style.backgroundColor = '#ffd700';
                select.options[select.selectedIndex].style.color = '#0a234f';
                select.style.borderColor = '#ffd700';
                select.style.boxShadow = '0 0 10px #ffd70055';
            }
        });
    });
    
    // تحديد السفر المختار في القائمة المنسدلة
    function setSelectedBook(bookId) {
        const bookSelect = document.getElementById('bookSelect');
        if (bookSelect) {
            bookSelect.value = bookId;
            // إضافة تأثير اللون الذهبي للسفر المختار
            bookSelect.style.borderColor = '#ffd700';
            bookSelect.style.boxShadow = '0 0 10px #ffd70055';
            
            // تحديث لون الخيار المختار
            Array.from(bookSelect.options).forEach(option => {
                if (option.value === bookId) {
                    option.style.backgroundColor = '#ffd700';
                    option.style.color = '#0a234f';
                    option.style.fontWeight = 'bold';
                }
            });
        }
    }

    // تحديد الإصحاح المختار في القائمة المنسدلة
    function setSelectedChapter(chapterId) {
        const chapterSelect = document.getElementById('chapterSelect');
        if (chapterSelect) {
            chapterSelect.value = chapterId;
            // إضافة تأثير اللون الذهبي للإصحاح المختار
            chapterSelect.style.borderColor = '#ffd700';
            chapterSelect.style.boxShadow = '0 0 10px #ffd70055';
            
            // تحديث لون الخيار المختار
            Array.from(chapterSelect.options).forEach(option => {
                if (option.value === chapterId) {
                    option.style.backgroundColor = '#ffd700';
                    option.style.color = '#0a234f';
                    option.style.fontWeight = 'bold';
                }
            });
        }
    }
</script>

<style>
/* إضافة CSS خاص بالمتصفحات المختلفة للـ select options */
.form-select option {
    background-color: rgba(10,35,79,0.85);
    color: #fff;
}

.form-select option:checked,
.form-select option[selected] {
    background-color: #ffd700 !important;
    color: #0a234f !important;
    font-weight: bold;
}

/* خاص بـ Webkit browsers */
.form-select option:checked {
    background: #ffd700 linear-gradient(0deg, #ffd700 0%, #ffd700 100%);
    color: #0a234f;
}

/* تحسين عرض الخلفية */
.bible-chapter-content {
    background: transparent !important;
}

/* تحسين عرض القوائم المنسدلة */
#bookSelect, #chapterSelect {
    border: 2px solid #ffd700;
    box-shadow: 0 0 10px #ffd70055;
}

#bookSelect option:hover, #chapterSelect option:hover {
    background-color: #ffd700;
    color: #0a234f;
}

.form-select::-webkit-scrollbar {
    width: 8px;
}

.form-select::-webkit-scrollbar-track {
    background: #fff; /* المسار الأبيض */
    border-radius: 8px;
}

.form-select::-webkit-scrollbar-thumb {
    background: #ffd700; /* الذهبي */
    border-radius: 8px;
    border: 2px solid #fff; /* خط أبيض حول الذهبي لو حبيت */
}

.form-select::-webkit-scrollbar-corner {
    background: #fff; /* زاوية التقاطع بين الشريطين */
}

body {
            background-image: url('../images/download.png'); /* Using existing asset */
            background-size: 300px; /* Using existing asset */
            background-color: #0A2A4F; /* Using existing asset */
            background-blend-mode: multiply; /* Using existing asset */
            font-family: 'Tajawal', sans-serif;
            direction: rtl;
            color: white;
            min-height: 100vh;
            padding-top: 70px; /* Adjusted padding-top for new navbar height */
        }

.container,
.bible-chapter-content,
main,
section {
    background: transparent !important;
    opacity: 1 !important;
    box-shadow: none !important;
}

.bible-selects-row {
    display: flex;
    gap: 18px;
    justify-content: center;
    align-items: center;
    margin-bottom: 30px;
    flex-wrap: wrap;
}
@media (max-width: 600px) {
    .bible-selects-row {
        flex-direction: column;
        gap: 12px;
        align-items: stretch;
    }
    .bible-selects-row form {
        width: 100%;
        display: flex;
        justify-content: center;
    }
    .form-select {
        min-width: 0;
        width: 100%;
        max-width: 350px;
        margin: 0 auto;
    }
}
</style>

@endsection