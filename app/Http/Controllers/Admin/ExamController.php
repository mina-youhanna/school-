<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExamGrade;
use App\Models\User;
use App\Models\Exam;

class ExamController extends Controller
{
    public function __construct()
    {
        // هنا فقط تكتب الميدل وير
        // $this->middleware('auth');
        // $this->middleware('role:admin');
    }

    public function index(Request $request)
    {
        $exams = Exam::with(['subject', 'studyClass'])->get();
        return view('admin.exams.index', compact('exams'));
    }

    public function create()
    {
        $subjects = \App\Models\Subject::all();
        $classes = \App\Models\StudyClass::all();
        return view('admin.exams.create', compact('subjects', 'classes'));
    }

    public function store(Request $request)
    {
        // تحقق من صحة البيانات (يمكنك تعديل القواعد حسب الحاجة)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subject_id' => 'required|exists:subjects,id',
            'study_class_id' => 'required|exists:study_classes,id',
            // أضف الحقول الأخرى حسب قاعدة البيانات
        ]);

        // حفظ الامتحان
        \App\Models\Exam::create($validated);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('admin.exams.index')->with('success', 'تم إضافة الامتحان بنجاح');
    }
} 