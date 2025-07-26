<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\StudyClass;

class StudyClassController extends Controller
{
    public function index()
    {
        return response()->json(StudyClass::all());
    }
}
