<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\ExamGrade;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'servants' => User::where('role', 'خادم')->count(),
            'students' => User::where('role', 'مخدوم')->count(),
            'total_attendance' => Attendance::count(),
            'total_exams' => ExamGrade::count(),
        ];
        
        return view('admin.dashboard', compact('stats'));
    }
} 