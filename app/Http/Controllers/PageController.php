<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudyClass;

class PageController extends Controller
{
    public function stStephensSchool()
    {
        $studentsCount = User::where('role', 'مخدوم')->count();
        $deaconsCount = User::where('is_deacon', true)->count();
        $servantsCount = User::where('role', 'خادم')->count();
        $classesCount = StudyClass::count();
        $startYear = 2019; // سنة تأسيس المدرسة
        $yearsOfService = date('Y') - $startYear + 1;
        return view('st-stephens-school', compact('studentsCount', 'deaconsCount', 'servantsCount', 'classesCount', 'yearsOfService'));
    }
}
