<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use App\Models\StudyClass;
use App\Models\Exam;
use App\Models\ExamResult;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'servants' => User::where('role', 'خادم')->count(),
            'students' => User::where('role', 'مخدوم')->count(),
            'total_attendance' => $this->getAttendanceCount(),
            'total_exams' => $this->getExamCount(),
        ];

        // إحصائيات متقدمة
        $advancedStats = [
            'new_users_this_month' => $this->getNewUsersThisMonth(),
            'attendance_rate' => $this->getAttendanceRate(),
            'top_performing_classes' => $this->getTopPerformingClasses(),
            'recent_activities' => $this->getRecentActivities(),
            'gender_distribution' => $this->getGenderDistribution(),
            'age_distribution' => $this->getAgeDistribution(),
            'monthly_growth' => $this->getMonthlyGrowth(),
            'exam_performance' => $this->getExamPerformance(),
        ];
        
        return view('admin.dashboard', compact('stats', 'advancedStats'));
    }

    private function getAttendanceCount()
    {
        try {
            if (Schema::hasTable('attendance')) {
                return Attendance::count();
            }
            return 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    private function getExamCount()
    {
        try {
            if (Schema::hasTable('exams')) {
                return DB::table('exams')->count();
            }
            return 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    private function getNewUsersThisMonth()
    {
        return User::where('created_at', '>=', Carbon::now()->startOfMonth())->count();
    }

    private function getAttendanceRate()
    {
        try {
            if (Schema::hasTable('attendance')) {
                $total = Attendance::count();
                $present = Attendance::where('is_present', true)->count();
                return $total > 0 ? round(($present / $total) * 100, 1) : 0;
            }
            return 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    private function getTopPerformingClasses()
    {
        try {
            if (Schema::hasTable('study_classes')) {
                return StudyClass::withCount('students')
                    ->orderBy('students_count', 'desc')
                    ->take(5)
                    ->get();
            }
            return collect();
        } catch (\Exception $e) {
            return collect();
        }
    }

    private function getRecentActivities()
    {
        $activities = collect();
        
        // آخر المستخدمين المسجلين
        $recentUsers = User::latest()->take(5)->get();
        foreach ($recentUsers as $user) {
            $activities->push([
                'type' => 'user_registered',
                'title' => 'مستخدم جديد',
                'description' => 'انضم ' . $user->full_name . ' إلى النظام',
                'time' => $user->created_at->diffForHumans(),
                'icon' => 'fas fa-user-plus',
                'color' => 'primary'
            ]);
        }

        // آخر الحضور
        try {
            if (Schema::hasTable('attendance')) {
                $recentAttendance = Attendance::with('student')->latest()->take(3)->get();
                foreach ($recentAttendance as $attendance) {
                    $activities->push([
                        'type' => 'attendance',
                        'title' => 'تسجيل حضور',
                        'description' => $attendance->student->full_name . ' - ' . ($attendance->is_present ? 'حاضر' : 'غائب'),
                        'time' => $attendance->created_at->diffForHumans(),
                        'icon' => $attendance->is_present ? 'fas fa-check-circle' : 'fas fa-times-circle',
                        'color' => $attendance->is_present ? 'success' : 'danger'
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Ignore if table doesn't exist
        }

        return $activities->sortByDesc('time')->take(8);
    }

    private function getGenderDistribution()
    {
        $males = User::where('gender', 'ذكر')->count();
        $females = User::where('gender', 'أنثى')->count();
        $total = $males + $females;
        
        return [
            'males' => $total > 0 ? round(($males / $total) * 100, 1) : 0,
            'females' => $total > 0 ? round(($females / $total) * 100, 1) : 0,
            'total_males' => $males,
            'total_females' => $females
        ];
    }

    private function getAgeDistribution()
    {
        $users = User::whereNotNull('birth_date')->get();
        $ageGroups = [
            'children' => 0, // 0-12
            'teens' => 0,    // 13-19
            'young_adults' => 0, // 20-30
            'adults' => 0    // 30+
        ];

        foreach ($users as $user) {
            $age = Carbon::parse($user->birth_date)->age;
            if ($age <= 12) $ageGroups['children']++;
            elseif ($age <= 19) $ageGroups['teens']++;
            elseif ($age <= 30) $ageGroups['young_adults']++;
            else $ageGroups['adults']++;
        }

        return $ageGroups;
    }

    private function getMonthlyGrowth()
    {
        $months = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $count = User::whereYear('created_at', $date->year)
                        ->whereMonth('created_at', $date->month)
                        ->count();
            $months[] = [
                'month' => $date->format('M'),
                'count' => $count
            ];
        }
        return $months;
    }

    private function getExamPerformance()
    {
        try {
            if (Schema::hasTable('exam_results')) {
                $results = DB::table('exam_results')->get();
                if ($results->count() > 0) {
                    $avgScore = $results->avg('score');
                    $passingCount = $results->where('score', '>=', 50)->count();
                    $totalExams = $results->count();
                    
                    return [
                        'average_score' => round($avgScore, 1),
                        'passing_rate' => $totalExams > 0 ? round(($passingCount / $totalExams) * 100, 1) : 0,
                        'total_exam_takers' => $totalExams
                    ];
                }
            }
            return ['average_score' => 0, 'passing_rate' => 0, 'total_exam_takers' => 0];
        } catch (\Exception $e) {
            return ['average_score' => 0, 'passing_rate' => 0, 'total_exam_takers' => 0];
        }
    }
} 