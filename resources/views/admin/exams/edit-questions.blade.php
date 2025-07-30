@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="/css/exam-management.css">
@endpush

@section('content')
<div class="exam-form-container">
    <div class="page-header">
        <h1 class="page-title">✏️ تعديل أسئلة الامتحان</h1>
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

    <!-- تعديل الأسئلة -->
    <div class="questions-edit-section">
        <div class="section-header">
            <h3>✏️ تعديل الأسئلة</h3>
            <div class="questions-summary">
                <span class="summary-item">إجمالي الأسئلة: {{ $exam->questions->count() }}</span>
                <span class="summary-item">إجمالي الدرجات: {{ $exam->questions->sum('score') }}</span>
            </div>
        </div>

        <form action="{{ route('admin.exams.update-questions', $exam) }}" method="POST" id="questionsEditForm">
            @csrf
            @method('PUT')

            <div class="questions-container">
                @foreach($exam->questions->sortBy('question_number') as $question)
                <div class="question-card" data-question-id="{{ $question->id }}">
                    <div class="question-header">
                        <div class="question-number">
                            <span class="number-badge">{{ $question->question_number }}</span>
                        </div>
                        <div class="question-type">
                            @if($question->type == 'multiple_choice')
                            <span class="type-badge multiple-choice">✅ اختيار من متعدد</span>
                            @elseif($question->type == 'true_false')
                            <span class="type-badge true-false">❌ صح أو خطأ</span>
                            @elseif($question->type == 'essay')
                            <span class="type-badge essay">📝 مقالي</span>
                            @endif
                        </div>
                        <div class="question-score">
                            <span class="score-badge">{{ $question->score }} درجة</span>
                        </div>
                    </div>

                    <div class="question-content">
                        <div class="form-group">
                            <label class="form-label">📝 نص السؤال</label>
                            <textarea name="questions[{{ $question->id }}][question_text]" class="form-control question-text"
                                rows="3" required>{{ old("questions.{$question->id}.question_text", $question->question_text) }}</textarea>
                        </div>

                        @if($question->type == 'multiple_choice')
                        <div class="options-section">
                            <label class="form-label">🔘 الخيارات</label>
                            <div class="options-container">
                                @foreach($question->options as $index => $option)
                                <div class="option-item">
                                    <div class="option-input-group">
                                        <input type="radio" name="questions[{{ $question->id }}][correct_option]"
                                            value="{{ $index }}" {{ $option->is_correct ? 'checked' : '' }}
                                            class="correct-option" id="option_{{ $question->id }}_{{ $index }}">
                                        <label for="option_{{ $question->id }}_{{ $index }}" class="option-label">الإجابة الصحيحة</label>
                                    </div>
                                    <input type="text" name="questions[{{ $question->id }}][options][{{ $index }}]"
                                        class="form-control option-text" value="{{ $option->option_text }}"
                                        placeholder="أدخل نص الخيار" required>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @elseif($question->type == 'true_false')
                        <div class="true-false-section">
                            <label class="form-label">✅ الإجابة الصحيحة</label>
                            <div class="true-false-options">
                                <div class="option-item">
                                    <input type="radio" name="questions[{{ $question->id }}][correct_answer]"
                                        value="صح" {{ $question->correct_answer == 'صح' ? 'checked' : '' }}
                                        id="true_{{ $question->id }}">
                                    <label for="true_{{ $question->id }}">صح</label>
                                </div>
                                <div class="option-item">
                                    <input type="radio" name="questions[{{ $question->id }}][correct_answer]"
                                        value="خطأ" {{ $question->correct_answer == 'خطأ' ? 'checked' : '' }}
                                        id="false_{{ $question->id }}">
                                    <label for="false_{{ $question->id }}">خطأ</label>
                                </div>
                            </div>
                        </div>
                        @elseif($question->type == 'essay')
                        <div class="essay-section">
                            <div class="form-group">
                                <label class="form-label">📝 الإجابة النموذجية</label>
                                <textarea name="questions[{{ $question->id }}][correct_answer]" class="form-control"
                                    rows="3" placeholder="أدخل الإجابة النموذجية">{{ old("questions.{$question->id}.correct_answer", $question->correct_answer) }}</textarea>
                            </div>
                        </div>
                        @endif

                        <div class="question-settings">
                            <div class="settings-grid">
                                <div class="form-group">
                                    <label class="form-label">⏱️ زمن السؤال (دقائق)</label>
                                    <input type="number" name="questions[{{ $question->id }}][question_time]"
                                        class="form-control" min="1" max="60"
                                        value="{{ old("questions.{$question->id}.question_time", $question->question_time / 60) }}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">🎯 درجة السؤال</label>
                                    <input type="number" name="questions[{{ $question->id }}][score]"
                                        class="form-control" min="1" max="10"
                                        value="{{ old("questions.{$question->id}.score", $question->score) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    <span>💾 حفظ التعديلات</span>
                </button>
                <a href="{{ route('admin.exams.show', $exam) }}" class="btn btn-secondary">
                    <span>❌ إلغاء</span>
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    .questions-edit-section {
        margin-top: 40px;
    }

    .questions-summary {
        display: flex;
        gap: 20px;
        align-items: center;
    }

    .summary-item {
        background: var(--primary-color);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
    }

    .questions-container {
        margin-top: 30px;
    }

    .question-card {
        background: var(--white);
        border: 2px solid var(--light-bg);
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 25px;
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

    .question-number {
        display: flex;
        align-items: center;
    }

    .number-badge {
        background: var(--primary-color);
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 18px;
    }

    .question-type {
        flex: 1;
        margin-left: 20px;
    }

    .type-badge {
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
    }

    .type-badge.multiple-choice {
        background: #28a745;
        color: white;
    }

    .type-badge.true-false {
        background: #ffc107;
        color: #212529;
    }

    .type-badge.essay {
        background: #17a2b8;
        color: white;
    }

    .question-score {
        display: flex;
        align-items: center;
    }

    .score-badge {
        background: #dc3545;
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
    }

    .question-content {
        margin-top: 20px;
    }

    .options-section,
    .true-false-section,
    .essay-section {
        margin-top: 20px;
        padding: 20px;
        background: var(--light-bg);
        border-radius: 8px;
    }

    .options-container {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .option-item {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .option-input-group {
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 150px;
    }

    .option-label {
        font-weight: 600;
        color: var(--primary-color);
        font-size: 14px;
    }

    .option-text {
        flex: 1;
    }

    .true-false-options {
        display: flex;
        gap: 30px;
    }

    .true-false-options .option-item {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .question-settings {
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid var(--light-bg);
    }

    .settings-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    @media (max-width: 768px) {
        .question-header {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .options-container {
            gap: 10px;
        }

        .option-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .true-false-options {
            flex-direction: column;
            gap: 15px;
        }
    }
</style>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // إضافة تأثيرات بصرية للأسئلة
        const questionCards = document.querySelectorAll('.question-card');
        questionCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // التحقق من صحة النموذج
        const form = document.getElementById('questionsEditForm');
        form.addEventListener('submit', function(e) {
            const questions = document.querySelectorAll('.question-card');
            let isValid = true;

            questions.forEach(question => {
                const questionText = question.querySelector('.question-text').value.trim();
                if (!questionText) {
                    isValid = false;
                    question.style.borderColor = '#dc3545';
                } else {
                    question.style.borderColor = '';
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('⚠️ يرجى ملء جميع الأسئلة');
                return false;
            }
        });

        // إضافة تأثيرات للخيارات
        const correctOptions = document.querySelectorAll('.correct-option');
        correctOptions.forEach(option => {
            option.addEventListener('change', function() {
                const questionCard = this.closest('.question-card');
                const allOptions = questionCard.querySelectorAll('.correct-option');
                allOptions.forEach(opt => {
                    opt.parentElement.style.color = '';
                });
                this.parentElement.style.color = '#28a745';
            });
        });
    });
</script>
@endpush
@endsection
