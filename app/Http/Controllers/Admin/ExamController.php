<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Subject;
use App\Models\StudyClass;
use App\Models\Question;
use App\Models\QuestionOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with(['subject', 'studyClass'])->get();
        return view('admin.exams.index', compact('exams'));
    }

    public function create()
    {
        $subjects = Subject::all();
        $classes = StudyClass::all();
        $stages = [
            'تمهيدي 1' => 'تمهيدي 1',
            'تمهيدي 2' => 'تمهيدي 2',
            'A1' => 'A1',
            'A2' => 'A2',
            'A3' => 'A3',
            'B1' => 'B1',
            'B2' => 'B2',
            'B3' => 'B3',
            'C1' => 'C1',
            'C2' => 'C2',
            'C3' => 'C3',
            'خدام' => 'خدام',
            'خاص' => 'خاص'
        ];

        return view('admin.exams.create', compact('subjects', 'classes', 'stages'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'exam_type' => 'required|in:class,stage',
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'nullable|exists:study_classes,id',
            'stage' => 'nullable|string',
            'title' => 'required|string|max:150',
            'display_mode' => 'required|in:one_by_one,all_at_once',
            'total_time' => 'nullable|integer',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'image' => 'nullable|string|max:255',
        ]);

        // التحقق من الحقول المطلوبة حسب نوع الامتحان
        if ($data['exam_type'] === 'class' && empty($data['class_id'])) {
            return redirect()->back()
                ->withErrors(['class_id' => 'يجب اختيار الفصل للامتحان المخصص للفصل'])
                ->withInput();
        }

        if ($data['exam_type'] === 'stage' && empty($data['stage'])) {
            return redirect()->back()
                ->withErrors(['stage' => 'يجب اختيار المستوى للامتحان المخصص للمستوى'])
                ->withInput();
        }

        // إذا كانت طريقة العرض "كل الأسئلة معًا" فيجب إدخال الزمن الكلي
        if ($data['display_mode'] === 'all_at_once' && empty($data['total_time'])) {
            return redirect()->back()
                ->withErrors(['total_time' => 'يجب إدخال الزمن الكلي عندما تكون طريقة العرض "كل الأسئلة معًا"'])
                ->withInput();
        }

        Exam::create($data);
        return redirect()->route('admin.exams.index')->with('success', 'تم إضافة الامتحان بنجاح');
    }

    public function show(Exam $exam)
    {
        $exam->load(['subject', 'questions']);
        return view('admin.exams.show', compact('exam'));
    }

    public function edit(Exam $exam)
    {
        $subjects = Subject::all();
        $classes = StudyClass::all();
        $stages = [
            'تمهيدي 1' => 'تمهيدي 1',
            'تمهيدي 2' => 'تمهيدي 2',
            'A1' => 'A1',
            'A2' => 'A2',
            'A3' => 'A3',
            'B1' => 'B1',
            'B2' => 'B2',
            'B3' => 'B3',
            'C1' => 'C1',
            'C2' => 'C2',
            'C3' => 'C3',
            'خدام' => 'خدام',
            'خاص' => 'خاص'
        ];

        return view('admin.exams.edit', compact('exam', 'subjects', 'classes', 'stages'));
    }

    public function update(Request $request, Exam $exam)
    {
        $data = $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:study_classes,id',
            'stage' => 'required|string',
            'title' => 'required|string|max:150',
            'display_mode' => 'required|in:one_by_one,all_at_once',
            'total_time' => 'nullable|integer',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'image' => 'nullable|string|max:255',
        ]);

        // إذا كانت طريقة العرض "كل الأسئلة معًا" فيجب إدخال الزمن الكلي
        if ($data['display_mode'] === 'all_at_once' && empty($data['total_time'])) {
            return redirect()->back()
                ->withErrors(['total_time' => 'يجب إدخال الزمن الكلي عندما تكون طريقة العرض "كل الأسئلة معًا"'])
                ->withInput();
        }

        $exam->update($data);
        return redirect()->route('admin.exams.index')->with('success', 'تم تحديث الامتحان بنجاح');
    }

    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect()->route('admin.exams.index')->with('success', 'تم حذف الامتحان بنجاح');
    }

    public function setupQuestions(Exam $exam)
    {
        return view('admin.exams.setup-questions', compact('exam'));
    }

    public function storeQuestions(Request $request, Exam $exam)
    {
        try {
            $data = $request->validate([
                'total_questions' => 'required|integer|min:1|max:50',
                'question_time' => 'required|integer|min:1|max:60',
                'multiple_choice_count' => 'required|integer|min:0',
                'multiple_choice_options' => 'required|in:3,4,5',
                'multiple_choice_score' => 'required|integer|min:1',
                'true_false_count' => 'required|integer|min:0',
                'true_false_score' => 'required|integer|min:1',
                'essay_count' => 'required|integer|min:0',
                'essay_score' => 'required|integer|min:1',
            ]);

            // التحقق من أن مجموع الأسئلة يساوي العدد المطلوب
            $totalQuestions = $data['multiple_choice_count'] + $data['true_false_count'] + $data['essay_count'];

            if ($totalQuestions !== $data['total_questions']) {
                return redirect()->back()
                    ->withErrors(['total_questions' => 'مجموع الأسئلة يجب أن يساوي العدد الكلي المطلوب'])
                    ->withInput();
            }

            // إنشاء الأسئلة
            $questionNumber = 1;

            // إنشاء أسئلة اختيار من متعدد
            for ($i = 0; $i < $data['multiple_choice_count']; $i++) {
                $question = Question::create([
                    'exam_id' => $exam->id,
                    'type' => 'multiple_choice',
                    'question_text' => "سؤال اختيار من متعدد رقم {$questionNumber}",
                    'correct_answer' => 'الإجابة الصحيحة',
                    'question_time' => $data['question_time'] * 60, // تحويل للثواني
                    'score' => $data['multiple_choice_score'],
                    'question_number' => $questionNumber
                ]);

                // إنشاء الخيارات
                for ($j = 1; $j <= $data['multiple_choice_options']; $j++) {
                    QuestionOption::create([
                        'question_id' => $question->id,
                        'option_text' => "الخيار {$j}",
                        'is_correct' => $j === 1 // الخيار الأول صحيح
                    ]);
                }

                $questionNumber++;
            }

            // إنشاء أسئلة صح أو خطأ
            for ($i = 0; $i < $data['true_false_count']; $i++) {
                Question::create([
                    'exam_id' => $exam->id,
                    'type' => 'true_false',
                    'question_text' => "سؤال صح أو خطأ رقم {$questionNumber}",
                    'correct_answer' => 'صح',
                    'question_time' => $data['question_time'] * 60,
                    'score' => $data['true_false_score'],
                    'question_number' => $questionNumber
                ]);

                $questionNumber++;
            }

            // إنشاء أسئلة مقالية
            for ($i = 0; $i < $data['essay_count']; $i++) {
                Question::create([
                    'exam_id' => $exam->id,
                    'type' => 'essay',
                    'question_text' => "سؤال مقالي رقم {$questionNumber}",
                    'correct_answer' => 'إجابة مقالية',
                    'question_time' => $data['question_time'] * 60,
                    'score' => $data['essay_score'],
                    'question_number' => $questionNumber
                ]);

                $questionNumber++;
            }

            // تحديث زمن الامتحان إذا كان سؤال بسؤال
            if ($exam->display_mode === 'one_by_one') {
                $exam->update([
                    'total_time' => $data['total_questions'] * $data['question_time']
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->withErrors(['error' => 'حدث خطأ أثناء إنشاء الأسئلة: ' . $e->getMessage()])
                ->withInput();
        }

        return redirect()->route('admin.exams.edit-questions', $exam)
            ->with('success', 'تم إنشاء الأسئلة بنجاح! يمكنك الآن تعديل الأسئلة وإضافة المحتوى.');
    }

    public function editQuestions(Exam $exam)
    {
        $exam->load('questions.options');
        return view('admin.exams.edit-questions', compact('exam'));
    }

    public function updateQuestions(Request $request, Exam $exam)
    {
        $questions = $request->input('questions', []);

        foreach ($questions as $questionId => $questionData) {
            $question = Question::find($questionId);

            if (!$question || $question->exam_id !== $exam->id) {
                continue;
            }

            // تحديث بيانات السؤال الأساسية
            $question->update([
                'question_text' => $questionData['question_text'],
                'question_time' => $questionData['question_time'] * 60, // تحويل للثواني
                'score' => $questionData['score']
            ]);

            // تحديث الإجابة الصحيحة حسب نوع السؤال
            if ($question->type === 'multiple_choice') {
                $correctOptionIndex = $questionData['correct_option'] ?? 0;

                // تحديث الخيارات
                foreach ($questionData['options'] as $index => $optionText) {
                    $option = $question->options->get($index);
                    if ($option) {
                        $option->update([
                            'option_text' => $optionText,
                            'is_correct' => $index == $correctOptionIndex
                        ]);
                    }
                }
            } else {
                $question->update([
                    'correct_answer' => $questionData['correct_answer']
                ]);
            }
        }

        return redirect()->route('admin.exams.show', $exam)
            ->with('success', 'تم تحديث الأسئلة بنجاح!');
    }

    public function createQuestionsForm(Request $request, $examId)
    {
        if ($request->isMethod('get')) {
            // عرض الصفحة بدون بيانات إعداد (أو بيانات افتراضية)
            $data = [
                'multiple_choice_count' => 0,
                'multiple_choice_options' => 4,
                'true_false_count' => 0,
                'essay_count' => 0,
            ];
        } else {
            // استقبل بيانات الإعدادات من الفورم
            $data = $request->all();
        }
        return view('admin.exams.create-questions', [
            'examId' => $examId,
            'setupData' => $data,
        ]);
    }

    public function saveQuestions(Request $request, $examId)
    {
        $exam = \App\Models\Exam::findOrFail($examId);
        $data = $request->all();
        $count = 0;
        // Multiple Choice
        if (!empty($data['mcq'])) {
            foreach ($data['mcq'] as $q) {
                \App\Models\Question::create([
                    'exam_id' => $examId,
                    'type' => 'mcq',
                    'question' => $q['question'],
                    'options' => json_encode($q['options']),
                    'correct_answer' => $q['correct'],
                ]);
                $count++;
            }
        }
        // True/False
        if (!empty($data['tf'])) {
            foreach ($data['tf'] as $q) {
                \App\Models\Question::create([
                    'exam_id' => $examId,
                    'type' => 'tf',
                    'question' => $q['question'],
                    'correct_answer' => $q['answer'],
                ]);
                $count++;
            }
        }
        // Essay
        if (!empty($data['essay'])) {
            foreach ($data['essay'] as $q) {
                \App\Models\Question::create([
                    'exam_id' => $examId,
                    'type' => 'essay',
                    'question' => $q['question'],
                ]);
                $count++;
            }
        }
        return redirect()->back()->with('success', 'تم حفظ ' . $count . ' سؤال بنجاح!');
    }
}
