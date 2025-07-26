@extends('layouts.app')

@section('title', $exam->title)

@section('content')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">{{ $exam->title }}</h3>
                        <div id="timer" class="h4 mb-0"></div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="examForm" action="{{ route('exams.submit', $exam) }}" method="POST">
                        @csrf
                        
                        <div class="exam-info mb-4">
                            <p class="text-muted">{{ $exam->description }}</p>
                            <div class="d-flex justify-content-between">
                                <span class="badge bg-info">الدرجة الكلية: {{ $exam->total_marks }}</span>
                                <span class="badge bg-warning">درجة النجاح: {{ $exam->passing_marks }}</span>
                            </div>
                        </div>

                        @foreach($exam->questions as $index => $question)
                        <div class="question-card mb-4 p-3 border rounded">
                            <h5 class="mb-3">سؤال {{ $index + 1 }}: {{ $question->question }}</h5>
                            <div class="options">
                                @foreach(json_decode($question->options) as $option)
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" 
                                           name="answers[{{ $question->id }}]" 
                                           id="q{{ $question->id }}_{{ $loop->index }}"
                                           value="{{ $option }}">
                                    <label class="form-check-label" for="q{{ $question->id }}_{{ $loop->index }}">
                                        {{ $option }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="mt-2">
                                <span class="badge bg-secondary">الدرجة: {{ $question->marks }}</span>
                            </div>
                        </div>
                        @endforeach

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg">
                                إنهاء الامتحان
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.question-card {
    background: #fff;
    transition: all 0.3s ease;
}

.question-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.form-check-input:checked {
    background-color: #0A2A4F;
    border-color: #0A2A4F;
}

.btn-primary {
    background: #0A2A4F;
    border: none;
    padding: 12px 30px;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: #FFD700;
    color: #0A2A4F;
    transform: translateY(-2px);
}

#timer {
    background: rgba(255,255,255,0.1);
    padding: 5px 15px;
    border-radius: 20px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Timer functionality
    const duration = {{ $exam->duration }} * 60; // Convert to seconds
    const timerDisplay = document.getElementById('timer');
    const examForm = document.getElementById('examForm');
    
    let timeLeft = duration;
    
    function updateTimer() {
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        
        timerDisplay.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
        
        if (timeLeft <= 0) {
            examForm.submit();
        } else {
            timeLeft--;
            setTimeout(updateTimer, 1000);
        }
    }
    
    updateTimer();
    
    // Prevent accidental navigation
    window.addEventListener('beforeunload', function(e) {
        if (timeLeft > 0) {
            e.preventDefault();
            e.returnValue = '';
        }
    });
    
    // Form submission confirmation
    examForm.addEventListener('submit', function(e) {
        if (timeLeft > 0) {
            if (!confirm('هل أنت متأكد من إنهاء الامتحان؟')) {
                e.preventDefault();
            }
        }
    });
});
</script>
@endsection 