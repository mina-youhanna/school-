<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewBibleChapter;

class NewBibleChapterController extends Controller
{
    public function index($book_number = null)
    {
        $books = NewBibleChapter::select('book_num', 'book_name')->distinct()->get();
        $chapters = $book_number ? NewBibleChapter::where('book_num', $book_number)->get() : null;
        return view('bible.new', compact('books', 'book_number', 'chapters'));
    }

    public function show($book_number, $chapter_number)
    {
        $books = NewBibleChapter::select('book_num', 'book_name')->distinct()->get();
        $chapters = NewBibleChapter::where('book_num', $book_number)->get();
        $chapter = NewBibleChapter::where('book_num', $book_number)
            ->where('chapter_number', $chapter_number)
            ->first();

        return view('bible.new', compact('books', 'book_number', 'chapters', 'chapter'));
    }
}