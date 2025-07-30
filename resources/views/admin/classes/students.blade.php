@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        @if($class->saint_image)
                            @if(filter_var($class->saint_image, FILTER_VALIDATE_URL))
                                <img src="{{ $class->saint_image }}" 
                                     alt="صورة القديس" 
                                     class="rounded-circle me-3"
                                     style="width: 60px; height: 60px; object-fit: cover;">
                            @else
                                @if(str_contains($class->saint_image, '/'))
                                    <img src="{{ asset($class->saint_image) }}" 
                                         alt="صورة القديس" 
                                         class="rounded-circle me-3"
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('images/' . $class->saint_image) }}" 
                                         alt="صورة القديس" 
                                         class="rounded-circle me-3"
                                         style="width: 60px; height: 60px; object-fit: cover;">
                                @endif
                            @endif
                        @else
                            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3"
                                 style="width: 60px; height: 60px;">
                                <i class="fas fa-image text-muted fa-2x"></i>
                            </div>
                        @endif
                        <div>
                            <h3 class="mb-1">طلاب {{ $class->name }}</h3>
                            <p class="mb-0 opacity-75">{{ $class->description ?? 'فصل دراسي' }}</p>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('admin.classes.show', $class->id) }}" class="btn btn-light">
                            <i class="fas fa-arrow-left me-2"></i>
                            رجوع للفصل
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Students Table -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-users me-2"></i>
                        جدول الطلاب مع إحصائيات الحضور ({{ $students->count() }})
                    </h5>
                </div>
                <div class="card-body">
                    @if($students->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-dark">
                                    <tr>
                                        <th width="50">#</th>
                                        <th width="80">الصورة</th>
                                        <th>اسم الطالب</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>الهاتف</th>
                                        <th width="100">تسبحة</th>
                                        <th width="100">قداس</th>
                                        <th width="100">فصل</th>
                                        <th width="100">تربية كنسية</th>
                                        <th width="120">إجمالي الحضور</th>
                                        <th width="100">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($students as $index => $student)
                                        @php
                                            // حساب إحصائيات الحضور للطالب
                                            $studentAttendance = $attendanceStats->where('student_id', $student->id)->first();
                                            
                                            $tasbehaCount = $studentAttendance ? $studentAttendance->tasbeha_count : 0;
                                            $massCount = $studentAttendance ? $studentAttendance->mass_count : 0;
                                            $classCount = $studentAttendance ? $studentAttendance->class_count : 0;
                                            $educationCount = $studentAttendance ? $studentAttendance->education_count : 0;
                                            
                                            $totalRecords = $studentAttendance ? $studentAttendance->total_records : 0;
                                            
                                            $tasbehaPercentage = $totalRecords > 0 ? round(($tasbehaCount / $totalRecords) * 100) : 0;
                                            $massPercentage = $totalRecords > 0 ? round(($massCount / $totalRecords) * 100) : 0;
                                            $classPercentage = $totalRecords > 0 ? round(($classCount / $totalRecords) * 100) : 0;
                                            $educationPercentage = $totalRecords > 0 ? round(($educationCount / $totalRecords) * 100) : 0;
                                            
                                            $totalAttendance = $tasbehaCount + $massCount + $classCount + $educationCount;
                                            $totalPercentage = $totalRecords > 0 ? round(($totalAttendance / ($totalRecords * 4)) * 100) : 0;
                                        @endphp
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                @if($student->profile_picture)
                                                    <img src="{{ asset('storage/' . $student->profile_picture) }}" 
                                                         alt="صورة الطالب" 
                                                         class="rounded-circle"
                                                         style="width: 40px; height: 40px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                                         style="width: 40px; height: 40px;">
                                                        <i class="fas fa-user text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <strong>{{ $student->name }}</strong>
                                                @if($student->is_main_servant)
                                                    <span class="badge bg-primary ms-2">خادم أساسي</span>
                                                @endif
                                            </td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->phone ?? 'غير محدد' }}</td>
                                            <td>
                                                <span class="attendance-percentage" data-percentage="{{ $tasbehaPercentage }}">
                                                    {{ $tasbehaPercentage }}%
                                                </span>
                                            </td>
                                            <td>
                                                <span class="attendance-percentage" data-percentage="{{ $massPercentage }}">
                                                    {{ $massPercentage }}%
                                                </span>
                                            </td>
                                            <td>
                                                <span class="attendance-percentage" data-percentage="{{ $classPercentage }}">
                                                    {{ $classPercentage }}%
                                                </span>
                                            </td>
                                            <td>
                                                <span class="attendance-percentage" data-percentage="{{ $educationPercentage }}">
                                                    {{ $educationPercentage }}%
                                                </span>
                                            </td>
                                            <td>
                                                <span class="attendance-percentage" data-percentage="{{ $totalPercentage }}">
                                                    {{ $totalPercentage }}%
                                                </span>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                                            onclick="showStudentDetails({{ $student->id }})"
                                                            title="عرض التفاصيل">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-success" 
                                                            onclick="contactStudent({{ $student->id }})"
                                                            title="تواصل مع الطالب">
                                                        <i class="fas fa-phone"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-info" 
                                                            onclick="viewAttendanceHistory({{ $student->id }})"
                                                            title="سجل الحضور">
                                                        <i class="fas fa-calendar-alt"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-users fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">لا يوجد طلاب مسجلين</h5>
                            <p class="text-muted">لم يتم تسجيل أي طلاب في هذا الفصل بعد</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Student Details Modal -->
<div class="modal fade" id="studentDetailsModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تفاصيل الطالب</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="studentDetailsContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Contact Student Modal -->
<div class="modal fade" id="contactStudentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تواصل مع الطالب</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="contactStudentContent">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<style>
.attendance-percentage {
    font-weight: bold;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.9rem;
}

.attendance-percentage.low {
    background-color: #f8d7da;
    color: #721c24;
}

.attendance-percentage.medium {
    background-color: #fff3cd;
    color: #856404;
}

.attendance-percentage.high {
    background-color: #d1edff;
    color: #0c5460;
}

.table th {
    font-weight: 600;
    text-align: center;
}

.table td {
    vertical-align: middle;
    text-align: center;
}

.btn-group .btn {
    margin: 0 1px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // تطبيق الألوان على نسب الحضور
    document.querySelectorAll('.attendance-percentage').forEach(function(element) {
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
});

function showStudentDetails(studentId) {
    // يمكن إضافة AJAX هنا لتحميل تفاصيل الطالب
    const modal = new bootstrap.Modal(document.getElementById('studentDetailsModal'));
    document.getElementById('studentDetailsContent').innerHTML = `
        <div class="text-center">
            <i class="fas fa-spinner fa-spin fa-2x"></i>
            <p>جاري تحميل تفاصيل الطالب...</p>
        </div>
    `;
    modal.show();
}

function contactStudent(studentId) {
    const modal = new bootstrap.Modal(document.getElementById('contactStudentModal'));
    document.getElementById('contactStudentContent').innerHTML = `
        <div class="text-center">
            <i class="fas fa-phone fa-3x text-primary mb-3"></i>
            <h5>خيارات التواصل</h5>
            <div class="d-grid gap-2">
                <button class="btn btn-primary" onclick="callStudent(${studentId})">
                    <i class="fas fa-phone me-2"></i>
                    اتصال هاتفي
                </button>
                <button class="btn btn-success" onclick="whatsappStudent(${studentId})">
                    <i class="fab fa-whatsapp me-2"></i>
                    واتساب
                </button>
                <button class="btn btn-info" onclick="emailStudent(${studentId})">
                    <i class="fas fa-envelope me-2"></i>
                    بريد إلكتروني
                </button>
            </div>
        </div>
    `;
    modal.show();
}

function viewAttendanceHistory(studentId) {
    // يمكن إضافة AJAX هنا لعرض سجل الحضور
    alert('سيتم إضافة ميزة عرض سجل الحضور قريباً');
}

function callStudent(studentId) {
    // يمكن إضافة منطق الاتصال هنا
    alert('سيتم إضافة ميزة الاتصال قريباً');
}

function whatsappStudent(studentId) {
    // يمكن إضافة منطق الواتساب هنا
    alert('سيتم إضافة ميزة الواتساب قريباً');
}

function emailStudent(studentId) {
    // يمكن إضافة منطق البريد الإلكتروني هنا
    alert('سيتم إضافة ميزة البريد الإلكتروني قريباً');
}
</script>
@endsection 