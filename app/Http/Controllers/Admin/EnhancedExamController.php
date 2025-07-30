<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EnhancedExam;
use App\Models\User;
use App\Models\StudyClass;

class EnhancedExamController extends Controller
{
    public function index(Request $request)
    {
        $query = EnhancedExam::with(['user', 'class']);

        // البحث بالتاريخ
        if ($request->filled('exam_date')) {
            $query->byDate($request->exam_date);
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

        // البحث بالمادة
        if ($request->filled('subject_name')) {
            $query->bySubject($request->subject_name);
        }

        $examRecords = $query->orderBy('exam_date', 'desc')->paginate(20);
        $users = User::where('role', 'مخدوم')->get();
        $classes = StudyClass::all();

        return view('admin.enhanced-exams.index', compact('examRecords', 'users', 'classes'));
    }

    public function create()
    {
        $users = User::where('role', 'مخدوم')->get();
        $classes = StudyClass::all();

        return view('admin.enhanced-exams.create', compact('users', 'classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'class_id' => 'required|exists:study_classes,id',
            'subject_name' => 'required|string|max:255',
            'exam_date' => 'required|date',
            'score' => 'required|numeric|min:0',
            'max_score' => 'required|numeric|min:1',
            'notes' => 'nullable|string'
        ]);

        // التحقق من عدم وجود سجل مكرر
        $existingRecord = EnhancedExam::where([
            'user_id' => $request->user_id,
            'class_id' => $request->class_id,
            'subject_name' => $request->subject_name,
            'exam_date' => $request->exam_date
        ])->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'يوجد سجل امتحان لهذا الطالب في نفس المادة في هذا اليوم بالفعل');
        }

        EnhancedExam::create($request->all());

        return redirect()->route('admin.enhanced-exams.index')->with('success', 'تم إضافة سجل الامتحان بنجاح');
    }

    public function edit($id)
    {
        $exam = EnhancedExam::findOrFail($id);
        $users = User::where('role', 'مخدوم')->get();
        $classes = StudyClass::all();

        return view('admin.enhanced-exams.edit', compact('exam', 'users', 'classes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'class_id' => 'required|exists:study_classes,id',
            'subject_name' => 'required|string|max:255',
            'exam_date' => 'required|date',
            'score' => 'required|numeric|min:0',
            'max_score' => 'required|numeric|min:1',
            'notes' => 'nullable|string'
        ]);

        $exam = EnhancedExam::findOrFail($id);

        // التحقق من عدم وجود سجل مكرر (باستثناء السجل الحالي)
        $existingRecord = EnhancedExam::where([
            'user_id' => $request->user_id,
            'class_id' => $request->class_id,
            'subject_name' => $request->subject_name,
            'exam_date' => $request->exam_date
        ])->where('id', '!=', $id)->first();

        if ($existingRecord) {
            return redirect()->back()->with('error', 'يوجد سجل امتحان لهذا الطالب في نفس المادة في هذا اليوم بالفعل');
        }

        $exam->update($request->all());

        return redirect()->route('admin.enhanced-exams.index')->with('success', 'تم تحديث سجل الامتحان بنجاح');
    }

    public function destroy($id)
    {
        $exam = EnhancedExam::findOrFail($id);
        $exam->delete();

        return redirect()->route('admin.enhanced-exams.index')->with('success', 'تم حذف سجل الامتحان بنجاح');
    }

    public function userExams($userId)
    {
        $user = User::findOrFail($userId);
        $examRecords = $user->enhancedExams()
            ->with('class')
            ->orderBy('exam_date', 'desc')
            ->paginate(20);

        return view('admin.enhanced-exams.user-exams', compact('user', 'examRecords'));
    }
}
