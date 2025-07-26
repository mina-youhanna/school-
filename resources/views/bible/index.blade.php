@extends('layouts.app')
@section('content')
<div class="container">
    <h2>أسفار الكتاب المقدس</h2>
    <ul>
        @foreach($books as $book)
            <li>
                <a href="{{ route('bible.chapters', $book->book_number) }}">
                    {{ $book->book_name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
