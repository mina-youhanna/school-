<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Exam;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // عرض كل الأسئلة لامتحان معين
    public function index($exam_id)
    {
        $exam = Exam::findOrFail($exam_id);
        $questions = $exam->questions;
        return view('questions.index', compact('exam', 'questions'));
    }

    // عرض فورم إضافة سؤال
    public function create($exam_id)
    {
        $exam = Exam::findOrFail($exam_id);
        return view('questions.create', compact('exam'));
    }

    // حفظ سؤال جديد
    public function store(Request $request, $exam_id)
    {
        $data = $request->validate([
            'type' => 'required|in:true_false,multiple_choice,essay',
            'question_text' => 'required|string',
            'correct_answer' => 'nullable|string',
            'question_time' => 'nullable|integer',
            'score' => 'required|integer',
        ]);
        $data['exam_id'] = $exam_id;
        Question::create($data);
        return redirect()->route('questions.index', $exam_id)->with('success', 'تم إضافة السؤال');
    }

    // عرض فورم تعديل سؤال
    public function edit($exam_id, Question $question)
    {
        $exam = Exam::findOrFail($exam_id);
        return view('questions.edit', compact('exam', 'question'));
    }

    // تحديث سؤال
    public function update(Request $request, $exam_id, Question $question)
    {
        $data = $request->validate([
            'type' => 'required|in:true_false,multiple_choice,essay',
            'question_text' => 'required|string',
            'correct_answer' => 'nullable|string',
            'question_time' => 'nullable|integer',
            'score' => 'required|integer',
        ]);
        $question->update($data);
        return redirect()->route('questions.index', $exam_id)->with('success', 'تم تحديث السؤال');
    }

    // حذف سؤال
    public function destroy($exam_id, Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index', $exam_id)->with('success', 'تم حذف السؤال');
    }
}
