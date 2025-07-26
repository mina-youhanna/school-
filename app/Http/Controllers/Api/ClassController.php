<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;

class ClassController extends Controller
{
    public function index()
    {
        return response()->json(SchoolClass::all());
    }
}