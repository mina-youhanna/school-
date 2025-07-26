@extends('layouts.app')
@section('content')
<div class="container">
    <h2>
        {{ $chapter->book_name ?? '' }} - إصحاح {{ $chapter->chapter_number ?? '' }}
    </h2>
    <pre style="background:#f9f9f9; padding:20px; border-radius:10px; font-size:1.2em; direction:rtl;">
        {{ $chapter->chapter_text ?? 'النص غير متوفر' }}
    </pre>
    <a href="{{ route('bible.chapters', $chapter->book_number) }}">العودة للإصحاحات</a>
</div>
@endsection
