@extends('layouts.app')

@section('title', 'تفاصيل المستخدم - ' . $user->full_name)

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/user-details.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
<div class="container-fluid user-details-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-title">
                <div class="title-icon">
                    <i class="fas fa-user"></i>
                </div>
                <div class="title-text">
                    <h1>تفاصيل المستخدم</h1>
                    <p>{{ $user->full_name }}</p>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                    <span>تعديل البيانات</span>
                </a>
                <a href="{{ route('admin.enhanced-attendance.user', $user->id) }}" class="btn btn-primary">
                    <i class="fas fa-calendar-check"></i>
                    <span>سجل الحضور</span>
                </a>
                <a href="{{ route('admin.enhanced-exams.user', $user->id) }}" class="btn btn-info">
                    <i class="fas fa-file-alt"></i>
                    <span>سجل الامتحانات</span>
                </a>
                <a href="{{ route('admin.users') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right"></i>
                    <span>العودة للقائمة</span>
                </a>
            </div>
        </div>
    </div>

    <!-- User Info Cards -->
    <div class="user-info-section">
        <div class="info-grid">
            <!-- Personal Information -->
            <div class="info-card personal-info">
                <div class="card-header">
                    <h3><i class="fas fa-user-circle"></i> المعلومات الشخصية</h3>
                </div>
                <div class="card-content">
                    <div class="user-avatar-large">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="info-list">
                        <div class="info-item">
                            <span class="label">الاسم الكامل:</span>
                            <span class="value">{{ $user->full_name }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">البريد الإلكتروني:</span>
                            <span class="value">{{ $user->email }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">كلمة المرور:</span>
                            <span class="value">
                                <div class="password-container">
                                    <input type="password"
                                        class="password-field"
                                        value="{{ $user->password_plain ?? 'غير متوفرة' }}"
                                        readonly
                                        id="passwordField">
                                    <button type="button" class="btn btn-sm btn-outline-primary toggle-password"
                                        onclick="togglePassword()">
                                        <i class="fas fa-eye" id="passwordIcon"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-success copy-password"
                                        onclick="copyPassword()">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="label">رقم الهاتف:</span>
                            <span class="value">{{ $user->phone ?? 'غير محدد' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">رقم الواتساب:</span>
                            <span class="value">{{ $user->whatsapp ?? 'غير محدد' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">رقم هاتف ولي الأمر:</span>
                            <span class="value">{{ $user->relative_phone ?? 'غير محدد' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">النوع:</span>
                            <span class="value">
                                @if($user->gender == 'ذكر')
                                <span class="badge badge-male">ذكر</span>
                                @elseif($user->gender == 'أنثى')
                                <span class="badge badge-female">أنثى</span>
                                @else
                                <span class="badge badge-unknown">غير محدد</span>
                                @endif
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="label">تاريخ الميلاد:</span>
                            <span class="value">{{ $user->dob ? Carbon\Carbon::parse($user->dob)->format('Y-m-d') : 'غير محدد' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">العمر:</span>
                            <span class="value">{{ $user->dob ? Carbon\Carbon::parse($user->dob)->age . ' سنة' : 'غير محدد' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">العنوان:</span>
                            <span class="value">{{ $user->address ?? 'غير محدد' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">أب الاعتراف:</span>
                            <span class="value">{{ $user->confession_father ?? 'غير محدد' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">الدور:</span>
                            <span class="value">
                                @switch($user->role)
                                @case('admin')
                                <span class="badge badge-admin">مدير</span>
                                @break
                                @case('خادم')
                                <span class="badge badge-servant">خادم</span>
                                @break
                                @case('مخدوم')
                                <span class="badge badge-student">مخدوم</span>
                                @break
                                @default
                                <span class="badge badge-unknown">{{ $user->role }}</span>
                                @endswitch
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="label">النقاط:</span>
                            <span class="value">{{ $user->score ?? 0 }} نقطة</span>
                        </div>
                        <div class="info-item">
                            <span class="label">تاريخ التسجيل:</span>
                            <span class="value">{{ $user->created_at->format('Y-m-d H:i') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">آخر تحديث:</span>
                            <span class="value">{{ $user->updated_at->format('Y-m-d H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Class Information -->
            @if($classInfo)
            <div class="info-card class-info">
                <div class="card-header">
                    <h3><i class="fas fa-graduation-cap"></i> معلومات الفصل</h3>
                </div>
                <div class="card-content">
                    <div class="class-details">
                        <div class="info-item">
                            <span class="label">اسم الفصل:</span>
                            <span class="value">{{ $classInfo->name }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">المرحلة:</span>
                            <span class="value">{{ $classInfo->stage }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">عدد الطلاب:</span>
                            <span class="value">{{ $classInfo->students_count ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Deacon Information -->
            <div class="info-card deacon-info">
                <div class="card-header">
                    <h3><i class="fas fa-cross"></i> معلومات الشماسية</h3>
                </div>
                <div class="card-content">
                    <div class="info-list">
                        <div class="info-item">
                            <span class="label">هل هو شماس:</span>
                            <span class="value">
                                @if($user->is_deacon)
                                <span class="badge badge-deacon">نعم، شماس</span>
                                @else
                                <span class="badge badge-not-deacon">لا، ليس شماس</span>
                                @endif
                            </span>
                        </div>
                        @if($user->is_deacon)
                        <div class="info-item">
                            <span class="label">الرتبة:</span>
                            <span class="value">
                                @switch($user->deacon_rank)
                                @case('شماس إنجيلي')
                                <span class="badge badge-evangelist">شماس إنجيلي</span>
                                @break
                                @case('شماس إبصالتوس')
                                <span class="badge badge-epsaltos">شماس إبصالتوس</span>
                                @break
                                @case('شماس أناغنوستيس')
                                <span class="badge badge-anagnostis">شماس أناغنوستيس</span>
                                @break
                                @case('شماس إيبودياكون')
                                <span class="badge badge-ipodiakon">شماس إيبودياكون</span>
                                @break
                                @case('شماس دياكون')
                                <span class="badge badge-diakon">شماس دياكون</span>
                                @break
                                @case('شماس أرشدياكون')
                                <span class="badge badge-archdiakon">شماس أرشدياكون</span>
                                @break
                                @default
                                <span class="badge badge-deacon-rank">{{ $user->deacon_rank ?? 'غير محدد' }}</span>
                                @endswitch
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="label">بيد مين من الاساقفة:</span>
                            <span class="value">{{ $user->ordination_bishop ?? 'غير محدد' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="label">تاريخ السيامة:</span>
                            <span class="value">{{ $user->ordination_date ? Carbon\Carbon::parse($user->ordination_date)->format('Y-m-d') : 'غير محدد' }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Section -->
    @if($attendanceStats || $examStats)
    <div class="stats-section">
        <div class="stats-grid">
            @if($attendanceStats)
            <!-- Attendance Statistics -->
            <div class="stats-card attendance-stats">
                <div class="card-header">
                    <h3 class="golden-title"><i class="fas fa-calendar-check"></i> إحصائيات الحضور</h3>
                </div>
                <div class="card-content">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-number">{{ $attendanceStats->total_records ?? 0 }}</div>
                            <div class="stat-label">عدد الأسابيع</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $attendanceStats->present_count ?? 0 }}</div>
                            <div class="stat-label">حضور</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">{{ $attendanceStats->absent_count ?? 0 }}</div>
                            <div class="stat-label">غياب</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-number">
                                @php
                                $attendanceRate = $attendanceStats->total_records > 0
                                ? round(($attendanceStats->present_count / $attendanceStats->total_records) * 100, 1)
                                : 0;
                                @endphp
                                {{ $attendanceRate }}%
                            </div>
                            <div class="stat-label">نسبة الحضور</div>
                        </div>
                    </div>

                    <div class="additional-stats">
                        @php
                        $totalWeeks = $attendanceStats->total_records ?? 0;
                        $tasbehaCount = $attendanceStats->tasbeha_count ?? 0;
                        $massCount = $attendanceStats->mass_count ?? 0;
                        $classCount = $attendanceStats->class_attendance_count ?? 0;
                        $educationCount = $attendanceStats->church_education_count ?? 0;

                        $tasbehaPercentage = $totalWeeks > 0 ? round(($tasbehaCount / $totalWeeks) * 100) : 0;
                        $massPercentage = $totalWeeks > 0 ? round(($massCount / $totalWeeks) * 100) : 0;
                        $classPercentage = $totalWeeks > 0 ? round(($classCount / $totalWeeks) * 100) : 0;
                        $educationPercentage = $totalWeeks > 0 ? round(($educationCount / $totalWeeks) * 100) : 0;

                        $getColorClass = function($percentage) {
                        if ($percentage >= 0 && $percentage < 40) return 'text-danger' ;
                            if ($percentage>= 40 && $percentage < 70) return 'text-warning' ;
                                return 'text-success' ;
                                };
                                @endphp

                                <div class="stat-row">
                                <span class="label golden-text">التسبيح:</span>
                                <span class="value {{ $getColorClass($tasbehaPercentage) }}">
                                    {{ $tasbehaCount }}/{{ $totalWeeks }} ({{ $tasbehaPercentage }}%)
                                </span>
                    </div>
                    <div class="stat-row">
                        <span class="label golden-text">القداس:</span>
                        <span class="value {{ $getColorClass($massPercentage) }}">
                            {{ $massCount }}/{{ $totalWeeks }} ({{ $massPercentage }}%)
                        </span>
                    </div>
                    <div class="stat-row">
                        <span class="label golden-text">حضور الفصل:</span>
                        <span class="value {{ $getColorClass($classPercentage) }}">
                            {{ $classCount }}/{{ $totalWeeks }} ({{ $classPercentage }}%)
                        </span>
                    </div>
                    <div class="stat-row">
                        <span class="label golden-text">التعليم الكنسي:</span>
                        <span class="value {{ $getColorClass($educationPercentage) }}">
                            {{ $educationCount }}/{{ $totalWeeks }} ({{ $educationPercentage }}%)
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($examStats)
    <!-- Exam Statistics -->
    <div class="stats-card exam-stats">
        <div class="card-header">
            <h3><i class="fas fa-chart-line"></i> إحصائيات الامتحانات</h3>
        </div>
        <div class="card-content">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">{{ $examStats->total_exams ?? 0 }}</div>
                    <div class="stat-label">إجمالي الامتحانات</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ round($examStats->average_score ?? 0, 1) }}</div>
                    <div class="stat-label">المتوسط</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $examStats->highest_score ?? 0 }}</div>
                    <div class="stat-label">أعلى درجة</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $examStats->lowest_score ?? 0 }}</div>
                    <div class="stat-label">أقل درجة</div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
</div>
@endif

<!-- Detailed Exam Results -->
@if($examResults && $examResults->count() > 0)
<div class="exam-details-section">
    <div class="exam-details-card">
        <div class="card-header">
            <h3><i class="fas fa-file-alt"></i> تفاصيل الامتحانات</h3>
        </div>
        <div class="card-content">
            <div class="table-container">
                <table class="exam-results-table">
                    <thead>
                        <tr>
                            <th>اسم الامتحان</th>
                            <th>التاريخ</th>
                            <th>الدرجة</th>
                            <th>النسبة المئوية</th>
                            <th>التقييم</th>
                            <th>ملاحظات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($examResults as $result)
                        <tr>
                            <td>{{ $result->exam_name ?? 'امتحان غير محدد' }}</td>
                            <td>{{ $result->exam_date ? Carbon\Carbon::parse($result->exam_date)->format('Y-m-d') : 'غير محدد' }}</td>
                            <td>
                                <span class="score-badge score-{{ $result->score >= 90 ? 'excellent' : ($result->score >= 80 ? 'very-good' : ($result->score >= 70 ? 'good' : ($result->score >= 60 ? 'pass' : 'fail'))) }}">
                                    {{ $result->score ?? 0 }}/100
                                </span>
                            </td>
                            <td>
                                <div class="percentage-bar">
                                    <div class="percentage-fill" style="width: {{ $result->score ?? 0 }}%"></div>
                                    <span class="percentage-text">{{ $result->score ?? 0 }}%</span>
                                </div>
                            </td>
                            <td>
                                @php
                                $evaluation = '';
                                $evaluationClass = '';
                                if ($result->score >= 90) {
                                $evaluation = 'ممتاز';
                                $evaluationClass = 'excellent';
                                } elseif ($result->score >= 80) {
                                $evaluation = 'جيد جداً';
                                $evaluationClass = 'very-good';
                                } elseif ($result->score >= 70) {
                                $evaluation = 'جيد';
                                $evaluationClass = 'good';
                                } elseif ($result->score >= 60) {
                                $evaluation = 'مقبول';
                                $evaluationClass = 'pass';
                                } else {
                                $evaluation = 'راسب';
                                $evaluationClass = 'fail';
                                }
                                @endphp
                                <span class="evaluation-badge {{ $evaluationClass }}">{{ $evaluation }}</span>
                            </td>
                            <td>{{ $result->notes ?? 'لا توجد ملاحظات' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Detailed Records -->
<div class="records-section">
    <!-- Attendance Records -->
    @if($attendanceRecords && $attendanceRecords->count() > 0)
    <div class="records-card">
        <div class="card-header">
            <h3><i class="fas fa-list-alt"></i> سجل الحضور (آخر 20 جلسة)</h3>
        </div>
        <div class="card-content">
            <div class="table-container">
                <table class="records-table">
                    <thead>
                        <tr>
                            <th>التاريخ</th>
                            <th>الحضور</th>
                            <th>التسبيح</th>
                            <th>القداس</th>
                            <th>حضور الفصل</th>
                            <th>التعليم الكنسي</th>
                            <th>ملاحظات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendanceRecords as $record)
                        <tr>
                            <td>{{ Carbon\Carbon::parse($record->date)->format('Y-m-d') }}</td>
                            <td>
                                @if($record->is_present)
                                <span class="badge badge-success">حاضر</span>
                                @else
                                <span class="badge badge-danger">غائب</span>
                                @endif
                            </td>
                            <td>
                                @if($record->tasbeha)
                                <span class="badge badge-success">نعم</span>
                                @else
                                <span class="badge badge-secondary">لا</span>
                                @endif
                            </td>
                            <td>
                                @if($record->mass)
                                <span class="badge badge-success">نعم</span>
                                @else
                                <span class="badge badge-secondary">لا</span>
                                @endif
                            </td>
                            <td>
                                @if($record->class_attendance)
                                <span class="badge badge-success">نعم</span>
                                @else
                                <span class="badge badge-secondary">لا</span>
                                @endif
                            </td>
                            <td>
                                @if($record->church_education)
                                <span class="badge badge-success">نعم</span>
                                @else
                                <span class="badge badge-secondary">لا</span>
                                @endif
                            </td>
                            <td>{{ $record->notes ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif

    <!-- Exam Results -->
    @if($examResults && $examResults->count() > 0)
    <div class="records-card">
        <div class="card-header">
            <h3><i class="fas fa-file-alt"></i> نتائج الامتحانات (آخر 10 امتحانات)</h3>
        </div>
        <div class="card-content">
            <div class="table-container">
                <table class="records-table">
                    <thead>
                        <tr>
                            <th>اسم الامتحان</th>
                            <th>التاريخ</th>
                            <th>الدرجة</th>
                            <th>النسبة المئوية</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($examResults as $result)
                        <tr>
                            <td>{{ $result->exam_title }}</td>
                            <td>{{ Carbon\Carbon::parse($result->exam_date)->format('Y-m-d') }}</td>
                            <td>{{ $result->score }}</td>
                            <td>
                                @php
                                $percentage = ($result->score / 100) * 100;
                                @endphp
                                <span class="badge {{ $percentage >= 90 ? 'badge-success' : ($percentage >= 70 ? 'badge-warning' : 'badge-danger') }}">
                                    {{ round($percentage, 1) }}%
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endif
</div>
</div>

<!-- Modal عرض كلمة المرور -->
<div class="modal fade" id="passwordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">كلمة المرور</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="password-display">
                    <input type="text" class="form-control" id="passwordField" readonly>
                    <button type="button" class="btn btn-primary mt-2" id="copyPassword">
                        <i class="fas fa-copy"></i> نسخ
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* ===== User Details Page Styles ===== */
    .user-details-page {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        min-height: 100vh;
        padding: 20px;
    }

    /* ===== Page Header ===== */
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
        background: linear-gradient(135deg, #4CAF50, #45a049);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 24px;
        box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
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

    .header-actions .btn {
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        border: none;
        text-decoration: none;
    }

    .header-actions .btn-warning {
        background: linear-gradient(135deg, #FF9800, #F57C00);
        color: white;
    }

    .header-actions .btn-secondary {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .header-actions .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        color: white;
        text-decoration: none;
    }

    /* ===== User Info Section ===== */
    .user-info-section {
        margin-bottom: 30px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 15px;
    }

    .info-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .card-header {
        background: rgba(255, 255, 255, 0.1);
        padding: 20px 25px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .card-header h3 {
        color: white;
        margin: 0;
        font-size: 18px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-content {
        padding: 20px;
        min-height: 200px;
    }

    /* ===== User Avatar ===== */
    .user-avatar-large {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #4CAF50, #45a049);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 32px;
        margin: 0 auto 20px;
        box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
    }

    /* ===== Info List ===== */
    .info-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .info-item:last-child {
        border-bottom: none;
    }

    .info-item .label {
        color: rgba(255, 255, 255, 0.8);
        font-weight: 600;
        font-size: 14px;
    }

    .info-item .value {
        color: white;
        font-weight: 500;
        font-size: 14px;
        text-align: left;
    }

    /* ===== Password Container ===== */
    .password-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .password-field {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 8px;
        color: white;
        padding: 8px 12px;
        font-size: 12px;
        font-family: monospace;
        min-width: 150px;
    }

    .password-field:focus {
        outline: none;
        border-color: #4CAF50;
    }

    .toggle-password,
    .copy-password {
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 12px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        background: rgba(255, 255, 255, 0.1);
        color: white;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .toggle-password:hover,
    .copy-password:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-1px);
    }

    /* ===== Badge Styles ===== */
    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .badge-admin {
        background: linear-gradient(135deg, #F44336, #D32F2F);
        color: white;
    }

    .badge-servant {
        background: linear-gradient(135deg, #4CAF50, #45a049);
        color: white;
    }

    .badge-student {
        background: linear-gradient(135deg, #00BCD4, #0097A7);
        color: white;
    }

    .badge-male {
        background: linear-gradient(135deg, #2196F3, #1976D2);
        color: white;
    }

    .badge-female {
        background: linear-gradient(135deg, #E91E63, #C2185B);
        color: white;
    }

    .badge-unknown {
        background: rgba(255, 255, 255, 0.2);
        color: rgba(255, 255, 255, 0.8);
    }

    .badge-success {
        background: linear-gradient(135deg, #4CAF50, #45a049);
        color: white;
    }

    .badge-danger {
        background: linear-gradient(135deg, #F44336, #D32F2F);
        color: white;
    }

    .badge-secondary {
        background: rgba(255, 255, 255, 0.2);
        color: rgba(255, 255, 255, 0.8);
    }

    /* ===== Statistics Section ===== */
    .stats-section {
        margin-bottom: 30px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
    }

    .stats-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
    }

    .stats-card .card-content {
        padding: 25px;
    }

    .stats-card .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 20px;
    }

    .stat-item {
        text-align: center;
        padding: 15px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
    }

    .stat-number {
        font-size: 24px;
        font-weight: 700;
        color: white;
        margin-bottom: 5px;
    }

    .stat-label {
        color: rgba(255, 255, 255, 0.8);
        font-size: 12px;
        font-weight: 500;
    }

    .additional-stats {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding-top: 20px;
    }

    .stat-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .stat-row:last-child {
        border-bottom: none;
    }

    .stat-row .label {
        color: rgba(255, 255, 255, 0.8);
        font-size: 14px;
    }

    .stat-row .value {
        color: white;
        font-weight: 600;
        font-size: 14px;
    }

    /* ===== Exam Details Styles ===== */
    .exam-details-section {
        margin-top: 30px;
    }

    .exam-details-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
    }

    .exam-details-card .card-header h3 {
        color: #FFD700;
    }

    .exam-results-table {
        width: 100%;
        border-collapse: collapse;
    }

    .exam-results-table th {
        background: linear-gradient(135deg, rgba(255, 215, 0, 0.2), rgba(255, 215, 0, 0.1));
        color: #FFD700;
        font-weight: 700;
        padding: 12px;
        text-align: center;
        border-bottom: 2px solid #FFD700;
        font-size: 13px;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    }

    .exam-results-table td {
        padding: 10px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.9);
        text-align: center;
        vertical-align: middle;
        font-size: 13px;
    }

    .exam-results-table tr:hover {
        background: rgba(255, 255, 255, 0.05);
    }

    .score-badge {
        background: linear-gradient(135deg, #4CAF50, #45a049);
        color: white;
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
    }

    .score-excellent {
        background: linear-gradient(135deg, #4CAF50, #45a049);
    }

    .score-very-good {
        background: linear-gradient(135deg, #FF9800, #F57C00);
    }

    .score-good {
        background: linear-gradient(135deg, #2196F3, #1976D2);
    }

    .score-pass {
        background: linear-gradient(135deg, #00BCD4, #0097A7);
    }

    .score-fail {
        background: linear-gradient(135deg, #F44336, #D32F2F);
    }

    .percentage-bar {
        width: 100%;
        height: 10px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 5px;
        position: relative;
        overflow: hidden;
    }

    .percentage-fill {
        height: 100%;
        border-radius: 5px;
        background: linear-gradient(135deg, #4CAF50, #45a049);
        position: absolute;
        top: 0;
        left: 0;
        transition: width 0.3s ease-in-out;
    }

    .percentage-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 12px;
        font-weight: 600;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    }

    .evaluation-badge {
        background: rgba(255, 255, 255, 0.2);
        color: rgba(255, 255, 255, 0.8);
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        display: inline-block;
    }

    .evaluation-excellent {
        background: linear-gradient(135deg, #4CAF50, #45a049);
        color: white;
    }

    .evaluation-very-good {
        background: linear-gradient(135deg, #FF9800, #F57C00);
        color: white;
    }

    .evaluation-good {
        background: linear-gradient(135deg, #2196F3, #1976D2);
        color: white;
    }

    .evaluation-pass {
        background: linear-gradient(135deg, #00BCD4, #0097A7);
        color: white;
    }

    .evaluation-fail {
        background: linear-gradient(135deg, #F44336, #D32F2F);
        color: white;
    }

    /* ===== Records Section ===== */
    .records-section {
        margin-top: 30px;
    }

    .records-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        overflow: hidden;
    }

    .records-table {
        width: 100%;
        border-collapse: collapse;
    }

    .records-table th {
        background: linear-gradient(135deg, rgba(255, 215, 0, 0.2), rgba(255, 215, 0, 0.1));
        color: #FFD700;
        font-weight: 700;
        padding: 12px;
        text-align: center;
        border-bottom: 2px solid #FFD700;
        font-size: 13px;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    }

    .records-table td {
        padding: 10px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.9);
        text-align: center;
        vertical-align: middle;
        font-size: 13px;
    }

    .records-table tr:hover {
        background: rgba(255, 255, 255, 0.05);
    }

    /* ===== Table Container ===== */
    .table-container {
        overflow-x: auto;
        border-radius: 10px;
    }

    /* ===== Responsive Design ===== */
    @media (max-width: 768px) {
        .user-details-page {
            padding: 15px;
        }

        .header-content {
            flex-direction: column;
            text-align: center;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .stats-card .stats-grid {
            grid-template-columns: 1fr;
        }

        .info-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }

        .password-container {
            flex-direction: column;
            align-items: flex-start;
        }

        .table-container {
            font-size: 12px;
        }
    }

    /* ===== Typography Improvements ===== */
    .user-details-page {
        font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
    }

    .page-header h1 {
        font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .page-header p {
        font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 400;
        letter-spacing: 0.2px;
    }

    .card-header h3 {
        font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    .info-item .label {
        font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 600;
        letter-spacing: 0.2px;
    }

    .info-item .value {
        font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 500;
        letter-spacing: 0.1px;
    }

    .badge {
        font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    .stat-number {
        font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 900;
        letter-spacing: -1px;
    }

    .stat-label {
        font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 600;
        letter-spacing: 0.3px;
    }

    .exam-results-table th {
        font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 800;
        letter-spacing: 0.5px;
    }

    .exam-results-table td {
        font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 500;
        letter-spacing: 0.1px;
    }

    .records-table th {
        font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 800;
        letter-spacing: 0.5px;
    }

    .records-table td {
        font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 500;
        letter-spacing: 0.1px;
    }

    .score-badge,
    .evaluation-badge {
        font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    .percentage-text {
        font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 600;
        letter-spacing: 0.2px;
    }

    .stat-row .label,
    .stat-row .value {
        font-family: 'Cairo', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-weight: 500;
        letter-spacing: 0.1px;
    }

    /* Golden Text Styles */
    .golden-title {
        color: #FFD700 !important;
        text-shadow: 0 0 10px rgba(255, 215, 0, 0.5);
    }

    .golden-text {
        color: #FFD700 !important;
        font-weight: 600;
    }

    .text-danger {
        color: #ff6b6b !important;
    }

    .text-warning {
        color: #ffd93d !important;
    }

    .text-success {
        color: #6bcf7f !important;
    }
</style>

@push('scripts')
<script src="{{ asset('js/user-details.js') }}"></script>
@endpush
@endsection
