@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="/css/exams-custom.css">
@endpush

@section('content')
<div class="container">
    <h2>تعديل بيانات الامتحان</h2>
    <form action="{{ route('exams.update', $exam) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>اسم الامتحان</label>
            <input type="text" name="title" class="form-control" value="{{ $exam->title }}" required>
        </div>
        <div class="mb-3">
            <label>المادة</label>
            <select name="subject_id" class="form-control" required>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}" {{ $exam->subject_id == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>الفصل</label>
            <select name="class_id" class="form-control" required>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}" {{ $exam->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>طريقة العرض</label>
            <select name="display_mode" class="form-control" required>
                <option value="one_by_one" {{ $exam->display_mode == 'one_by_one' ? 'selected' : '' }}>سؤال بسؤال</option>
                <option value="all_at_once" {{ $exam->display_mode == 'all_at_once' ? 'selected' : '' }}>كل الأسئلة معًا</option>
            </select>
        </div>
        <div class="mb-3">
            <label>الزمن الكلي (دقائق)</label>
            <input type="number" name="total_time" class="form-control" value="{{ $exam->total_time }}">
        </div>
        <div class="mb-3">
            <label>وقت البداية</label>
            <input type="datetime-local" name="start_time" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($exam->start_time)) }}" required>
        </div>
        <div class="mb-3">
            <label>وقت النهاية</label>
            <input type="datetime-local" name="end_time" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($exam->end_time)) }}" required>
        </div>
        <div class="mb-3">
            <label>رابط الصورة (اختياري)</label>
            <input type="text" name="image" class="form-control" value="{{ $exam->image }}">
        </div>
        <button type="submit" class="btn btn-primary">تحديث</button>
    </form>
</div>
@endsection 