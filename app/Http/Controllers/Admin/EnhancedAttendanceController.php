<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EnhancedAttendance;
use App\Models\User;
use App\Models\StudyClass;
use Illuminate\Support\Facades\DB;

class EnhancedAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = EnhancedAttendance::with(['user', 'class']);

        // البحث بالتاريخ
        if ($request->filled('date')) {
            $query->byDate($request->date);
        }

        // البحث بنطاق تاريخ
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->dateRange($request->start_date, $request->end_date);
        }

        // البحث بالطالب
        if ($request->filled('user_id')) {
            $query->byUser($request->user_id);
        }

        // البحث بالفصل
        if ($request->filled('class_id')) {
            $query->byClass($request->class_id);
        }

        $attendanceRecords = $query->orderBy('date', 'desc')->paginate(20);
        $users = User::where('role', 'مخدوم')->get();
        $classes = StudyClass::all();

        return view('admin.enhanced-attendance.index', compact('attendanceRecords', 'users', 'classes'));
    }

    public function create()
    {
        $users = User::where('role', 'مخدوم')->get();
        $classes = StudyClass::all();

        return view('admin.enhanced-attendance.create', compact('users', 'classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'class_id' => 'required|exists:study_classes,id',
            'date' => 'required|date',
            'is_present' => 'boolean',
            'mass' => 'boolean',
            'tasbeha' => 'boolean',
            'class_attendance' => 'boolean',
            'church_education' => 'boolean',
            'notes' => 'nullable|string'
        ]);

        // التحقق من عدم وجود سجل مكرر
        $existingRecord = EnhancedAttendance::where([
            'user_id' => $request->user_id,
            'class_id' => $request->class_id,
            'date' => $request->date
        ])->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'يوجد سجل حضور لهذا الطالب في هذا اليوم بالفعل');
        }

        EnhancedAttendance::create($request->all());

        return redirect()->route('admin.enhanced-attendance.index')->with('success', 'تم إضافة سجل الحضور بنجاح');
    }

    public function edit($id)
    {
        $attendance = EnhancedAttendance::findOrFail($id);
        $users = User::where('role', 'مخدوم')->get();
        $classes = StudyClass::all();

        return view('admin.enhanced-attendance.edit', compact('attendance', 'users', 'classes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'class_id' => 'required|exists:study_classes,id',
            'date' => 'required|date',
            'is_present' => 'boolean',
            'mass' => 'boolean',
            'tasbeha' => 'boolean',
            'class_attendance' => 'boolean',
            'church_education' => 'boolean',
            'notes' => 'nullable|string'
        ]);

        $attendance = EnhancedAttendance::findOrFail($id);

        // التحقق من عدم وجود سجل مكرر (باستثناء السجل الحالي)
        $existingRecord = EnhancedAttendance::where([
            'user_id' => $request->user_id,
            'class_id' => $request->class_id,
            'date' => $request->date
        ])->where('id', '!=', $id)->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'يوجد سجل حضور لهذا الطالب في هذا اليوم بالفعل');
        }

        $attendance->update($request->all());

        return redirect()->route('admin.enhanced-attendance.index')->with('success', 'تم تحديث سجل الحضور بنجاح');
    }

    public function destroy($id)
    {
        $attendance = EnhancedAttendance::findOrFail($id);
        $attendance->delete();

        return redirect()->route('admin.enhanced-attendance.index')->with('success', 'تم حذف سجل الحضور بنجاح');
    }

    public function userAttendance($userId)
    {
        $user = User::findOrFail($userId);
        $attendanceRecords = $user->enhancedAttendance()
            ->with('class')
            ->orderBy('date', 'desc')
            ->paginate(20);

        return view('admin.enhanced-attendance.user-attendance', compact('user', 'attendanceRecords'));
    }
}
