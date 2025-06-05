<?php

namespace App\Http\Controllers;

use App\Data\ClassesData;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function getMaleClasses()
    {
        return response()->json(ClassesData::getMaleClasses());
    }

    public function getFemaleClasses()
    {
        return response()->json(ClassesData::getFemaleClasses());
    }
} 