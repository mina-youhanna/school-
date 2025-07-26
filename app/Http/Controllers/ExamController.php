<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Subject;
use App\Models\StudyClass;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    // عرض كل الامتحانات
    public function index()
    {
        $exams = Exam::with(['subject', 'studyClass'])->get();
        return view('exams.index', compact('exams'));
    }

    // عرض فورم إضافة امتحان جديد
    public function create()
    {
        $subjects = Subject::all();
        $classes = StudyClass::all();
        return view('exams.create', compact('subjects', 'classes'));
    }

    // حفظ امتحان جديد
    public function store(Request $request)
    {
        $data = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:study_classes,id',
            'title' => 'required|string|max:150',
            'display_mode' => 'required|in:one_by_one,all_at_once',
            'total_time' => 'nullable|integer',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'image' => 'nullable|string|max:255',
        ]);
        Exam::create($data);
        return redirect()->route('exams.index')->with('success', 'تم إضافة الامتحان بنجاح');
    }

    // عرض تفاصيل امتحان
    public function show(Exam $exam)
    {
        return view('exams.show', compact('exam'));
    }

    // عرض فورم تعديل امتحان
    public function edit(Exam $exam)
    {
        $subjects = Subject::all();
        $classes = StudyClass::all();
        return view('exams.edit', compact('exam', 'subjects', 'classes'));
    }

    // تحديث بيانات امتحان
    public function update(Request $request, Exam $exam)
    {
        $data = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:study_classes,id',
            'title' => 'required|string|max:150',
            'display_mode' => 'required|in:one_by_one,all_at_once',
            'total_time' => 'nullable|integer',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'image' => 'nullable|string|max:255',
        ]);
        $exam->update($data);
        return redirect()->route('exams.index')->with('success', 'تم تحديث الامتحان بنجاح');
    }

    // حذف امتحان
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('exams.index')->with('success', 'تم حذف الامتحان');
    }
} 