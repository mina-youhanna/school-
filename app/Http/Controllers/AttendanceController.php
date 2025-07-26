<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get attendance records for the current user
        $attendanceRecords = Attendance::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->get();
            
        // Calculate statistics
        $totalDays = $attendanceRecords->count();
        $presentDays = $attendanceRecords->where('status', 'present')->count();
        $absentDays = $attendanceRecords->where('status', 'absent')->count();
        $attendancePercentage = $totalDays > 0 ? round(($presentDays / $totalDays) * 100) : 0;
        
        return view('attendance.index', compact(
            'attendanceRecords',
            'attendancePercentage',
            'presentDays',
            'absentDays'
        ));
    }
} 