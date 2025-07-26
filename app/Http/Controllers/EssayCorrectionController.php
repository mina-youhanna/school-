<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\StudentAnswer;
use Illuminate\Http\Request;

class EssayCorrectionController extends Controller
{
    // عرض كل الإجابات المقالية غير المصححة
    public function index($exam_id)
    {
        $exam = Exam::findOrFail($exam_id);
        $essayQuestions = $exam->questions()->where('type', 'essay')->pluck('id');
        $answers = StudentAnswer::whereIn('question_id', $essayQuestions)
                                ->whereNull('score')
                                ->get();
        return view('essay_correction.index', compact('exam', 'answers'));
    }

    // حفظ درجة التصحيح
    public function update(Request $request, $answer_id)
    {
        $answer = StudentAnswer::findOrFail($answer_id);
        $request->validate([
            'score' => 'required|integer|min:0|max:' . $answer->question->score,
        ]);
        $answer->score = $request->score;
        $answer->save();

        // تحديث نتيجة الامتحان للطالب
        $total = StudentAnswer::where('user_id', $answer->user_id)
                              ->where('exam_id', $answer->exam_id)
                              ->sum('score');
        $answer->examResult()->updateOrCreate(
            ['user_id' => $answer->user_id, 'exam_id' => $answer->exam_id],
            ['total_score' => $total]
        );

        return back()->with('success', 'تم تصحيح السؤال بنجاح');
    }
}
