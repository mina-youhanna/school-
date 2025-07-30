@extends('layouts.app')

@section('title', 'خدام الفصل - ' . $class->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header Card -->
            <div class="card shadow mb-4">
                <div class="card-header bg-gradient-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                @if($class->saint_image)
                                    @if(filter_var($class->saint_image, FILTER_VALIDATE_URL))
                                        <img src="{{ $class->saint_image }}" 
                                             alt="صورة القديس" 
                                             class="rounded-circle"
                                             style="width: 60px; height: 60px; object-fit: cover;"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    @else
                                        @if(str_contains($class->saint_image, '/'))
                                            <img src="{{ asset($class->saint_image) }}" 
                                                 alt="صورة القديس" 
                                                 class="rounded-circle"
                                                 style="width: 60px; height: 60px; object-fit: cover;"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        @else
                                            <img src="{{ asset('images/' . $class->saint_image) }}" 
                                                 alt="صورة القديس" 
                                                 class="rounded-circle"
                                                 style="width: 60px; height: 60px; object-fit: cover;"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        @endif
                                    @endif
                                @endif
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                     style="width: 60px; height: 60px; {{ $class->saint_image ? 'display: none;' : '' }}">
                                    <i class="fas fa-image text-muted fa-2x"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="card-title mb-0">
                                    خدام {{ $class->name }}
                                </h3>
                                <small class="text-light">{{ $class->stage }} - النوع: {{ $class->gender }}</small>
                            </div>
                        </div>
                        <div class="btn-group">
                            <a href="{{ route('admin.classes.show', $class->id) }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>
                                رجوع
                            </a>
                            <a href="{{ route('admin.classes.students', $class->id) }}" class="btn btn-light btn-sm">
                                <i class="fas fa-user-graduate me-1"></i>
                                عرض الطلاب
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="mb-0">{{ count($servantsWithAttendance) }}</h4>
                                    <small>إجمالي الخدام</small>
                                </div>
                                <i class="fas fa-user-tie fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="mb-0">{{ count(array_filter($servantsWithAttendance, fn($s) => $s['status_color'] === 'success')) }}</h4>
                                    <small>حضور ممتاز</small>
                                </div>
                                <i class="fas fa-check-circle fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="mb-0">{{ count(array_filter($servantsWithAttendance, fn($s) => $s['status_color'] === 'warning')) }}</h4>
                                    <small>حضور متوسط</small>
                                </div>
                                <i class="fas fa-exclamation-triangle fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="mb-0">{{ count(array_filter($servantsWithAttendance, fn($s) => $s['status_color'] === 'danger')) }}</h4>
                                    <small>حضور ضعيف</small>
                                </div>
                                <i class="fas fa-times-circle fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Servants Table -->
            <div class="card shadow">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user-tie me-2"></i>
                        جدول الخدام مع إحصائيات الحضور
                    </h5>
                </div>
                <div class="card-body">
                    @if(count($servantsWithAttendance) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>الدور</th>
                                        <th>إجمالي السجلات</th>
                                        <th>أيام الحضور</th>
                                        <th>أيام الغياب</th>
                                        <th>نسبة الحضور</th>
                                        <th>الحالة</th>
                                        <th>الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($servantsWithAttendance as $index => $servantData)
                                        @php $servant = $servantData['servant']; @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($servant->profile_image)
                                                        <img src="{{ $servant->profile_image_url }}" 
                                                             class="rounded-circle me-2" 
                                                             width="32" 
                                                             height="32"
                                                             alt="{{ $servant->full_name }}">
                                                    @else
                                                        <div class="bg-secondary rounded-circle me-2 d-flex align-items-center justify-content-center" 
                                                             style="width: 32px; height: 32px;">
                                                            <i class="fas fa-user text-white"></i>
                                                        </div>
                                                    @endif
                                                    <span>{{ $servant->full_name }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $servant->email }}</td>
                                            <td>
                                                @if($servant->email === $class->main_servant_email)
                                                    <span class="badge bg-primary">رئيسي</span>
                                                @else
                                                    <span class="badge bg-secondary">مساعد</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $servantData['total_records'] }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-success">{{ $servantData['present_count'] }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-danger">{{ $servantData['absent_count'] }}</span>
                                            </td>
                                            <td>
                                                <div class="progress" style="height: 20px;">
                                                    <div class="progress-bar bg-{{ $servantData['status_color'] }}" 
                                                         role="progressbar" 
                                                         style="width: {{ $servantData['attendance_percentage'] }}%"
                                                         aria-valuenow="{{ $servantData['attendance_percentage'] }}" 
                                                         aria-valuemin="0" 
                                                         aria-valuemax="100">
                                                        {{ number_format($servantData['attendance_percentage'], 1) }}%
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($servantData['status_color'] === 'success')
                                                    <span class="badge bg-success">ممتاز</span>
                                                @elseif($servantData['status_color'] === 'warning')
                                                    <span class="badge bg-warning">متوسط</span>
                                                @else
                                                    <span class="badge bg-danger">ضعيف</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('admin.users.show', $servant->id) }}" 
                                                       class="btn btn-outline-primary" 
                                                       title="التفاصيل">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-user-tie fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">لا يوجد خدام مسجلين</h5>
                            <p class="text-muted">لم يتم تسجيل أي خدام في هذا الفصل بعد</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #0A2A4F 0%, #1a4a8a 100%);
}

.card {
    border: none;
    border-radius: 10px;
}

.table th {
    border-top: none;
    font-weight: 600;
}

.progress {
    border-radius: 10px;
}

.progress-bar {
    border-radius: 10px;
    font-size: 0.8rem;
    font-weight: 600;
}
</style>
@endsection 