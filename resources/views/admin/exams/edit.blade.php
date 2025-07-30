@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="/css/exam-management.css">
@endpush

@section('content')
<div class="exam-form-container">
    <h1 class="page-title">✏️ تعديل الامتحان</h1>

    @if(session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="error-message">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="current-exam-info">
        <h3>📋 معلومات الامتحان الحالي</h3>
        <p><strong>📝 الاسم:</strong> {{ $exam->title }}</p>
        <p><strong>📚 المادة:</strong> {{ $exam->subject->name ?? 'غير محدد' }}</p>
        <p><strong>🎯 المستوى:</strong> {{ $exam->stage ?? 'غير محدد' }}</p>
        <p><strong>👁️ طريقة العرض:</strong> {{ $exam->display_mode == 'one_by_one' ? 'سؤال بسؤال' : 'كل الأسئلة معًا' }}</p>
        @if($exam->total_time)
        <p><strong>⏰ الزمن الكلي:</strong> {{ $exam->total_time }} دقيقة</p>
        @endif
    </div>

    <form action="{{ route('admin.exams.update', $exam) }}" method="POST" id="examForm">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">🎯 نوع الامتحان</label>
            <select name="exam_type" class="form-control" required id="examType">
                <option value="">اختر نوع الامتحان</option>
                <option value="class" {{ old('exam_type', $exam->exam_type ?? 'stage') == 'class' ? 'selected' : '' }}>امتحان لفصل محدد</option>
                <option value="stage" {{ old('exam_type', $exam->exam_type ?? 'stage') == 'stage' ? 'selected' : '' }}>امتحان لمستوى محدد</option>
            </select>
            <small class="form-text text-muted">اختر نوع الامتحان: لفصل محدد أو لمستوى محدد</small>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">📋 اسم الامتحان</label>
                <input type="text" name="title" class="form-control" required
                    placeholder="أدخل اسم الامتحان" value="{{ old('title', $exam->title) }}">
            </div>

            <div class="form-group">
                <label class="form-label">📚 المادة</label>
                <select name="subject_id" class="form-control" required>
                    <option value="">اختر المادة</option>
                    @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ old('subject_id', $exam->subject_id) == $subject->id ? 'selected' : '' }}>
                        {{ $subject->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group" id="classGroup" style="display: {{ old('exam_type', $exam->exam_type ?? 'stage') == 'class' ? 'block' : 'none' }};">
                <label class="form-label">👥 الفصل الدراسي</label>
                <select name="class_id" class="form-control" id="classSelect" {{ old('exam_type', $exam->exam_type ?? 'stage') == 'class' ? 'required' : '' }}>
                    <option value="">اختر الفصل</option>
                    @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ old('class_id', $exam->class_id) == $class->id ? 'selected' : '' }}>
                        {{ $class->name }} - {{ $class->stage }}
                    </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">سيظهر هذا الامتحان لطلاب هذا الفصل فقط</small>
            </div>

            <div class="form-group" id="stageGroup" style="display: {{ old('exam_type', $exam->exam_type ?? 'stage') == 'stage' ? 'block' : 'none' }};">
                <label class="form-label">🎯 المستوى</label>
                <select name="stage" class="form-control" id="stageSelect" {{ old('exam_type', $exam->exam_type ?? 'stage') == 'stage' ? 'required' : '' }}>
                    <option value="">اختر المستوى</option>
                    @foreach($stages as $key => $stage)
                    <option value="{{ $key }}" {{ old('stage', $exam->stage) == $key ? 'selected' : '' }}>
                        {{ $stage }}
                    </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">سيظهر هذا الامتحان لجميع الفصول في نفس المستوى</small>
            </div>

            <div class="form-group">
                <label class="form-label">👁️ طريقة العرض</label>
                <select name="display_mode" class="form-control" required id="displayMode">
                    <option value="one_by_one" {{ old('display_mode', $exam->display_mode) == 'one_by_one' ? 'selected' : '' }}>سؤال بسؤال</option>
                    <option value="all_at_once" {{ old('display_mode', $exam->display_mode) == 'all_at_once' ? 'selected' : '' }}>كل الأسئلة معًا</option>
                </select>
            </div>
        </div>

        <div class="time-section">
            <div class="form-group">
                <label class="form-label" id="timeLabel">⏰ الزمن الكلي (دقائق)</label>
                <input type="number" name="total_time" class="form-control" id="totalTime"
                    placeholder="أدخل الزمن بالدقائق" value="{{ old('total_time', $exam->total_time) }}" min="1">
                <div class="time-info" id="timeInfo" style="display: none;">
                    <strong>💡 ملاحظة:</strong> في وضع "سؤال بسؤال"، سيتم تحديد زمن كل سؤال منفرداً عند إضافة الأسئلة
                </div>
            </div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">🕐 وقت البداية</label>
                <input type="datetime-local" name="start_time" class="form-control" required
                    value="{{ old('start_time', $exam->start_time) }}">
            </div>

            <div class="form-group">
                <label class="form-label">🕙 وقت النهاية</label>
                <input type="datetime-local" name="end_time" class="form-control" required
                    value="{{ old('end_time', $exam->end_time) }}">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">🖼️ رابط الصورة (اختياري)</label>
            <input type="text" name="image" class="form-control"
                placeholder="أدخل رابط الصورة" value="{{ old('image', $exam->image) }}">
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.exams.index') }}" class="btn btn-secondary">
                <span>❌ إلغاء</span>
            </a>
            <button type="submit" class="btn btn-primary">
                <span>💾 حفظ التعديلات</span>
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const examType = document.getElementById('examType');
        const classGroup = document.getElementById('classGroup');
        const stageGroup = document.getElementById('stageGroup');
        const classSelect = document.getElementById('classSelect');
        const stageSelect = document.getElementById('stageSelect');
        const displayMode = document.getElementById('displayMode');
        const timeLabel = document.getElementById('timeLabel');
        const totalTime = document.getElementById('totalTime');
        const timeInfo = document.getElementById('timeInfo');

        // التحكم في نوع الامتحان
        function updateExamType() {
            if (examType.value === 'class') {
                classGroup.style.display = 'block';
                stageGroup.style.display = 'none';
                classSelect.required = true;
                stageSelect.required = false;
            } else if (examType.value === 'stage') {
                classGroup.style.display = 'none';
                stageGroup.style.display = 'block';
                classSelect.required = false;
                stageSelect.required = true;
            } else {
                classGroup.style.display = 'none';
                stageGroup.style.display = 'none';
                classSelect.required = false;
                stageSelect.required = false;
            }
        }

        examType.addEventListener('change', updateExamType);
        updateExamType();

        function updateTimeField() {
            if (displayMode.value === 'one_by_one') {
                timeLabel.textContent = '⏰ الزمن الكلي (دقائق) - اختياري';
                totalTime.placeholder = 'اختياري - سيتم تحديد زمن كل سؤال منفرداً';
                totalTime.disabled = false;
                timeInfo.style.display = 'block';
            } else {
                timeLabel.textContent = '⏰ الزمن الكلي (دقائق)';
                totalTime.placeholder = 'أدخل الزمن بالدقائق';
                totalTime.disabled = false;
                timeInfo.style.display = 'none';
            }
        }

        displayMode.addEventListener('change', updateTimeField);
        updateTimeField();

        // Form validation
        const form = document.getElementById('examForm');
        form.addEventListener('submit', function(e) {
            const startTime = new Date(form.querySelector('input[name="start_time"]').value);
            const endTime = new Date(form.querySelector('input[name="end_time"]').value);

            if (endTime <= startTime) {
                e.preventDefault();
                alert('⚠️ وقت النهاية يجب أن يكون بعد وقت البداية');
                return false;
            }

            if (displayMode.value === 'all_at_once' && !totalTime.value) {
                e.preventDefault();
                alert('⚠️ يرجى إدخال الزمن الكلي للامتحان');
                return false;
            }
        });

        // Add visual feedback for form interactions
        const formControls = document.querySelectorAll('.form-control');
        formControls.forEach(control => {
            control.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });

            control.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    });
</script>
@endpush
@endsection
