@extends('layouts.app')

@section('title', 'لوحة القيادة')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-gray-800">
                        <i class="fas fa-tachometer-alt me-2 text-primary"></i>
                        لوحة القيادة
                    </h1>
                    <p class="text-muted">نظرة عامة على أداء النظام والإحصائيات</p>
                </div>
                <div class="text-end">
                    <div class="text-muted small">آخر تحديث</div>
                    <div class="fw-bold">{{ now()->format('Y-m-d H:i') }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- الإحصائيات الأساسية -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                إجمالي المستخدمين
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $stats['total_users'] }}</div>
                            <div class="text-xs text-success">
                                <i class="fas fa-arrow-up"></i> +{{ $advancedStats['new_users_this_month'] }} هذا الشهر
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                نسبة الحضور
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $advancedStats['attendance_rate'] }}%</div>
                            <div class="text-xs text-muted">
                                من إجمالي {{ $stats['total_attendance'] }} تسجيل
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                متوسط الدرجات
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $advancedStats['exam_performance']['average_score'] }}%</div>
                            <div class="text-xs text-muted">
                                نسبة النجاح: {{ $advancedStats['exam_performance']['passing_rate'] }}%
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                توزيع الجنس
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                {{ $advancedStats['gender_distribution']['males'] }}% ذكور
                            </div>
                            <div class="text-xs text-muted">
                                {{ $advancedStats['gender_distribution']['females'] }}% إناث
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-venus-mars fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- الرسوم البيانية والإحصائيات -->
    <div class="row mb-4">
        <!-- نمو المستخدمين الشهري -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">نمو المستخدمين الشهري</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="monthlyGrowthChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- توزيع الأعمار -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">توزيع الأعمار</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="ageDistributionChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> أطفال (0-12)
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> مراهقين (13-19)
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> شباب (20-30)
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> بالغين (30+)
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- أفضل الفصول والأنشطة الأخيرة -->
    <div class="row mb-4">
        <!-- أفضل الفصول أداءً -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">أفضل الفصول أداءً</h6>
                </div>
                <div class="card-body">
                    @forelse($advancedStats['top_performing_classes'] as $class)
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            <div class="avatar-sm rounded-circle bg-primary d-flex align-items-center justify-content-center">
                                <i class="fas fa-graduation-cap text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">{{ $class->name }}</h6>
                            <small class="text-muted">{{ $class->stage }}</small>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold text-primary">{{ $class->students_count }}</div>
                            <small class="text-muted">طالب</small>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-muted py-3">
                        <i class="fas fa-chalkboard-teacher fa-2x mb-2"></i>
                        <p>لا توجد فصول دراسية</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- الأنشطة الأخيرة -->
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">الأنشطة الأخيرة</h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        @forelse($advancedStats['recent_activities'] as $activity)
                        <div class="timeline-item">
                            <div class="timeline-marker bg-{{ $activity['color'] }}"></div>
                            <div class="timeline-content">
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-1">{{ $activity['title'] }}</h6>
                                    <small class="text-muted">{{ $activity['time'] }}</small>
                                </div>
                                <p class="mb-0 text-muted">{{ $activity['description'] }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center text-muted py-3">
                            <i class="fas fa-clock fa-2x mb-2"></i>
                            <p>لا توجد أنشطة حديثة</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- إجراءات سريعة -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">إجراءات سريعة</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.users') }}" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-users me-2"></i>
                                إدارة المستخدمين
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.classes.index') }}" class="btn btn-success btn-lg w-100">
                                <i class="fas fa-chalkboard-teacher me-2"></i>
                                إدارة الفصول
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.attendance') }}" class="btn btn-warning btn-lg w-100">
                                <i class="fas fa-calendar-check me-2"></i>
                                إدارة الحضور
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('admin.exams.index') }}" class="btn btn-info btn-lg w-100">
                                <i class="fas fa-file-alt me-2"></i>
                                إدارة الامتحانات
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}

.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.chart-area {
    position: relative;
    height: 20rem;
    width: 100%;
}

.chart-pie {
    position: relative;
    height: 15rem;
}

.avatar-sm {
    width: 40px;
    height: 40px;
}

.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -35px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.timeline-content {
    background: #f8f9fc;
    padding: 15px;
    border-radius: 8px;
    border-left: 3px solid #4e73df;
}

.card {
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
}

.btn-lg {
    padding: 15px 30px;
    font-size: 16px;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.btn-lg:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// نمو المستخدمين الشهري
const monthlyData = @json($advancedStats['monthly_growth']);
const ctx1 = document.getElementById('monthlyGrowthChart').getContext('2d');
new Chart(ctx1, {
    type: 'line',
    data: {
        labels: monthlyData.map(item => item.month),
        datasets: [{
            label: 'المستخدمين الجدد',
            data: monthlyData.map(item => item.count),
            borderColor: '#4e73df',
            backgroundColor: 'rgba(78, 115, 223, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// توزيع الأعمار
const ageData = @json($advancedStats['age_distribution']);
const ctx2 = document.getElementById('ageDistributionChart').getContext('2d');
new Chart(ctx2, {
    type: 'doughnut',
    data: {
        labels: ['أطفال (0-12)', 'مراهقين (13-19)', 'شباب (20-30)', 'بالغين (30+)'],
        datasets: [{
            data: [ageData.children, ageData.teens, ageData.young_adults, ageData.adults],
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});
</script>
@endsection 