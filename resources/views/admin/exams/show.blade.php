@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="/css/exam-management.css">
@endpush

@section('content')
<div class="exam-form-container">
    <div class="page-header">
        <h1 class="page-title">📋 تفاصيل الامتحان</h1>
        <div class="action-buttons">
            <a href="{{ route('admin.exams.edit', $exam) }}" class="btn btn-primary">
                <span>✏️ تعديل الامتحان</span>
            </a>
            <a href="{{ route('admin.exams.index') }}" class="btn btn-secondary">
                <span>🔙 رجوع للقائمة</span>
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
    @endif

    <!-- معلومات الامتحان -->
    <div class="current-exam-info">
        <h3>📝 معلومات الامتحان</h3>
        <div class="exam-details">
            <p><strong>📋 اسم الامتحان:</strong> {{ $exam->title }}</p>
            <p><strong>📚 المادة:</strong> {{ $exam->subject->name ?? 'غير محدد' }}</p>
            <p><strong>🎯 المستوى:</strong> {{ $exam->stage ?? 'غير محدد' }}</p>
            <p><strong>👥 الفصل:</strong> {{ $exam->studyClass->name ?? 'غير محدد' }}</p>
            <p><strong>👁️ طريقة العرض:</strong>
                @if($exam->display_mode == 'one_by_one')
                سؤال بسؤال
                @else
                كل الأسئلة معًا
                @endif
            </p>
            @if($exam->total_time)
            <p><strong>⏰ الزمن الكلي:</strong> {{ $exam->total_time }} دقيقة</p>
            @endif
            <p><strong>🕐 وقت البداية:</strong> {{ \Carbon\Carbon::parse($exam->start_time)->format('Y-m-d H:i') }}</p>
            <p><strong>🕙 وقت النهاية:</strong> {{ \Carbon\Carbon::parse($exam->end_time)->format('Y-m-d H:i') }}</p>
            @if($exam->image)
            <p><strong>🖼️ الصورة:</strong> <a href="{{ $exam->image }}" target="_blank">عرض الصورة</a></p>
            @endif
        </div>
    </div>

    <!-- قسم الأسئلة -->
    <div class="questions-section">
        <div class="section-header">
            <h3>❓ أسئلة الامتحان</h3>
            <div class="action-buttons">
                @if($exam->questions->count() == 0)
                <a href="{{ route('admin.exams.setup-questions', $exam) }}" class="btn btn-success">
                    <span>⚙️ إعداد الأسئلة</span>
                </a>
                @else
                <a href="{{ route('admin.exams.edit-questions', $exam) }}" class="btn btn-primary">
                    <span>✏️ تعديل الأسئلة</span>
                </a>
                <a href="{{ route('questions.create', $exam->id) }}" class="btn btn-success">
                    <span>➕ إضافة سؤال جديد</span>
                </a>
                @endif
            </div>
        </div>

        @if($exam->questions->count() > 0)
        <div class="questions-list">
            @foreach($exam->questions as $index => $question)
            <div class="question-card">
                <div class="question-header">
                    <h4>سؤال {{ $index + 1 }}</h4>
                    <div class="question-actions">
                        <a href="{{ route('questions.edit', [$exam->id, $question->id]) }}" class="btn btn-sm btn-primary">
                            <span>✏️ تعديل</span>
                        </a>
                        <form action="{{ route('questions.destroy', [$exam->id, $question->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('هل أنت متأكد من حذف هذا السؤال؟')">
                                <span>🗑️ حذف</span>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="question-content">
                    <p><strong>نص السؤال:</strong> {{ $question->question_text }}</p>
                    <p><strong>نوع السؤال:</strong>
                        @if($question->type == 'true_false')
                        صح أو خطأ
                        @elseif($question->type == 'multiple_choice')
                        اختيار من متعدد
                        @elseif($question->type == 'essay')
                        مقالي
                        @endif
                    </p>
                    @if($question->correct_answer)
                    <p><strong>الإجابة الصحيحة:</strong> {{ $question->correct_answer }}</p>
                    @endif
                    @if($question->question_time)
                    <p><strong>زمن السؤال:</strong> {{ $question->question_time }} ثانية</p>
                    @endif
                    <p><strong>درجة السؤال:</strong> {{ $question->score }} درجة</p>
                </div>

                @if($question->options->count() > 0)
                <div class="question-options">
                    <h5>الخيارات:</h5>
                    <ul>
                        @foreach($question->options as $option)
                        <li>{{ $option->option_text }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <div class="empty-state">
            <h3>📝 لا توجد أسئلة بعد</h3>
            <p>لم يتم إضافة أي أسئلة لهذا الامتحان. اضغط على "إضافة سؤال جديد" لبدء إضافة الأسئلة.</p>
        </div>
        @endif
    </div>
</div>

<style>
    .exam-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .exam-details p {
        background: var(--light-bg);
        padding: 15px;
        border-radius: 8px;
        margin: 0;
        border-left: 4px solid var(--primary-color);
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--light-bg);
    }

    .questions-section {
        margin-top: 40px;
    }

    .questions-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .question-card {
        background: var(--white);
        border: 2px solid var(--light-bg);
        border-radius: 12px;
        padding: 25px;
        box-shadow: var(--shadow-light);
        transition: all 0.3s ease;
    }

    .question-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
        border-color: var(--primary-color);
    }

    .question-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--light-bg);
    }

    .question-header h4 {
        color: var(--primary-color);
        margin: 0;
        font-size: 18px;
        font-weight: 700;
    }

    .question-actions {
        display: flex;
        gap: 10px;
    }

    .question-content {
        margin-bottom: 20px;
    }

    .question-content p {
        margin-bottom: 10px;
        color: var(--text-dark);
        line-height: 1.6;
    }

    .question-options {
        background: var(--light-bg);
        padding: 15px;
        border-radius: 8px;
        margin-top: 15px;
    }

    .question-options h5 {
        color: var(--primary-color);
        margin-bottom: 10px;
        font-size: 16px;
        font-weight: 600;
    }

    .question-options ul {
        margin: 0;
        padding-left: 20px;
    }

    .question-options li {
        color: var(--text-dark);
        margin-bottom: 5px;
        padding: 5px 0;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: var(--light-bg);
        border-radius: 12px;
        border: 2px dashed var(--border-color);
    }

    .empty-state h3 {
        color: var(--primary-color);
        margin-bottom: 15px;
    }

    .empty-state p {
        color: var(--text-muted);
        font-size: 16px;
        line-height: 1.6;
    }
</style>
@endsection