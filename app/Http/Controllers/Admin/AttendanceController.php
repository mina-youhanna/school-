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
        try {
            $attendances = Attendance::where('class_id', $classId)
                ->with('student')
                ->orderBy('created_at', 'desc')
                ->get();
        } catch (\Exception $e) {
            $attendances = collect([]);
        }
        
        $class->students_count = $class->students()->count();
        
        $students = $class->students;
        
        return view('admin.attendance.show', compact('class', 'attendances', 'students'));
    }

    public function loadAttendance(Request $request, $classId)
    {
        $date = $request->get('date', date('Y-m-d'));
        
        try {
            $attendance = Attendance::where('class_id', $classId)
                ->where('date', $date)
                ->get()
                ->map(function($record) {
                    return [
                        'student_id' => $record->student_id,
                        'status' => $record->is_present ? 'present' : 'absent',
                        'tasbeha' => $record->tasbeha,
                        'mass' => $record->mass,
                        'class_attendance' => $record->class_attendance,
                        'church_education' => $record->church_education,
                        'notes' => $record->notes
                    ];
                });
        } catch (\Exception $e) {
            $attendance = collect([]);
        }
            
        return response()->json([
            'success' => true,
            'attendance' => $attendance
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:study_classes,id',
            'attendance' => 'required|array',
            'attendance.*.student_id' => 'required|exists:users,id',
            'attendance.*.status' => 'required|in:present,absent,late',
            'attendance.*.date' => 'required|date',
            'attendance.*.tasbeha' => 'nullable|boolean',
            'attendance.*.mass' => 'nullable|boolean',
            'attendance.*.class_attendance' => 'nullable|boolean',
            'attendance.*.church_education' => 'nullable|boolean'
        ]);

        $classId = $request->class_id;
        $date = $request->attendance[0]['date'] ?? date('Y-m-d');

        try {
            // حذف السجلات السابقة لنفس التاريخ
            Attendance::where('class_id', $classId)
                ->where('date', $date)
                ->delete();

            // إنشاء السجلات الجديدة
            foreach ($request->attendance as $record) {
                Attendance::create([
                    'class_id' => $classId,
                    'student_id' => $record['student_id'],
                    'date' => $record['date'],
                    'is_present' => $record['status'] === 'present',
                    'tasbeha' => $record['tasbeha'] ?? false,
                    'mass' => $record['mass'] ?? false,
                    'class_attendance' => $record['class_attendance'] ?? false,
                    'church_education' => $record['church_education'] ?? false,
                    'notes' => $record['notes'] ?? null
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حفظ الحضور: ' . $e->getMessage()
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'تم حفظ الحضور بنجاح'
        ]);
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