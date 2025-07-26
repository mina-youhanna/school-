@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="/css/exams-custom.css">
@endpush

@section('content')
<div class="container">
    <h2>الامتحانات المتاحة</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>اسم الامتحان</th>
                <th>المادة</th>
                <th>الفصل</th>
                <th>الحالة</th>
            </tr>
        </thead>
        <tbody>
            @foreach($exams as $exam)
            <tr>
                <td>{{ $exam->title }}</td>
                <td>{{ $exam->subject->name ?? '-' }}</td>
                <td>{{ $exam->studyClass->name ?? '-' }}</td>
                <td>
                    @php
                        $result = $exam->results->where('user_id', auth()->id())->first();
                    @endphp
                    @if($result)
                        <a href="{{ route('student_exams.result', $exam->id) }}" class="btn btn-success btn-sm">عرض النتيجة</a>
                    @else
                        <a href="{{ route('student_exams.show', $exam->id) }}" class="btn btn-primary btn-sm">ابدأ الآن</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 