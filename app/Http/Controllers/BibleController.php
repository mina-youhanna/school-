<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BibleController extends Controller
{
    // عرض قائمة الأسفار
    public function index()
    {
        $books = DB::table('bible_chapters')
            ->select('book_number', 'book_name')
            ->distinct()
            ->orderBy('book_number')
            ->get();
        return view('bible.index', compact('books'));
    }

    // عرض قائمة الإصحاحات لسفر معين
    public function chapters($book_number)
    {
        $book = DB::table('bible_chapters')
            ->where('book_number', $book_number)
            ->select('book_name')
            ->first();

        $chapters = DB::table('bible_chapters')
            ->where('book_number', $book_number)
            ->select('chapter_number')
            ->orderBy('chapter_number')
            ->get();

        return view('bible.chapters', compact('book', 'chapters', 'book_number'));
    }

    // عرض نص الإصحاح
    public function show($book_number, $chapter_number)
    {
        $chapter = DB::table('bible_chapters')
            ->where('book_number', $book_number)
            ->where('chapter_number', $chapter_number)
            ->first();

        return view('bible.show', compact('chapter'));
    }

    // صفحة العهد القديم الرئيسية
    public function oldTestament()
    {
        $books = DB::table('bible_chapters')
            ->select('book_number', 'book_name')
            ->where('book_number', '<=', 47) // حسب عدد أسفار العهد القديم عندك
            ->distinct()
            ->orderBy('book_number')
            ->get();
        return view('bible.old', compact('books'));
    }

    // عرض الإصحاحات لسفر معين
    public function oldChapters($book_number)
    {
        $book = DB::table('bible_chapters')
            ->where('book_number', $book_number)
            ->select('book_name')
            ->first();

        $chapters = DB::table('bible_chapters')
            ->where('book_number', $book_number)
            ->select('chapter_number')
            ->orderBy('chapter_number')
            ->get();

        $books = DB::table('bible_chapters')
            ->select('book_number', 'book_name')
            ->where('book_number', '<=', 47)
            ->distinct()
            ->orderBy('book_number')
            ->get();

        return view('bible.old', compact('book', 'chapters', 'book_number', 'books'));
    }

    // عرض نص الإصحاح
    public function oldShow($book_number, $chapter_number)
    {
        $chapter = DB::table('bible_chapters')
            ->where('book_number', $book_number)
            ->where('chapter_number', $chapter_number)
            ->first();

        $book = DB::table('bible_chapters')
            ->where('book_number', $book_number)
            ->select('book_name')
            ->first();

        $chapters = DB::table('bible_chapters')
            ->where('book_number', $book_number)
            ->select('chapter_number')
            ->orderBy('chapter_number')
            ->get();

        $books = DB::table('bible_chapters')
            ->select('book_number', 'book_name')
            ->where('book_number', '<=', 47)
            ->distinct()
            ->orderBy('book_number')
            ->get();

        return view('bible.old', compact('chapter', 'book', 'chapters', 'book_number', 'books'));
    }
}
