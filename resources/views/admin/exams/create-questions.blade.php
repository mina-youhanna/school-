@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 800px;">
    <h2 class="text-center mb-4 main-title">إدخال الأسئلة للامتحان رقم {{ $examId }}</h2>
    <form method="POST" action="{{ route('admin.exams.save-questions', ['exam' => $examId]) }}">
        @csrf
        @php
        $mc_count = isset($setupData['multiple_choice_count']) ? (int)$setupData['multiple_choice_count'] : 0;
        $mc_options = isset($setupData['multiple_choice_options']) ? (int)$setupData['multiple_choice_options'] : 4;
        $tf_count = isset($setupData['true_false_count']) ? (int)$setupData['true_false_count'] : 0;
        $essay_count = isset($setupData['essay_count']) ? (int)$setupData['essay_count'] : 0;
        @endphp

        @if($mc_count > 0)
        <h4 class="section-title">أسئلة اختيار من متعدد ({{ $mc_count }})</h4>
        @for($i = 1; $i <= $mc_count; $i++)
            <div class="question-card mb-4">
            <label class="question-label question-badge">سؤال رقم {{ $i }}:</label>
            <input type="text" name="mcq[{{ $i }}][question]" class="form-control mb-2" placeholder="نص السؤال" required>
            @for($j = 1; $j <= $mc_options; $j++)
                <input type="text" name="mcq[{{ $i }}][options][{{ $j }}]" class="form-control mb-1" placeholder="اختيار رقم {{ $j }}" required>
                @endfor
                <label class="mt-2 question-badge">الإجابة الصحيحة:</label>
                <select name="mcq[{{ $i }}][correct]" class="form-control mb-2" required>
                    @for($j = 1; $j <= $mc_options; $j++)
                        <option value="{{ $j }}">اختيار رقم {{ $j }}</option>
                        @endfor
                </select>
</div>
@endfor
@endif

@if($tf_count > 0)
<h4 class="section-title">أسئلة صح أو خطأ ({{ $tf_count }})</h4>
@for($i = 1; $i <= $tf_count; $i++)
    <div class="question-card mb-4">
    <label class="question-label question-badge">سؤال رقم {{ $i }}:</label>
    <input type="text" name="tf[{{ $i }}][question]" class="form-control mb-2" placeholder="نص السؤال" required>
    <label class="question-badge">الإجابة:</label>
    <select name="tf[{{ $i }}][answer]" class="form-control mb-2" required>
        <option value="1">صح</option>
        <option value="0">خطأ</option>
    </select>
    </div>
    @endfor
    @endif

    @if($essay_count > 0)
    <h4 class="section-title">أسئلة مقالية ({{ $essay_count }})</h4>
    @for($i = 1; $i <= $essay_count; $i++)
        <div class="question-card mb-4">
        <label class="question-label question-badge">سؤال رقم {{ $i }}:</label>
        <input type="text" name="essay[{{ $i }}][question]" class="form-control mb-2" placeholder="نص السؤال" required>
        </div>
        @endfor
        @endif

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success btn-lg">حفظ الأسئلة</button>
        </div>
        </form>
        </div>

        <style>
            .main-title {
                color: #d4af37;
                font-weight: bold;
                letter-spacing: 1px;
                text-shadow: 0 2px 8px #0002;
            }

            .question-card {
                background: #fffbe9;
                border-radius: 14px;
                padding: 22px 20px;
                box-shadow: 0 2px 12px #0001;
                border: 2px solid #d4af37;
            }

            .question-label {
                font-weight: bold;
                margin-bottom: 6px;
                display: block;
            }

            .question-badge {
                background: #0d3a5a;
                color: #fff;
                padding: 6px 16px;
                border-radius: 8px;
                display: inline-block;
                margin-bottom: 10px;
                font-size: 1.08em;
            }

            .section-title {
                margin: 32px 0 18px 0;
                font-weight: bold;
                color: #d4af37;
                letter-spacing: 0.5px;
                text-shadow: 0 1px 4px #0001;
            }

            .form-control {
                border-radius: 8px;
            }
        </style>
        @endsection
