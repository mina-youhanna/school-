@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="/css/exams-custom.css">
@endpush

@section('content')
<div class="container">
    <h2>إضافة سؤال جديد للامتحان: {{ $exam->title }}</h2>
    <form action="{{ route('questions.store', $exam->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>نوع السؤال</label>
            <select name="type" class="form-control" required id="questionType">
                <option value="true_false">صح أو خطأ</option>
                <option value="multiple_choice">اختيار من متعدد</option>
                <option value="essay">مقالي</option>
            </select>
        </div>
        <div class="mb-3">
            <label>نص السؤال</label>
            <textarea name="question_text" class="form-control" required></textarea>
        </div>
        <div class="mb-3" id="correctAnswerDiv">
            <label>الإجابة الصحيحة</label>
            <input type="text" name="correct_answer" class="form-control">
        </div>
        <div class="mb-3">
            <label>الزمن (ثواني أو دقائق لكل سؤال)</label>
            <input type="number" name="question_time" class="form-control">
        </div>
        <div class="mb-3">
            <label>درجة السؤال</label>
            <input type="number" name="score" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">حفظ</button>
    </form>
</div>
<script>
// يمكنك لاحقًا إضافة جافاسكريبت لإظهار/إخفاء حقول حسب نوع السؤال
</script>
@endsection 