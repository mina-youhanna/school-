<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudyClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Filter by name
        if ($request->filled('name')) {
            $query->where('full_name', 'like', '%' . $request->name . '%');
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filter by gender
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }

        // Filter by deacon status
        if ($request->filled('is_deacon')) {
            $query->where('is_deacon', $request->is_deacon);
        }

        // Filter by deacon rank
        if ($request->filled('deacon_rank')) {
            $query->where('deacon_rank', $request->deacon_rank);
        }

        // Filter by age range
        if ($request->filled('age_min') || $request->filled('age_max')) {
            $query->whereNotNull('dob');
            if ($request->filled('age_min')) {
                $minDate = Carbon::now()->subYears($request->age_min);
                $query->where('dob', '<=', $minDate);
            }
            if ($request->filled('age_max')) {
                $maxDate = Carbon::now()->subYears($request->age_max);
                $query->where('dob', '>=', $maxDate);
            }
        }

        // Filter by class
        if ($request->filled('class')) {
            $query->where('my_class', $request->class);
        }

        // Filter by registration date
        if ($request->filled('registered_from')) {
            $query->where('created_at', '>=', $request->registered_from);
        }
        if ($request->filled('registered_to')) {
            $query->where('created_at', '<=', $request->registered_to . ' 23:59:59');
        }

        // Sort options
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        $users = $query->with('studyClass')->paginate(20)->withQueryString();

        // Get classes for filter dropdown
        $classes = StudyClass::orderBy('name')->get();

        // Get statistics
        $stats = [
            'total_users' => User::count(),
            'servants' => User::where('role', 'خادم')->count(),
            'students' => User::where('role', 'مخدوم')->count(),
            'admins' => User::where('role', 'admin')->count(),
            'males' => User::where('gender', 'ذكر')->count(),
            'females' => User::where('gender', 'أنثى')->count(),
        ];

        return view('admin.users.index', compact('users', 'classes', 'stats'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        // إضافة كلمة المرور العادية (إذا كانت موجودة)
        $user->password_plain = $user->password_plain ?? 'غير متوفرة';

        // إحصائيات الحضور إذا كان المستخدم طالب
        $attendanceStats = null;
        $attendanceRecords = null;
        if ($user->my_class_id) {
            try {
                $tableExists = \DB::select("SHOW TABLES LIKE 'attendance'");
                if (!empty($tableExists)) {
                    $attendanceStats = \DB::table('attendance')
                        ->where('student_id', $user->id)
                        ->where('class_id', $user->my_class_id)
                        ->selectRaw('
                            COUNT(*) as total_records,
                            SUM(CASE WHEN is_present = 1 THEN 1 ELSE 0 END) as present_count,
                            SUM(CASE WHEN is_present = 0 THEN 1 ELSE 0 END) as absent_count,
                            SUM(CASE WHEN tasbeha = 1 THEN 1 ELSE 0 END) as tasbeha_count,
                            SUM(CASE WHEN mass = 1 THEN 1 ELSE 0 END) as mass_count,
                            SUM(CASE WHEN class_attendance = 1 THEN 1 ELSE 0 END) as class_attendance_count,
                            SUM(CASE WHEN church_education = 1 THEN 1 ELSE 0 END) as church_education_count
                        ')
                        ->first();

                    // سجل الحضور التفصيلي
                    $attendanceRecords = \DB::table('attendance')
                        ->where('student_id', $user->id)
                        ->where('class_id', $user->my_class_id)
                        ->orderBy('date', 'desc')
                        ->limit(20)
                        ->get();
                } else {
                    $attendanceStats = (object) [
                        'total_records' => 0,
                        'present_count' => 0,
                        'absent_count' => 0,
                        'tasbeha_count' => 0,
                        'mass_count' => 0,
                        'class_attendance_count' => 0,
                        'church_education_count' => 0
                    ];
                }
            } catch (\Exception $e) {
                $attendanceStats = (object) [
                    'total_records' => 0,
                    'present_count' => 0,
                    'absent_count' => 0,
                    'tasbeha_count' => 0,
                    'mass_count' => 0,
                    'class_attendance_count' => 0,
                    'church_education_count' => 0
                ];
            }
        }

        // إحصائيات الامتحانات
        $examStats = null;
        $examResults = null;
        try {
            if (Schema::hasTable('exam_results')) {
                $examStats = DB::table('exam_results')
                    ->where('student_id', $user->id)
                    ->selectRaw('
                        COUNT(*) as total_exams,
                        AVG(score) as average_score,
                        MAX(score) as highest_score,
                        MIN(score) as lowest_score
                    ')
                    ->first();

                // نتائج الامتحانات التفصيلية
                $examResults = DB::table('exam_results')
                    ->join('exams', 'exam_results.exam_id', '=', 'exams.id')
                    ->where('exam_results.student_id', $user->id)
                    ->select('exam_results.*', 'exams.title as exam_title', 'exams.date as exam_date')
                    ->orderBy('exams.date', 'desc')
                    ->limit(10)
                    ->get();
            }
        } catch (\Exception $e) {
            $examStats = (object) [
                'total_exams' => 0,
                'average_score' => 0,
                'highest_score' => 0,
                'lowest_score' => 0
            ];
        }

        // معلومات الفصل
        $classInfo = null;
        if ($user->my_class_id) {
            try {
                $classInfo = DB::table('study_classes')
                    ->where('id', $user->my_class_id)
                    ->first();
            } catch (\Exception $e) {
                $classInfo = null;
            }
        }

        return view('admin.users.show', compact('user', 'attendanceStats', 'attendanceRecords', 'examStats', 'examResults', 'classInfo'));
    }

        public function edit($id)
    {
        $user = User::findOrFail($id);
        $classes = StudyClass::orderBy('name')->get();
        return view('admin.users.edit', compact('user', 'classes'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:ذكر,أنثى',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string|max:500',
            'role' => 'required|in:admin,servant,student,خادم,مخدوم',
            'is_main_servant' => 'boolean',
            'my_class' => 'nullable|exists:study_classes,id',
            'password' => 'nullable|string|min:6|confirmed',
            'is_deacon' => 'boolean',
            'deacon_rank' => 'nullable|string|max:255',
            'ordination_bishop' => 'nullable|string|max:255',
            'ordination_date' => 'nullable|date'
        ]);

        $data = $request->all();

        // تحويل my_class إلى my_class_id
        if (isset($data['my_class'])) {
            $data['my_class_id'] = $data['my_class'];
            unset($data['my_class']);
        }

        // تحويل birth_date إلى dob
        if (isset($data['birth_date'])) {
            $data['dob'] = $data['birth_date'];
            unset($data['birth_date']);
        }

        // إذا تم تغيير كلمة المرور، احفظ كلمة المرور العادية أيضاً
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
            $data['password_plain'] = $request->password;
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.users.show', $user->id)->with('success', 'تم تحديث المستخدم بنجاح');
    }

    public function updateRole(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'role' => 'required|in:admin,servant,student,خادم,مخدوم'
        ]);

        $user->update(['role' => $request->role]);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث دور المستخدم بنجاح',
            'new_role' => $request->role
        ]);
    }

    public function updateClass(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'my_class' => 'nullable|exists:study_classes,id'
        ]);

        $user->update(['my_class_id' => $request->my_class]);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث فصل المستخدم بنجاح',
            'new_class' => $request->my_class
        ]);
    }

    public function create()
    {
        $classes = StudyClass::orderBy('name')->get();
        return view('admin.users.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'gender' => 'nullable|in:ذكر,أنثى',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string|max:500',
            'role' => 'required|in:admin,servant,student,خادم,مخدوم',
            'my_class' => 'nullable|exists:study_classes,id'
        ]);

        User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'password_plain' => $request->password, // حفظ كلمة المرور العادية
            'phone' => $request->phone,
            'gender' => $request->gender,
            'dob' => $request->birth_date,
            'address' => $request->address,
            'role' => $request->role,
            'my_class_id' => $request->my_class,
        ]);

        return redirect()->route('admin.users')->with('success', 'تم إضافة المستخدم بنجاح');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'تم حذف المستخدم بنجاح'
        ]);
    }

    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
            'action' => 'required|in:change_role,delete,activate,deactivate',
            'new_role' => 'required_if:action,change_role|in:admin,servant,student,خادم,مخدوم'
        ]);

        $userIds = json_decode($request->user_ids);
        $action = $request->action;

        switch ($action) {
            case 'change_role':
                User::whereIn('id', $userIds)->update(['role' => $request->new_role]);
                $message = 'تم تحديث أدوار المستخدمين بنجاح';
                break;
            case 'delete':
                User::whereIn('id', $userIds)->delete();
                $message = 'تم حذف المستخدمين بنجاح';
                break;
            case 'activate':
                User::whereIn('id', $userIds)->update(['is_active' => true]);
                $message = 'تم تفعيل المستخدمين بنجاح';
                break;
            case 'deactivate':
                User::whereIn('id', $userIds)->update(['is_active' => false]);
                $message = 'تم إلغاء تفعيل المستخدمين بنجاح';
                break;
        }

        return redirect()->route('admin.users')->with('success', $message);
    }

    public function search(Request $request)
    {
        $query = $request->get('q');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $users = User::where('full_name', 'like', '%' . $query . '%')
                    ->where('role', 'مخدوم')
                    ->select('id', 'full_name')
                    ->limit(10)
                    ->get();

        return response()->json($users);
    }
}
