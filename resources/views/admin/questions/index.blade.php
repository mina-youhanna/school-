@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="/css/exams-custom.css">
@endpush

@section('content')
<div class="container">
    <h2>أسئلة الامتحان: {{ $exam->title }}</h2>
    <a href="{{ route('questions.create', $exam->id) }}" class="btn btn-success mb-3">إضافة سؤال جديد</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>السؤال</th>
                <th>النوع</th>
                <th>الإجابة الصحيحة</th>
                <th>العمليات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
            <tr>
                <td>{{ $question->question_text }}</td>
                <td>{{ $question->type }}</td>
                <td>{{ $question->correct_answer }}</td>
                <td>
                    <a href="{{ route('questions.edit', [$exam->id, $question->id]) }}" class="btn btn-primary btn-sm">تعديل</a>
                    <form action="{{ route('questions.destroy', [$exam->id, $question->id]) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 