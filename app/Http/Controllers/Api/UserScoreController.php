<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserScoreController extends Controller
{
    public function getScore(Request $request)
    {
        $user = $request->user();
        
        // Calculate total score based on various activities
        $score = 0;
        
        // Add points for attendance
        $attendanceScore = $user->attendance()->where('status', 'present')->count() * 5;
        $score += $attendanceScore;
        
        // Add points for exam grades
        $examScore = $user->examGrades()->avg('grade') ?? 0;
        $score += $examScore;
        
        // Add points for serving activities
        if ($user->role === 'خادم') {
            $servingScore = $user->servingActivities()->count() * 10;
            $score += $servingScore;
        }
        
        // Add points for completing courses
        $courseScore = $user->completedCourses()->count() * 15;
        $score += $courseScore;
        
        // Update user's score in the database
        $user->update(['score' => $score]);
        
        return response()->json([
            'score' => $score,
            'breakdown' => [
                'attendance' => $attendanceScore,
                'exams' => $examScore,
                'serving' => $user->role === 'خادم' ? $servingScore : 0,
                'courses' => $courseScore
            ]
        ]);
    }
} 