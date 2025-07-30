<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\StudyClass;

class StudyClassController extends Controller
{
    public function index()
    {
        $classes = StudyClass::withCount(['students', 'servants'])
            ->orderBy('name')
            ->get()
            ->map(function ($class) {
                // إضافة مسار الصورة الكامل
                if ($class->saint_image) {
                    if (file_exists(public_path('storage/images/' . $class->saint_image))) {
                        $class->saint_image = asset('storage/images/' . $class->saint_image);
                    } elseif (file_exists(public_path('images/' . $class->saint_image))) {
                        $class->saint_image = asset('images/' . $class->saint_image);
                    } else {
                        $class->saint_image = asset('images/default-class.jpg');
                    }
                } else {
                    $class->saint_image = asset('images/default-class.jpg');
                }

                return $class;
            });

        return response()->json($classes);
    }
}
