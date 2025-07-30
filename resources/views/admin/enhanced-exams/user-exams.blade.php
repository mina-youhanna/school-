@extends('layouts.app')

@section('title', 'سجل امتحانات ' . $user->full_name)

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<style>
    .user-exams-page {
        background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
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

    .title-text p {
        color: rgba(255, 255, 255, 0.8);
        margin: 5px 0 0 0;
        font-size: 16px;
    }

    .header-actions {
        display: flex;
        gap: 15px;
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

    .stats-section {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 30px;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .stat-number {
        font-size: 32px;
        font-weight: 700;
        color: #FFD700;
        margin-bottom: 5px;
    }

    .stat-label {
        color: rgba(255, 255, 255, 0.8);
        font-size: 14px;
        font-weight: 500;
    }

    .table-container {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th {
        background: linear-gradient(135deg, rgba(255, 215, 0, 0.2), rgba(255, 215, 0, 0.1));
        color: #FFD700;
        font-weight: 700;
        padding: 12px;
        text-align: center;
        border-bottom: 2px solid #FFD700;
        font-size: 13px;
    }

    .table td {
        padding: 12px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.9);
        text-align: center;
        vertical-align: middle;
    }

    .table tr:hover {
        background: rgba(255, 255, 255, 0.05);
    }

    .score-badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .score-excellent {
        background: linear-gradient(135deg, #4CAF50, #45a049);
        color: white;
    }

    .score-very-good {
        background: linear-gradient(135deg, #FF9800, #F57C00);
        color: white;
    }

    .score-good {
        background: linear-gradient(135deg, #2196F3, #1976D2);
        color: white;
    }

    .score-pass {
        background: linear-gradient(135deg, #00BCD4, #0097A7);
        color: white;
    }

    .score-fail {
        background: linear-gradient(135deg, #F44336, #D32F2F);
        color: white;
    }

    .pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 20px;
    }

    .page-link {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .page-link:hover {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        text-decoration: none;
    }

    .page-item.active .page-link {
        background: #FF9800;
        border-color: #FF9800;
    }

    @media (max-width: 768px) {
        .user-exams-page {
            padding: 15px;
        }

        .header-content {
            flex-direction: column;
            text-align: center;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .table-container {
            overflow-x: auto;
        }

        .table {
            font-size: 12px;
        }
    }
</style>
@endpush

@section('content')
<div class="user-exams-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-title">
                <div class="title-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="title-text">
                    <h1>سجل امتحانات {{ $user->full_name }}</h1>
                    <p>{{ $user->studyClass->name ?? 'بدون فصل' }}</p>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.enhanced-exams.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    <span>إضافة امتحان جديد</span>
                </a>
                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right"></i>
                    <span>العودة لتفاصيل الطالب</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="stats-section">
        <h3 style="color: white; margin-bottom: 20px; text-align: center;">إحصائيات الامتحانات</h3>
        <div class="stats-grid">
            @php
            $totalExams = $examRecords->total();
            $averageScore = $examRecords->avg('score') ?? 0;
            $highestScore = $examRecords->max('score') ?? 0;
            $lowestScore = $examRecords->min('score') ?? 0;
            $excellentCount = $examRecords->where('percentage', '>=', 90)->count();
            $goodCount = $examRecords->where('percentage', '>=', 70)->where('percentage', '<', 90)->count();
                $passCount = $examRecords->where('percentage', '>=', 60)->where('percentage', '<', 70)->count();
                    $failCount = $examRecords->where('percentage', '<', 60)->count();
                        @endphp

                        <div class="stat-card">
                            <div class="stat-number">{{ $totalExams }}</div>
                            <div class="stat-label">إجمالي الامتحانات</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">{{ round($averageScore, 1) }}</div>
                            <div class="stat-label">المتوسط</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">{{ $highestScore }}</div>
                            <div class="stat-label">أعلى درجة</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">{{ $lowestScore }}</div>
                            <div class="stat-label">أقل درجة</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">{{ $excellentCount }}</div>
                            <div class="stat-label">ممتاز</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">{{ $goodCount }}</div>
                            <div class="stat-label">جيد</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">{{ $passCount }}</div>
                            <div class="stat-label">مقبول</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-number">{{ $failCount }}</div>
                            <div class="stat-label">راسب</div>
                        </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>الفصل</th>
                    <th>المادة</th>
                    <th>تاريخ الامتحان</th>
                    <th>الدرجة</th>
                    <th>النسبة المئوية</th>
                    <th>التقييم</th>
                    <th>ملاحظات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($examRecords as $record)
                <tr>
                    <td>{{ $record->class->name }}</td>
                    <td>{{ $record->subject_name }}</td>
                    <td>{{ $record->exam_date->format('Y-m-d') }}</td>
                    <td>{{ $record->score }}/{{ $record->max_score }}</td>
                    <td>
                        <span class="score-badge score-{{ $record->percentage >= 90 ? 'excellent' : ($record->percentage >= 80 ? 'very-good' : ($record->percentage >= 70 ? 'good' : ($record->percentage >= 60 ? 'pass' : 'fail'))) }}">
                            {{ $record->percentage }}%
                        </span>
                    </td>
                    <td>{{ $record->evaluation }}</td>
                    <td>{{ $record->notes ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 40px;">
                        <div style="color: rgba(255, 255, 255, 0.7);">
                            <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 15px;"></i>
                            <p>لا توجد سجلات امتحانات لهذا الطالب</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($examRecords->hasPages())
    <div class="pagination">
        {{ $examRecords->links() }}
    </div>
    @endif
</div>
@endsection
