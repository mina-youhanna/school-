@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="/css/exams-custom.css">
@endpush

@section('content')
<div class="container">
    <h2>تعديل سؤال في الامتحان: {{ $exam->title }}</h2>
    <form action="{{ route('questions.update', [$exam->id, $question->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>نوع السؤال</label>
            <select name="type" class="form-control" required id="questionType">
                <option value="true_false" {{ $question->type == 'true_false' ? 'selected' : '' }}>صح أو خطأ</option>
                <option value="multiple_choice" {{ $question->type == 'multiple_choice' ? 'selected' : '' }}>اختيار من متعدد</option>
                <option value="essay" {{ $question->type == 'essay' ? 'selected' : '' }}>مقالي</option>
            </select>
        </div>
        <div class="mb-3">
            <label>نص السؤال</label>
            <textarea name="question_text" class="form-control" required>{{ $question->question_text }}</textarea>
        </div>
        <div class="mb-3" id="correctAnswerDiv">
            <label>الإجابة الصحيحة</label>
            <input type="text" name="correct_answer" class="form-control" value="{{ $question->correct_answer }}">
        </div>
        <div class="mb-3">
            <label>الزمن (ثواني أو دقائق لكل سؤال)</label>
            <input type="number" name="question_time" class="form-control" value="{{ $question->question_time }}">
        </div>
        <div class="mb-3">
            <label>درجة السؤال</label>
            <input type="number" name="score" class="form-control" value="{{ $question->score }}" required>
        </div>
        <button type="submit" class="btn btn-primary">تحديث</button>
    </form>
</div>
<script>
// يمكنك لاحقًا إضافة جافاسكريبت لإظهار/إخفاء حقول حسب نوع السؤال
</script>
@endsection 