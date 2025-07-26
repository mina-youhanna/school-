<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\StudentAnswer;
use App\Models\ExamResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentExamController extends Controller
{
    // عرض الامتحانات المتاحة للطالب
    public function index()
    {
        $exams = Exam::where('start_time', '<=', now())
                     ->where('end_time', '>=', now())
                     ->get();
        return view('student_exams.index', compact('exams'));
    }

    // بدء الامتحان (عرض الأسئلة)
    public function show($exam_id)
    {
        $exam = Exam::with('questions.options')->findOrFail($exam_id);
        return view('student_exams.show', compact('exam'));
    }

    // حفظ إجابات الطالب
    public function submit(Request $request, $exam_id)
    {
        $exam = Exam::findOrFail($exam_id);
        $user = Auth::user();

        foreach ($request->answers as $question_id => $answer) {
            StudentAnswer::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'exam_id' => $exam_id,
                    'question_id' => $question_id,
                ],
                [
                    'answer_text' => $answer,
                    // يمكنك إضافة منطق التصحيح التلقائي هنا
                ]
            );
        }

        // حساب الدرجة الكلية (لغير الأسئلة المقالية)
        $total_score = 0;
        foreach ($exam->questions as $question) {
            $studentAnswer = StudentAnswer::where([
                'user_id' => $user->id,
                'exam_id' => $exam_id,
                'question_id' => $question->id,
            ])->first();

            if ($question->type != 'essay' && $studentAnswer) {
                if (trim($studentAnswer->answer_text) == trim($question->correct_answer)) {
                    $studentAnswer->is_correct = true;
                    $studentAnswer->score = $question->score;
                    $total_score += $question->score;
                } else {
                    $studentAnswer->is_correct = false;
                    $studentAnswer->score = 0;
                }
                $studentAnswer->save();
            }
        }

        ExamResult::updateOrCreate(
            ['user_id' => $user->id, 'exam_id' => $exam_id],
            ['total_score' => $total_score]
        );

        return redirect()->route('student_exams.result', $exam_id)->with('success', 'تم إرسال الامتحان');
    }

    // عرض نتيجة الطالب
    public function result($exam_id)
    {
        $user = Auth::user();
        $result = ExamResult::where('user_id', $user->id)->where('exam_id', $exam_id)->first();
        return view('student_exams.result', compact('result'));
    }
}
