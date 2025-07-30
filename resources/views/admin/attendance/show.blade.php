@extends('layouts.app')

@section('title', 'إدارة الحضور - ' . $class->name)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header Card -->
            <div class="card shadow mb-4">
                <div class="card-header bg-gradient-info text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h3 class="card-title mb-0">
                                <i class="fas fa-clipboard-check me-2"></i>
                                إدارة الحضور والغياب
                            </h3>
                            <small class="text-light">{{ $class->name }} - {{ $class->stage }}</small>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-light btn-sm" onclick="markAllPresent()">
                                <i class="fas fa-check-double me-1"></i>
                                حضور الجميع
                            </button>
                            <button type="button" class="btn btn-light btn-sm" onclick="markAllAbsent()">
                                <i class="fas fa-times-double me-1"></i>
                                غياب الجميع
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="attendance_date" class="form-label">
                                    <i class="fas fa-calendar me-1"></i>
                                    تاريخ الحضور
                                </label>
                                <input type="date" 
                                       class="form-control" 
                                       id="attendance_date" 
                                       value="{{ date('Y-m-d') }}"
                                       onchange="loadAttendance()">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">
                                    <i class="fas fa-info-circle me-1"></i>
                                    إحصائيات سريعة
                                </label>
                                <div class="d-flex gap-3">
                                    <div class="text-center">
                                        <h5 class="text-success mb-0" id="present_count">0</h5>
                                        <small class="text-muted">حاضر</small>
                                    </div>
                                    <div class="text-center">
                                        <h5 class="text-danger mb-0" id="absent_count">0</h5>
                                        <small class="text-muted">غائب</small>
                                    </div>
                                    <div class="text-center">
                                        <h5 class="text-warning mb-0" id="late_count">0</h5>
                                        <small class="text-muted">متأخر</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Students Attendance Table -->
            <div class="card shadow">
                <div class="card-header bg-light">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-users me-2"></i>
                        قائمة الطلاب ({{ $students->count() }})
                    </h5>
                </div>
                <div class="card-body">
                    @if($students->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th width="50">#</th>
                                        <th>الطالب</th>
                                        <th>البريد الإلكتروني</th>
                                        <th>الهاتف</th>
                                        <th width="200">الحالة</th>
                                        <th width="80">تسبحة</th>
                                        <th width="80">قداس</th>
                                        <th width="80">فصل</th>
                                        <th width="80">تربية كنسية</th>
                                        <th width="150">الإجراءات</th>
                                    </tr>
                                </thead>
                                <tbody id="students_table">
                                    @foreach($students as $index => $student)
                                        <tr data-student-id="{{ $student->id }}">
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
                                                <div class="btn-group btn-group-sm w-100" role="group">
                                                    <input type="radio" 
                                                           class="btn-check" 
                                                           name="attendance_{{ $student->id }}" 
                                                           id="present_{{ $student->id }}" 
                                                           value="present" 
                                                           autocomplete="off">
                                                    <label class="btn btn-outline-success" for="present_{{ $student->id }}">
                                                        <i class="fas fa-check me-1"></i>
                                                        حاضر
                                                    </label>

                                                    <input type="radio" 
                                                           class="btn-check" 
                                                           name="attendance_{{ $student->id }}" 
                                                           id="absent_{{ $student->id }}" 
                                                           value="absent" 
                                                           autocomplete="off">
                                                    <label class="btn btn-outline-danger" for="absent_{{ $student->id }}">
                                                        <i class="fas fa-times me-1"></i>
                                                        غائب
                                                    </label>

                                                    <input type="radio" 
                                                           class="btn-check" 
                                                           name="attendance_{{ $student->id }}" 
                                                           id="late_{{ $student->id }}" 
                                                           value="late" 
                                                           autocomplete="off">
                                                    <label class="btn btn-outline-warning" for="late_{{ $student->id }}">
                                                        <i class="fas fa-clock me-1"></i>
                                                        متأخر
                                                    </label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" 
                                                           id="tasbeha_{{ $student->id }}" 
                                                           name="tasbeha_{{ $student->id }}" 
                                                           value="1">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" 
                                                           id="mass_{{ $student->id }}" 
                                                           name="mass_{{ $student->id }}" 
                                                           value="1">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" 
                                                           id="class_attendance_{{ $student->id }}" 
                                                           name="class_attendance_{{ $student->id }}" 
                                                           value="1">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check d-flex justify-content-center">
                                                    <input class="form-check-input" type="checkbox" 
                                                           id="church_education_{{ $student->id }}" 
                                                           name="church_education_{{ $student->id }}" 
                                                           value="1">
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" 
                                                        class="btn btn-outline-primary btn-sm"
                                                        onclick="addNotes({{ $student->id }})">
                                                    <i class="fas fa-sticky-note me-1"></i>
                                                    ملاحظات
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.classes.show', $class->id) }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>
                                رجوع للفصل
                            </a>
                            <button type="button" class="btn btn-primary" onclick="saveAttendance()">
                                <i class="fas fa-save me-1"></i>
                                حفظ الحضور
                            </button>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-user-graduate fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">لا يوجد طلاب مسجلين</h5>
                            <p class="text-muted">لم يتم تسجيل أي طلاب في هذا الفصل بعد</p>
                            <a href="{{ route('admin.classes.show', $class->id) }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left me-1"></i>
                                رجوع للفصل
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Notes Modal -->
<div class="modal fade" id="notesModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">إضافة ملاحظات</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="notes_text" class="form-label">الملاحظات</label>
                    <textarea class="form-control" id="notes_text" rows="3" placeholder="اكتب ملاحظاتك هنا..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-primary" onclick="saveNotes()">حفظ الملاحظات</button>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-info {
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

.btn-check:checked + .btn-outline-success {
    background-color: #198754;
    border-color: #198754;
    color: white;
}

.btn-check:checked + .btn-outline-danger {
    background-color: #dc3545;
    border-color: #dc3545;
    color: white;
}

.btn-check:checked + .btn-outline-warning {
    background-color: #ffc107;
    border-color: #ffc107;
    color: white;
}
</style>

<script>
let currentStudentId = null;
let notesModal = null;

document.addEventListener('DOMContentLoaded', function() {
    notesModal = new bootstrap.Modal(document.getElementById('notesModal'));
    loadAttendance();
});

function loadAttendance() {
    const date = document.getElementById('attendance_date').value;
    const classId = {{ $class->id }};
    
    fetch(`/admin/attendance/${classId}/load?date=${date}`)
        .then(response => response.json())
        .then(data => {
            // تحديث حالة الحضور لكل طالب
            data.attendance.forEach(record => {
                const radio = document.querySelector(`input[name="attendance_${record.student_id}"][value="${record.status}"]`);
                if (radio) {
                    radio.checked = true;
                }
                
                // تحديث الحقول الجديدة
                if (record.tasbeha) {
                    document.querySelector(`input[name="tasbeha_${record.student_id}"]`).checked = true;
                }
                if (record.mass) {
                    document.querySelector(`input[name="mass_${record.student_id}"]`).checked = true;
                }
                if (record.class_attendance) {
                    document.querySelector(`input[name="class_attendance_${record.student_id}"]`).checked = true;
                }
                if (record.church_education) {
                    document.querySelector(`input[name="church_education_${record.student_id}"]`).checked = true;
                }
            });
            
            updateStatistics();
        })
        .catch(error => {
            console.error('Error loading attendance:', error);
        });
}

function markAllPresent() {
    document.querySelectorAll('input[value="present"]').forEach(radio => {
        radio.checked = true;
    });
    updateStatistics();
}

function markAllAbsent() {
    document.querySelectorAll('input[value="absent"]').forEach(radio => {
        radio.checked = true;
    });
    updateStatistics();
}

function updateStatistics() {
    const presentCount = document.querySelectorAll('input[value="present"]:checked').length;
    const absentCount = document.querySelectorAll('input[value="absent"]:checked').length;
    const lateCount = document.querySelectorAll('input[value="late"]:checked').length;
    
    document.getElementById('present_count').textContent = presentCount;
    document.getElementById('absent_count').textContent = absentCount;
    document.getElementById('late_count').textContent = lateCount;
}

function addNotes(studentId) {
    currentStudentId = studentId;
    document.getElementById('notes_text').value = '';
    notesModal.show();
}

function saveNotes() {
    const notes = document.getElementById('notes_text').value;
    // يمكن حفظ الملاحظات في متغير أو إرسالها مع الحضور
    notesModal.hide();
}

function saveAttendance() {
    const date = document.getElementById('attendance_date').value;
    const classId = {{ $class->id }};
    const attendanceData = [];
    
    document.querySelectorAll('#students_table tr').forEach(row => {
        const studentId = row.dataset.studentId;
        const status = document.querySelector(`input[name="attendance_${studentId}"]:checked`)?.value;
        
        if (status) {
            const tasbeha = document.querySelector(`input[name="tasbeha_${studentId}"]`)?.checked || false;
            const mass = document.querySelector(`input[name="mass_${studentId}"]`)?.checked || false;
            const classAttendance = document.querySelector(`input[name="class_attendance_${studentId}"]`)?.checked || false;
            const churchEducation = document.querySelector(`input[name="church_education_${studentId}"]`)?.checked || false;
            
            attendanceData.push({
                student_id: studentId,
                status: status,
                date: date,
                tasbeha: tasbeha,
                mass: mass,
                class_attendance: classAttendance,
                church_education: churchEducation
            });
        }
    });
    
    fetch('/admin/attendance', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            class_id: classId,
            attendance: attendanceData
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('تم حفظ الحضور بنجاح');
        } else {
            alert('حدث خطأ أثناء حفظ الحضور');
        }
    })
    .catch(error => {
        console.error('Error saving attendance:', error);
        alert('حدث خطأ أثناء حفظ الحضور');
    });
}

// تحديث الإحصائيات عند تغيير الحضور
document.addEventListener('change', function(e) {
    if (e.target.name && e.target.name.startsWith('attendance_')) {
        updateStatistics();
    }
});
</script>

<style>
.bg-gradient-info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
}

.card {
    border: none;
    border-radius: 10px;
}

.table th {
    border-top: none;
    font-weight: 600;
    text-align: center;
}

.table td {
    vertical-align: middle;
}

.btn-group .btn {
    border-radius: 0;
}

.btn-group .btn:first-child {
    border-top-left-radius: 0.375rem;
    border-bottom-left-radius: 0.375rem;
}

.btn-group .btn:last-child {
    border-top-right-radius: 0.375rem;
    border-bottom-right-radius: 0.375rem;
}

.form-check-input {
    cursor: pointer;
}

.form-check-input:checked {
    background-color: #198754;
    border-color: #198754;
}
</style>
@endsection 