<?php

namespace App\Http\Controllers;

use App\Models\Hymn;

class HymnController extends Controller
{
    public function index()
    {
        $hymns = Hymn::all();
        return view('hymns-library', compact('hymns'));
    }

    public function show($id)
    {
        $hymn = Hymn::findOrFail($id);
        return view('hymns.show', compact('hymn'));
    }
}
