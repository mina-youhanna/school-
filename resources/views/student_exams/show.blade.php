@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="/css/exams-custom.css">
@endpush

@section('content')
<div class="container">
    <h2>امتحان: {{ $exam->title }}</h2>
    <form action="{{ route('student_exams.submit', $exam->id) }}" method="POST">
        @csrf
        @foreach($exam->questions as $question)
            <div class="mb-4">
                <strong>{{ $loop->iteration }}. {{ $question->question_text }}</strong>
                @if($question->type == 'true_false')
                    <div>
                        <label><input type="radio" name="answers[{{ $question->id }}]" value="صح" required> صح</label>
                        <label><input type="radio" name="answers[{{ $question->id }}]" value="خطأ"> خطأ</label>
                    </div>
                @elseif($question->type == 'multiple_choice')
                    @foreach($question->options as $option)
                        <div>
                            <label><input type="radio" name="answers[{{ $question->id }}]" value="{{ $option->option_text }}" required> {{ $option->option_text }}</label>
                        </div>
                    @endforeach
                @elseif($question->type == 'essay')
                    <textarea name="answers[{{ $question->id }}]" class="form-control" rows="2" required></textarea>
                @endif
            </div>
        @endforeach
        <button type="submit" class="btn btn-success">إرسال الامتحان</button>
    </form>
</div>
@endsection 