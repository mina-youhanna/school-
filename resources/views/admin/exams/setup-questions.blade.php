@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="/css/exam-management.css">
@endpush

@section('content')
<div class="exam-form-container">
    <div class="page-header">
        <h1 class="page-title">❓ إعداد أسئلة الامتحان</h1>
        <div class="action-buttons">
            <a href="{{ route('admin.exams.show', $exam) }}" class="btn btn-secondary">
                <span>🔙 رجوع للامتحان</span>
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
        </div>
    </div>

    <!-- إعداد الأسئلة -->
    <div class="questions-setup-section">
        <div class="section-header">
            <h3>⚙️ إعداد الأسئلة</h3>
        </div>

        <form action="{{ route('admin.exams.create-questions', $exam->id) }}" method="POST" id="questionsSetupForm">
            @csrf

            <div class="setup-grid">
                <div class="form-group">
                    <label class="form-label">📊 عدد الأسئلة الكلي</label>
                    <input type="number" name="total_questions" class="form-control" required min="1" max="50"
                        value="{{ old('total_questions', 10) }}" id="totalQuestions">
                    <small class="form-text text-muted">اختر عدد الأسئلة الكلي للامتحان (1-50)</small>
                </div>

                <div class="form-group">
                    <label class="form-label">⏱️ زمن كل سؤال (دقائق)</label>
                    <input type="number" name="question_time" class="form-control" required min="1" max="60"
                        value="{{ old('question_time', 5) }}" id="questionTime">
                    <small class="form-text text-muted">زمن كل سؤال بالدقائق</small>
                </div>
            </div>

            <div class="question-types-section">
                <h4>📝 أنواع الأسئلة</h4>

                <div class="question-type-card">
                    <div class="type-header">
                        <h5>✅ اختيار من متعدد</h5>
                        <div class="type-controls">
                            <label>عدد الأسئلة:</label>
                            <input type="number" name="multiple_choice_count" class="form-control" min="0"
                                value="{{ old('multiple_choice_count', 5) }}" id="multipleChoiceCount">
                        </div>
                    </div>
                    <div class="type-options">
                        <div class="option-group">
                            <label>عدد الخيارات لكل سؤال:</label>
                            <select name="multiple_choice_options" class="form-control">
                                <option value="3" {{ old('multiple_choice_options') == '3' ? 'selected' : '' }}>3 خيارات</option>
                                <option value="4" {{ old('multiple_choice_options') == '4' ? 'selected' : '' }}>4 خيارات</option>
                                <option value="5" {{ old('multiple_choice_options') == '5' ? 'selected' : '' }}>5 خيارات</option>
                            </select>
                        </div>
                        <div class="option-group">
                            <label>درجة كل سؤال:</label>
                            <input type="number" name="multiple_choice_score" class="form-control" min="1"
                                value="{{ old('multiple_choice_score', 2) }}">
                        </div>
                    </div>
                </div>

                <div class="question-type-card">
                    <div class="type-header">
                        <h5>❌ صح أو خطأ</h5>
                        <div class="type-controls">
                            <label>عدد الأسئلة:</label>
                            <input type="number" name="true_false_count" class="form-control" min="0"
                                value="{{ old('true_false_count', 3) }}" id="trueFalseCount">
                        </div>
                    </div>
                    <div class="type-options">
                        <div class="option-group">
                            <label>درجة كل سؤال:</label>
                            <input type="number" name="true_false_score" class="form-control" min="1"
                                value="{{ old('true_false_score', 1) }}">
                        </div>
                    </div>
                </div>

                <div class="question-type-card">
                    <div class="type-header">
                        <h5>📝 مقالي</h5>
                        <div class="type-controls">
                            <label>عدد الأسئلة:</label>
                            <input type="number" name="essay_count" class="form-control" min="0"
                                value="{{ old('essay_count', 2) }}" id="essayCount">
                        </div>
                    </div>
                    <div class="type-options">
                        <div class="option-group">
                            <label>درجة كل سؤال:</label>
                            <input type="number" name="essay_score" class="form-control" min="1"
                                value="{{ old('essay_score', 5) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="summary-section">
                <h4>📊 ملخص الامتحان</h4>
                <div class="summary-grid">
                    <div class="summary-item">
                        <span class="summary-label">إجمالي الأسئلة:</span>
                        <span class="summary-value" id="totalQuestionsSummary">0</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">إجمالي الدرجات:</span>
                        <span class="summary-value" id="totalScoreSummary">0</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-label">مدة الامتحان:</span>
                        <span class="summary-value" id="totalTimeSummary">0 دقيقة</span>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <span>✅ إنشاء الأسئلة</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .setup-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .questions-setup-section {
        margin-top: 40px;
    }

    .question-types-section {
        margin-top: 30px;
    }

    .question-types-section h4 {
        color: var(--primary-color);
        margin-bottom: 20px;
        font-size: 20px;
        font-weight: 700;
    }

    .question-type-card {
        background: var(--white);
        border: 2px solid var(--light-bg);
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: var(--shadow-light);
        transition: all 0.3s ease;
    }

    .question-type-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-medium);
        border-color: var(--primary-color);
    }

    .type-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid var(--light-bg);
    }

    .type-header h5 {
        color: var(--primary-color);
        margin: 0;
        font-size: 18px;
        font-weight: 700;
    }

    .type-controls {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .type-controls label {
        font-weight: 600;
        color: var(--text-dark);
    }

    .type-controls input {
        width: 80px;
        padding: 8px;
        border: 1px solid var(--border-color);
        border-radius: 6px;
    }

    .type-options {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
    }

    .option-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .option-group label {
        font-weight: 600;
        color: var(--text-dark);
        font-size: 14px;
    }

    .summary-section {
        margin-top: 40px;
        background: var(--light-bg);
        padding: 25px;
        border-radius: 12px;
        border: 2px solid var(--primary-color);
    }

    .summary-section h4 {
        color: var(--primary-color);
        margin-bottom: 20px;
        font-size: 18px;
        font-weight: 700;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--white);
        padding: 15px;
        border-radius: 8px;
        border-left: 4px solid var(--primary-color);
    }

    .summary-label {
        font-weight: 600;
        color: var(--text-dark);
    }

    .summary-value {
        font-weight: 700;
        color: var(--primary-color);
        font-size: 18px;
    }

    @media (max-width: 768px) {
        .type-header {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .type-controls {
            width: 100%;
        }

        .summary-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const totalQuestions = document.getElementById('totalQuestions');
        const questionTime = document.getElementById('questionTime');
        const multipleChoiceCount = document.getElementById('multipleChoiceCount');
        const trueFalseCount = document.getElementById('trueFalseCount');
        const essayCount = document.getElementById('essayCount');

        const totalQuestionsSummary = document.getElementById('totalQuestionsSummary');
        const totalScoreSummary = document.getElementById('totalScoreSummary');
        const totalTimeSummary = document.getElementById('totalTimeSummary');

        function updateSummary() {
            const multipleChoiceScore = parseInt(document.querySelector('input[name="multiple_choice_score"]').value) || 0;
            const trueFalseScore = parseInt(document.querySelector('input[name="true_false_score"]').value) || 0;
            const essayScore = parseInt(document.querySelector('input[name="essay_score"]').value) || 0;

            const multipleChoiceTotal = (parseInt(multipleChoiceCount.value) || 0) * multipleChoiceScore;
            const trueFalseTotal = (parseInt(trueFalseCount.value) || 0) * trueFalseScore;
            const essayTotal = (parseInt(essayCount.value) || 0) * essayScore;

            const totalQuestionsValue = (parseInt(multipleChoiceCount.value) || 0) +
                (parseInt(trueFalseCount.value) || 0) +
                (parseInt(essayCount.value) || 0);

            const totalScore = multipleChoiceTotal + trueFalseTotal + essayTotal;
            const totalTime = totalQuestionsValue * (parseInt(questionTime.value) || 0);

            totalQuestionsSummary.textContent = totalQuestionsValue;
            totalScoreSummary.textContent = totalScore;
            totalTimeSummary.textContent = totalTime + ' دقيقة';

            // تحديث عدد الأسئلة الكلي
            totalQuestions.value = totalQuestionsValue;
        }

        // إضافة event listeners
        [multipleChoiceCount, trueFalseCount, essayCount, questionTime].forEach(element => {
            element.addEventListener('input', updateSummary);
        });

        // تحديث الملخص عند تحميل الصفحة
        updateSummary();

        // التحقق من صحة النموذج
        const form = document.getElementById('questionsSetupForm');
        form.addEventListener('submit', function(e) {
            const totalQuestionsValue = parseInt(totalQuestionsSummary.textContent);

            if (totalQuestionsValue === 0) {
                e.preventDefault();
                alert('⚠️ يجب إدخال أسئلة على الأقل');
                return false;
            }

            if (totalQuestionsValue > 50) {
                e.preventDefault();
                alert('⚠️ لا يمكن أن يتجاوز عدد الأسئلة 50 سؤال');
                return false;
            }
        });
    });
</script>
@endpush
@endsection
