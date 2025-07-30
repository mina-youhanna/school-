@extends('layouts.app')

@section('title', 'تفاصيل الفصل - ' . $class->name)

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
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        @if(str_contains($class->saint_image, '/'))
                                            <img src="{{ asset($class->saint_image) }}" 
                                                 alt="صورة القديس" 
                                                 class="rounded-circle"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('images/' . $class->saint_image) }}" 
                                                 alt="صورة القديس" 
                                                 class="rounded-circle"
                                                 style="width: 60px; height: 60px; object-fit: cover;">
                                        @endif
                                    @endif
                                @else
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                         style="width: 60px; height: 60px;">
                                        <i class="fas fa-image text-muted fa-2x"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h3 class="card-title mb-0">
                                    {{ $class->name }}
                                </h3>
                                <small class="text-light">{{ $class->stage }} - النوع: {{ $class->gender }}</small>
                            </div>
                        </div>
                        <div class="btn-group">
                            <a href="{{ route('admin.classes.edit', $class->id) }}" class="btn btn-light btn-sm">
                                <i class="fas fa-edit me-1"></i>
                                تعديل
                            </a>
                            <a href="{{ route('admin.attendance.show', $class->id) }}" class="btn btn-light btn-sm">
                                <i class="fas fa-clipboard-check me-1"></i>
                                الحضور
                            </a>
                            <a href="{{ route('admin.classes.students', $class->id) }}" class="btn btn-light btn-sm">
                                <i class="fas fa-user-graduate me-1"></i>
                                عرض الطلاب
                            </a>
                            <a href="{{ route('admin.classes.servants', $class->id) }}" class="btn btn-light btn-sm">
                                <i class="fas fa-user-tie me-1"></i>
                                عرض الخدام
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center">
                                <i class="fas fa-calendar-alt fa-2x text-primary mb-2"></i>
                                <h6>الجدول الزمني</h6>
                                <p class="text-muted">{{ $class->schedule }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <i class="fas fa-map-marker-alt fa-2x text-success mb-2"></i>
                                <h6>المكان</h6>
                                <p class="text-muted">{{ $class->place }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <i class="fas fa-users fa-2x text-info mb-2"></i>
                                <h6>عدد الطلاب</h6>
                                <p class="text-muted">{{ $students->count() }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <i class="fas fa-user-tie fa-2x text-warning mb-2"></i>
                                <h6>عدد الخدام</h6>
                                <p class="text-muted">{{ $allServants->count() }}</p>
                            </div>
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
                                    <h4 class="mb-0">{{ $attendanceStats->total_records ?? 0 }}</h4>
                                    <small>إجمالي سجلات الحضور</small>
                                </div>
                                <i class="fas fa-clipboard-list fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="mb-0">{{ $attendancePercentage ?? 0 }}%</h4>
                                    <small>نسبة الحضور</small>
                                </div>
                                <i class="fas fa-check-circle fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="mb-0">{{ $absencePercentage ?? 0 }}%</h4>
                                    <small>نسبة الغياب</small>
                                </div>
                                <i class="fas fa-times-circle fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4 class="mb-0">{{ $weeklyAttendanceUnique ?? 0 }}/{{ $students->count() }}</h4>
                                    <small>عدد الطلاب الذين حضروا أي نشاط هذا الأسبوع</small>
                                </div>
                                <i class="fas fa-calendar-week fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Weekly Attendance Details Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-calendar-week me-2"></i>
                                تفصيل الحضور هذا الأسبوع
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="text-center p-3">
                                        <i class="fas fa-pray fa-3x text-primary mb-2"></i>
                                        <h6>تسبحة</h6>
                                        <p class="text-muted attendance-number" data-attendance="{{ $weeklyTasbeha ?? 0 }}" data-total="{{ $students->count() }}">{{ $weeklyTasbeha ?? 0 }}/{{ $students->count() }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-3">
                                        <i class="fas fa-church fa-3x text-success mb-2"></i>
                                        <h6>قداس</h6>
                                        <p class="text-muted attendance-number" data-attendance="{{ $weeklyMass ?? 0 }}" data-total="{{ $students->count() }}">{{ $weeklyMass ?? 0 }}/{{ $students->count() }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-3">
                                        <i class="fas fa-book fa-3x text-info mb-2"></i>
                                        <h6>فصل</h6>
                                        <p class="text-muted attendance-number" data-attendance="{{ $weeklyClass ?? 0 }}" data-total="{{ $students->count() }}">{{ $weeklyClass ?? 0 }}/{{ $students->count() }}</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-3">
                                        <i class="fas fa-cross fa-3x text-warning mb-2"></i>
                                        <h6>تربية كنسية</h6>
                                        <p class="text-muted">{{ $weeklyEducation ?? 0 }}/{{ $students->count() }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Attendance Types Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-chart-pie me-2"></i>
                                نسب الحضور الإجمالية
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="text-center p-3">
                                        <i class="fas fa-pray fa-3x text-primary mb-2"></i>
                                        <h6>تسبحة</h6>
                                        <p class="percentage-number" data-percentage="{{ $tasbehaPercentage ?? 0 }}">{{ $tasbehaPercentage ?? 0 }}%</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-3">
                                        <i class="fas fa-church fa-3x text-success mb-2"></i>
                                        <h6>قداس</h6>
                                        <p class="percentage-number" data-percentage="{{ $massPercentage ?? 0 }}">{{ $massPercentage ?? 0 }}%</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-3">
                                        <i class="fas fa-book fa-3x text-info mb-2"></i>
                                        <h6>فصل</h6>
                                        <p class="percentage-number" data-percentage="{{ $classPercentage ?? 0 }}">{{ $classPercentage ?? 0 }}%</p>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="text-center p-3">
                                        <i class="fas fa-cross fa-3x text-warning mb-2"></i>
                                        <h6>تربية كنسية</h6>
                                        <p class="percentage-number" data-percentage="{{ $educationPercentage ?? 0 }}">{{ $educationPercentage ?? 0 }}%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Students Section -->
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-user-graduate me-2"></i>
                                الطلاب المسجلين ({{ $students->count() }})
                            </h5>
                        </div>
                        <div class="card-body">
                            @if($students->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>الاسم</th>
                                                <th>البريد الإلكتروني</th>
                                                <th>الهاتف</th>
                                                <th>النقاط</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($students as $index => $student)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            @if($student->profile_image)
                                                                <img src="{{ $student->profile_image_url }}" 
                                                                     class="rounded-circle me-2" 
                                                                     width="32" 
                                                                     height="32"
                                                                     alt="{{ $student->full_name }}">
                                                            @else
                                                                <div class="bg-secondary rounded-circle me-2 d-flex align-items-center justify-content-center" 
                                                                     style="width: 32px; height: 32px;">
                                                                    <i class="fas fa-user text-white"></i>
                                                                </div>
                                                            @endif
                                                            <span>{{ $student->full_name }}</span>
                                                        </div>
                                                    </td>
                                                    <td>{{ $student->email }}</td>
                                                    <td>{{ $student->phone ?? 'غير محدد' }}</td>
                                                    <td>
                                                        <span class="badge bg-primary">{{ $student->score ?? 0 }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="{{ route('admin.users.show', $student->id) }}" 
                                                               class="btn btn-outline-primary">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <button type="button" 
                                                                    class="btn btn-outline-danger"
                                                                    onclick="removeStudent({{ $student->id }})">
                                                                <i class="fas fa-user-minus"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-user-graduate fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">لا يوجد طلاب مسجلين</h5>
                                    <p class="text-muted">لم يتم تسجيل أي طلاب في هذا الفصل بعد</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Servants Section -->
                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-header bg-light">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-user-tie me-2"></i>
                                الخدام ({{ $allServants->count() }})
                            </h5>
                        </div>
                        <div class="card-body">
                            @if($allServants->count() > 0)
                                <div class="list-group list-group-flush">
                                    @foreach($allServants as $servant)
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="mb-1">{{ $servant->full_name }}</h6>
                                                <small class="text-muted">{{ $servant->email }}</small>
                                            </div>
                                            @if($servant->email === $class->main_servant_email)
                                                <span class="badge bg-primary">رئيسي</span>
                                            @else
                                                <span class="badge bg-secondary">مساعد</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-3">
                                    <i class="fas fa-user-tie fa-2x text-muted mb-2"></i>
                                    <p class="text-muted">لا يوجد خدام مسجلين</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Remove Student Modal -->
<div class="modal fade" id="removeStudentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إزالة الطالب من الفصل</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>هل أنت متأكد من إزالة هذا الطالب من الفصل؟</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <form id="removeStudentForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">إزالة</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.card {
    border: none;
    border-radius: 10px;
}

.table th {
    border-top: none;
    font-weight: 600;
}

.list-group-item {
    border: none;
    border-bottom: 1px solid #e9ecef;
}

.list-group-item:last-child {
    border-bottom: none;
}

/* ألوان النسب المئوية */
.percentage-number {
    font-weight: bold;
    font-size: 1.2rem;
}

.percentage-number.low {
    color: #dc3545 !important; /* أحمر */
}

.percentage-number.medium {
    color: #ffc107 !important; /* أصفر */
}

.percentage-number.high {
    color: #198754 !important; /* أخضر */
}

/* ألوان الحضور الأسبوعي */
.attendance-number {
    font-weight: bold;
    font-size: 1.2rem;
}

.attendance-number.low {
    color: #dc3545 !important; /* أحمر */
}

.attendance-number.medium {
    color: #ffc107 !important; /* أصفر */
}

.attendance-number.high {
    color: #198754 !important; /* أخضر */
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // تطبيق الألوان على النسب المئوية
    document.querySelectorAll('.percentage-number').forEach(function(element) {
        const percentage = parseInt(element.getAttribute('data-percentage'));
        element.classList.remove('low', 'medium', 'high');
        
        if (percentage < 40) {
            element.classList.add('low');
        } else if (percentage >= 40 && percentage <= 70) {
            element.classList.add('medium');
        } else {
            element.classList.add('high');
        }
    });
    
    // تطبيق الألوان على الحضور الأسبوعي
    document.querySelectorAll('.attendance-number').forEach(function(element) {
        const attendance = parseInt(element.getAttribute('data-attendance'));
        const total = parseInt(element.getAttribute('data-total'));
        
        if (total > 0) {
            const percentage = (attendance / total) * 100;
            element.classList.remove('low', 'medium', 'high');
            
            if (percentage < 40) {
                element.classList.add('low');
            } else if (percentage >= 40 && percentage <= 70) {
                element.classList.add('medium');
            } else {
                element.classList.add('high');
            }
        }
    });
});
</script>

<script>
function removeStudent(studentId) {
    if (confirm('هل أنت متأكد من إزالة هذا الطالب من الفصل؟')) {
        fetch(`/admin/classes/{{ $class->id }}/students/${studentId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('حدث خطأ أثناء إزالة الطالب');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ أثناء إزالة الطالب');
        });
    }
}
</script>
@endsection 