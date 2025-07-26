@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="/css/exams-custom.css">
@endpush

@section('content')
<div class="container">
    <h2>نتيجة الامتحان</h2>
    @if($result)
        <div class="alert alert-success">مجموع الدرجات: {{ $result->total_score }}</div>
    @else
        <div class="alert alert-warning">لم يتم العثور على نتيجة لهذا الامتحان.</div>
    @endif
    <a href="{{ route('student_exams.index') }}" class="btn btn-primary">العودة لقائمة الامتحانات</a>
</div>
@endsection 