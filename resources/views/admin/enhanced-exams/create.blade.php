@extends('layouts.app')

@section('title', 'إضافة امتحان جديد')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
    .create-exam-page {
        background: linear-gradient(135deg, #0A2A4F 0%, #1a4a8a 100%);
        min-height: 100vh;
        padding: 20px;
        font-family: 'Cairo', sans-serif;
    }

    .page-header {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .header-title {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .title-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #FF9800, #F57C00);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        box-shadow: 0 4px 15px rgba(255, 152, 0, 0.3);
    }

    .title-text h1 {
        color: white;
        font-size: 28px;
        font-weight: 700;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .form-container {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 30px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 25px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .form-group label {
        color: white;
        font-weight: 600;
        font-size: 14px;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        padding: 12px 15px;
        color: white;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: #FF9800;
        box-shadow: 0 0 0 2px rgba(255, 152, 0, 0.2);
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .btn {
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        border: none;
        text-decoration: none;
        color: white;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(135deg, #FF9800, #F57C00);
    }

    .btn-secondary {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        color: white;
        text-decoration: none;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
    }

    @media (max-width: 768px) {
        .create-exam-page {
            padding: 15px;
        }

        .header-content {
            flex-direction: column;
            text-align: center;
        }

        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-actions {
            flex-direction: column;
        }
    }
</style>
@endpush

@section('content')
<div class="create-exam-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-title">
                <div class="title-icon">
                    <i class="fas fa-plus"></i>
                </div>
                <div class="title-text">
                    <h1>إضافة امتحان جديد</h1>
                    <p>إضافة سجل امتحان للطالب</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="form-container">
        <form method="POST" action="{{ route('admin.enhanced-exams.store') }}">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label for="user_id">الطالب *</label>
                    <select name="user_id" id="user_id" class="form-control" required>
                        <option value="">اختر الطالب</option>
                        @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->full_name }} - {{ $user->studyClass->name ?? 'بدون فصل' }}
                        </option>
                        @endforeach
                    </select>
                    @error('user_id')
                    <span style="color: #ff6b6b; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="class_id">الفصل *</label>
                    <select name="class_id" id="class_id" class="form-control" required>
                        <option value="">اختر الفصل</option>
                        @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->name }} - {{ $class->stage }}
                        </option>
                        @endforeach
                    </select>
                    @error('class_id')
                    <span style="color: #ff6b6b; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="subject_name">المادة *</label>
                    <input type="text" name="subject_name" id="subject_name" class="form-control" placeholder="اسم المادة" value="{{ old('subject_name') }}" required>
                    @error('subject_name')
                    <span style="color: #ff6b6b; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="exam_date">تاريخ الامتحان *</label>
                    <input type="date" name="exam_date" id="exam_date" class="form-control" value="{{ old('exam_date', date('Y-m-d')) }}" required>
                    @error('exam_date')
                    <span style="color: #ff6b6b; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="score">الدرجة *</label>
                    <input type="number" name="score" id="score" class="form-control" placeholder="الدرجة" value="{{ old('score') }}" min="0" step="0.01" required>
                    @error('score')
                    <span style="color: #ff6b6b; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="max_score">الدرجة القصوى *</label>
                    <input type="number" name="max_score" id="max_score" class="form-control" placeholder="الدرجة القصوى" value="{{ old('max_score', 100) }}" min="1" step="0.01" required>
                    @error('max_score')
                    <span style="color: #ff6b6b; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="notes">ملاحظات</label>
                    <textarea name="notes" id="notes" class="form-control" rows="4" placeholder="أضف ملاحظات إضافية...">{{ old('notes') }}</textarea>
                    @error('notes')
                    <span style="color: #ff6b6b; font-size: 12px;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-actions">
                <a href="{{ route('admin.enhanced-exams.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right"></i>
                    <span>إلغاء</span>
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    <span>حفظ الامتحان</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
