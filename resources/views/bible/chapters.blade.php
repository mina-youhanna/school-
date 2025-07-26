


@extends('layouts.app')
@section('content')
<div class="container">
    <h2>إصحاحات سفر {{ $book->book_name ?? '' }}</h2>
    <ul>
        @foreach($chapters as $ch)
            <li>
                <a href="{{ route('bible.show', [$book_number, $ch->chapter_number]) }}">
                    إصحاح {{ $ch->chapter_number }}
                </a>
            </li>
        @endforeach
    </ul>
    <a href="{{ route('bible.index') }}">العودة لقائمة الأسفار</a>
</div>
@endsection