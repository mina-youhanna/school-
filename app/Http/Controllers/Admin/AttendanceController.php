<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\StudyClass;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index()
    {
        $classes = StudyClass::withCount(['students', 'servants'])->get();
        return view('admin.attendance.index', compact('classes'));
    }

    public function show($classId)
    {
        $class = StudyClass::with(['students', 'servants'])->findOrFail($classId);
        $attendances = Attendance::where('class_id', $classId)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $class->students_count = $class->students()->count();
        
        $students = $class->students;
        
        return view('admin.attendance.show', compact('class', 'attendances', 'students'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:study_classes,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:present,absent,late',
            'date' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        Attendance::create($request->all());

        return redirect()->back()->with('success', 'تم تسجيل الحضور بنجاح');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:present,absent,late',
            'notes' => 'nullable|string'
        ]);

        $attendance = Attendance::findOrFail($id);
        $attendance->update($request->only(['status', 'notes']));

        return redirect()->back()->with('success', 'تم تحديث الحضور بنجاح');
    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return redirect()->back()->with('success', 'تم حذف سجل الحضور بنجاح');
    }

    public function run()
    {
        DB::table('study_classes')->insert([
            "id" => 28,
            "name" => "فصل الشهيدة يوليطة",
            "stage" => "A2",
            "schedule" => "الجمعة - 11:00 إلى 12:30",
            "place" => "فصل 2 - الدور 6 بالكنيسة",
            "gender" => "أنثى",
            "saint_image" => "9-10.jpg",
            "created_at" => now(),
            "updated_at" => now(),
        ]);
        echo "تمت الإضافة";
    }
}