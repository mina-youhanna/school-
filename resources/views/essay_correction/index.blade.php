@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="/css/exams-custom.css">
@endpush

@section('content')
<div class="container">
    <h2>تصحيح الأسئلة المقالية لامتحان: {{ $exam->title }}</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>السؤال</th>
                <th>إجابة الطالب</th>
                <th>درجة التصحيح</th>
                <th>حفظ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($answers as $answer)
            <tr>
                <td>{{ $answer->question->question_text }}</td>
                <td>{{ $answer->answer_text }}</td>
                <td>
                    <form action="{{ route('essay_correction.update', $answer->id) }}" method="POST">
                        @csrf
                        <input type="number" name="score" class="form-control" min="0" max="{{ $answer->question->score }}" required>
                        <button type="submit" class="btn btn-success btn-sm mt-1">حفظ</button>
                    </form>
                </td>
                <td>
                    @if($answer->score !== null)
                        <span class="text-success">تم التصحيح</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 