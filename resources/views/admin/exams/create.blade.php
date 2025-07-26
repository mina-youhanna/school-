@extends('layouts.app')

@push('styles')
<style>
/* exams-custom.css */
body {
    background: #0A2A4F !important;
}
.container {
    background: rgba(255,255,255,0.98) !important;
    border-radius: 18px;
    box-shadow: 0 6px 32px rgba(10,42,79,0.18);
    border: 2.5px solid #FFD700;
    color: #0A2A4F !important;
    padding: 2.5rem 1.5rem;
    margin-top: 2rem;
    margin-bottom: 2rem;
}
h2 {
    color: #FFD700 !important;
    font-weight: bold;
    margin-bottom: 2rem;
    letter-spacing: 1px;
    text-shadow: 0 2px 8px rgba(10,42,79,0.10);
}
.btn-success, .btn-primary, .btn-info, .btn-danger {
    min-width: 90px;
    font-weight: bold;
    border-radius: 8px;
    background: linear-gradient(90deg, #FFD700 60%, #FFC107 100%);
    color: #0A2A4F;
    border: none;
    box-shadow: 0 2px 8px rgba(255,215,0,0.10);
    transition: background 0.2s, color 0.2s;
}
.btn-success:hover, .btn-primary:hover, .btn-info:hover, .btn-danger:hover {
    background: #0A2A4F;
    color: #FFD700;
    border: 1.5px solid #FFD700;
}
.table {
    background: rgba(255,255,255,0.98) !important;
    border-radius: 8px;
    overflow: hidden;
    border: 2px solid #FFD700;
    box-shadow: 0 2px 12px rgba(10,42,79,0.10);
}
.table th {
    background: #0A2A4F !important;
    color: #FFD700 !important;
    font-weight: bold;
    border-bottom: 2px solid #FFD700;
}
.table td {
    color: #0A2A4F !important;
    font-weight: 500;
}
.table th, .table td {
    vertical-align: middle;
    text-align: center;
}
@media (max-width: 767px) {
    .container {
        padding: 1rem 0.3rem;
    }
    h2 {
        font-size: 1.2rem;
    }
    .btn {
        font-size: 0.95rem;
        padding: 0.4rem 0.7rem;
    }
    .table th, .table td {
        font-size: 0.95rem;
        padding: 0.4rem 0.2rem;
    }
}
textarea.form-control {
    min-height: 60px;
    border-radius: 8px;
    border: 1.5px solid #FFD700;
}
form label {
    font-weight: 700;
    color: #0A2A4F !important;
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
}
input.form-control, select.form-control, textarea.form-control {
    border: 2px solid #FFD700 !important;
    border-radius: 10px !important;
    color: #0A2A4F !important;
    background: #fffbe6 !important;
    font-weight: 600;
    font-size: 1.05rem;
    margin-bottom: 1.2rem;
    box-shadow: 0 1px 6px rgba(10,42,79,0.07);
    transition: border 0.2s, box-shadow 0.2s;
}
input.form-control:focus, select.form-control:focus, textarea.form-control:focus {
    border-color: #0A2A4F !important;
    box-shadow: 0 0 0 2px #FFD70055 !important;
    background: #fffde7 !important;
}
.btn-success {
    min-width: 120px;
    font-weight: bold;
    border-radius: 10px;
    background: linear-gradient(90deg, #FFD700 60%, #FFC107 100%) !important;
    color: #0A2A4F !important;
    border: none;
    box-shadow: 0 2px 8px rgba(255,215,0,0.13);
    font-size: 1.1rem;
    padding: 0.7rem 2.2rem;
    margin-top: 1rem;
    transition: background 0.2s, color 0.2s;
}
.btn-success:hover {
    background: #0A2A4F !important;
    color: #FFD700 !important;
    border: 2px solid #FFD700 !important;
}
.alert-success, .alert-warning {
    font-size: 1.1rem;
    border-radius: 8px;
    background: #FFD70022;
    color: #0A2A4F;
    border: 1.5px solid #FFD700;
}
</style>
@endpush

@section('content')
<div class="container">
    <h2>إضافة امتحان جديد</h2>
    <form action="{{ route('admin.exams.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>اسم الامتحان</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>المادة</label>
            <select name="subject_id" class="form-control" required>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>الفصل</label>
            <select name="class_id" class="form-control" required>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>طريقة العرض</label>
            <select name="display_mode" class="form-control" required>
                <option value="one_by_one">سؤال بسؤال</option>
                <option value="all_at_once">كل الأسئلة معًا</option>
            </select>
        </div>
        <div class="mb-3">
            <label>الزمن الكلي (دقائق)</label>
            <input type="number" name="total_time" class="form-control">
        </div>
        <div class="mb-3">
            <label>وقت البداية</label>
            <input type="datetime-local" name="start_time" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>وقت النهاية</label>
            <input type="datetime-local" name="end_time" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>رابط الصورة (اختياري)</label>
            <input type="text" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">حفظ</button>
    </form>
</div>
@endsection 