@extends('layouts.app')

@section('title', 'إدارة الفصول')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
<style>
.dropdown-menu {
    background-color: #0A2A4F !important;
    border: 1px solid #FFD700 !important;
    text-align: right !important;
}

body {
    margin: 0;
    padding: 0;
    background-color: #0A2A4F;
    background-size: 300px;
    background-repeat: repeat;
    background-blend-mode: multiply;
    font-family: 'Tajawal', sans-serif;
    direction: rtl;
    color: #ffffff;
}

body::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: -1;
}

/* تحسين العنوان الرئيسي */
.main-title {
    font-size: 44px;
    font-weight: bold;
    color: #0A2A4F;
    margin: 40px auto 60px;
    padding: 20px 40px;
    border-bottom: 4px solid #FFD700;
    display: block;
    background: rgba(255, 215, 0, 0.2);
    border-radius: 15px;
    box-shadow: 0px 0px 20px rgba(255, 215, 0, 0.6);
    text-align: center;
    width: fit-content;
    position: relative;
    margin-left: auto;
    margin-right: auto;
}

.main-title::before {
    content: '';
    position: absolute;
    top: -10px;
    left: -10px;
    right: -10px;
    bottom: -10px;
    background: linear-gradient(45deg, #FFD700, #FFED4A, #FFD700);
    border-radius: 20px;
    z-index: -1;
    opacity: 0.3;
}

/* تحسين زر إضافة فصل جديد */
.add-class-btn {
    background: linear-gradient(45deg, #FFD700, #FFED4A);
    border: none;
    color: #0A2A4F;
    font-weight: bold;
    padding: 12px 30px;
    border-radius: 25px;
    font-size: 18px;
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
    transition: all 0.3s ease;
    margin: 20px auto;
    display: inline-block;
}

.add-class-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 215, 0, 0.6);
    background: linear-gradient(45deg, #FFED4A, #FFD700);
    color: #0A2A4F;
}

.container {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
    margin-top: 40px;
}

.card {
    width: 340px;
    height: 670px; 
    background: rgba(20, 50, 90, 0.95);
    border: 3px solid #FFD700;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
    transition: transform 0.3s, box-shadow 0.3s;
    padding-bottom: 15px;
    position: relative;
    display: flex;
    flex-direction: column;
}

.card:hover {
    transform: scale(1.05);
    box-shadow: 0 0 30px 5px #FFD700, 0 0 15px 5px #FFD700;
}

.image-container {
    width: 200px;
    height: 270px;
    margin: 20px auto 10px;
    border-radius: 50%;
    overflow: hidden;
    border: 5px solid #FFD700;
    transition: transform 0.3s;
    position: relative;
    user-select: none;
    flex-shrink: 0;
}

.image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s;
    pointer-events: none;
}

.image-container:hover img {
    transform: scale(1.1);
}

.card-body {
    flex: 1;
    display: flex;
    flex-direction: column;
    padding: 15px;
}

.card-title {
    font-size: 22px;
    font-weight: bold;
    color: #FFD700;
    text-shadow: 0px 0px 8px rgba(255, 215, 0, 0.8);
    margin-bottom: 15px;
    line-height: 1.3;
    text-align: center;
}

.card-text {
    color: #f0f0f0;
    font-size: 16px;
    line-height: 1.6;
    flex: 1;
    text-align: center;
}

.card-text strong {
    color: #FFD700;
}

.btn-group {
    margin-top: auto;
    display: flex;
    flex-direction: row;
    gap: 5px;
    flex-wrap: wrap;
    justify-content: center;
}

.btn-group .btn {
    margin: 2px;
    border-radius: 8px;
    padding: 8px 10px;
    font-size: 12px;
    flex: 1;
    min-width: 80px;
}

.btn-outline-primary {
    color: #FFD700;
    border-color: #FFD700;
}

.btn-outline-primary:hover {
    background-color: #FFD700;
    color: #0A2A4F;
}

.btn-outline-warning {
    color: #FFD700;
    border-color: #FFD700;
}

.btn-outline-warning:hover {
    background-color: #FFD700;
    color: #0A2A4F;
}

.btn-outline-info {
    color: #FFD700;
    border-color: #FFD700;
}

.btn-outline-info:hover {
    background-color: #FFD700;
    color: #0A2A4F;
}

.btn-outline-success {
    color: #FFD700;
    border-color: #FFD700;
}

.btn-outline-success:hover {
    background-color: #FFD700;
    color: #0A2A4F;
}

.btn-outline-secondary {
    color: #FFD700;
    border-color: #FFD700;
}

.btn-outline-secondary:hover {
    background-color: #FFD700;
    color: #0A2A4F;
}

.btn-primary {
    background-color: #FFD700;
    border-color: #FFD700;
    color: #0A2A4F;
}

.btn-primary:hover {
    background-color: #FFED4A;
    border-color: #FFED4A;
    color: #0A2A4F;
}

.alert {
    background-color: rgba(20, 50, 90, 0.95);
    border: 2px solid #FFD700;
    color: #ffffff;
}

.alert-success {
    border-color: #28a745;
}

.alert-danger {
    border-color: #dc3545;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #f0f0f0;
}

.empty-state i {
    font-size: 4rem;
    color: #FFD700;
    margin-bottom: 20px;
}

.empty-state h4 {
    font-size: 1.5rem;
    margin-bottom: 10px;
    color: #FFD700;
}

.empty-state p {
    color: #f0f0f0;
}

/* تحسين قسم البحث والفلترة */
.search-filter-section {
    background: rgba(20, 50, 90, 0.95);
    border: 2px solid #FFD700;
    border-radius: 15px;
    padding: 25px;
    margin: 30px auto;
    max-width: 800px;
    box-shadow: 0 0 20px rgba(255, 215, 0, 0.3);
}

.search-filter-section h4 {
    color: #FFD700;
    margin-bottom: 25px;
    font-size: 26px;
    text-align: center;
    text-shadow: 0px 0px 10px rgba(255, 215, 0, 0.5);
}

.form-control, .form-select {
    background-color: rgba(255, 255, 255, 0.1);
    border: 2px solid #FFD700;
    color: #ffffff;
    border-radius: 10px;
    padding: 12px 15px;
    font-size: 16px;
}

.form-control:focus, .form-select:focus {
    background-color: rgba(255, 255, 255, 0.2);
    border-color: #FFED4A;
    color: #ffffff;
    box-shadow: 0 0 0 0.2rem rgba(255, 215, 0, 0.25);
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

.form-select option {
    background-color: #0A2A4F;
    color: #ffffff;
}

/* Modal Styles */
.modal-content {
    background-color: rgba(20, 50, 90, 0.95);
    border: 2px solid #FFD700;
    color: #ffffff;
}

.modal-header {
    border-bottom: 1px solid #FFD700;
}

.modal-footer {
    border-top: 1px solid #FFD700;
}

.modal-title {
    color: #FFD700;
}

.table {
    color: #ffffff;
}

.table th {
    color: #FFD700;
    border-color: #FFD700;
}

.table td {
    border-color: rgba(255, 215, 0, 0.3);
}

/* تحسين التخطيط العام */
.page-header {
    text-align: center;
    margin-bottom: 40px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.page-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
    text-align: center;
}
</style>

<div class="page-content">
    <!-- العنوان الرئيسي في المنتصف -->
    <div class="page-header">
        <h1 class="main-title">إدارة الفصول الدراسية</h1>
        
        <a href="{{ route('admin.classes.create') }}" class="add-class-btn">
            <i class="fas fa-plus me-2"></i>
            إضافة فصل جديد
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- قسم البحث والفلترة -->
    <div class="search-filter-section">
        <h4><i class="fas fa-search me-2"></i>البحث والفلترة</h4>
        <div class="row">
            <div class="col-md-4 mb-3">
                <input type="text" id="searchInput" class="form-control" placeholder="ابحث باسم الفصل...">
            </div>
            <div class="col-md-4 mb-3">
                <select id="genderFilter" class="form-select">
                    <option value="">جميع الأنواع</option>
                    <option value="ذكر">ذكر</option>
                    <option value="أنثى">أنثى</option>
                    <option value="مختلط">مختلط</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <select id="stageFilter" class="form-select">
                    <option value="">جميع المراحل</option>
                    <option value="A1">A1</option>
                    <option value="A2">A2</option>
                    <option value="A3">A3</option>
                    <option value="B1">B1</option>
                    <option value="B2">B2</option>
                    <option value="B3">B3</option>
                    <option value="C1">C1</option>
                    <option value="تمهيدي1">تمهيدي 1</option>
                    <option value="تمهيدي2">تمهيدي 2</option>
                    <option value="خاص">خاص</option>
                    <option value="الخدام">الخدام</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row justify-content-center" id="classesContainer">
        @forelse($classes as $class)
            <div class="col-md-6 col-lg-4 mb-4 class-card" 
                 data-name="{{ strtolower($class->name) }}"
                 data-gender="{{ $class->gender }}"
                 data-stage="{{ $class->stage }}">
                <div class="card">
                    <div class="image-container">
                        @if($class->saint_image)
                            @if(filter_var($class->saint_image, FILTER_VALIDATE_URL))
                                <img src="{{ $class->saint_image }}" alt="{{ $class->name }}">
                            @else
                                @if(str_contains($class->saint_image, '/'))
                                    <img src="{{ asset($class->saint_image) }}" alt="{{ $class->name }}" onerror="this.src='{{ asset('images/default-class.jpg') }}'">
                                @else
                                    <img src="{{ asset('images/' . $class->saint_image) }}" alt="{{ $class->name }}" onerror="this.src='{{ asset('images/default-class.jpg') }}'">
                                @endif
                            @endif
                        @else
                            <img src="{{ asset('images/default-class.jpg') }}" alt="{{ $class->name }}">
                        @endif
                    </div>
                    
                    <div class="card-body">
                        <h5 class="card-title">{{ $class->name }}</h5>
                        
                        <div class="card-text">
                            <strong>المرحلة:</strong> {{ $class->stage }}<br>
                            <strong>النوع:</strong> {{ $class->gender ?? 'غير محدد' }}<br>
                            <strong>الجدول:</strong> {{ $class->schedule }}<br>
                            <strong>المكان:</strong> {{ $class->place }}<br>
                            <strong>الطلاب:</strong> {{ $class->students_count }}<br>
                            <strong>الخدام:</strong> {{ $class->servants_count }}
                        </div>
                        
                        <div class="btn-group">
                            <a href="{{ route('admin.classes.show', $class->id) }}" 
                               class="btn btn-outline-primary">
                                <i class="fas fa-eye me-1"></i>
                                عرض
                            </a>
                            <a href="{{ route('admin.classes.edit', $class->id) }}" 
                               class="btn btn-outline-warning">
                                <i class="fas fa-edit me-1"></i>
                                تعديل
                            </a>
                            <a href="{{ route('admin.attendance.show', $class->id) }}" 
                               class="btn btn-outline-info">
                                <i class="fas fa-clipboard-check me-1"></i>
                                الحضور
                            </a>
                            <a href="{{ route('admin.classes.students', $class->id) }}" 
                               class="btn btn-outline-success">
                                <i class="fas fa-user-graduate me-1"></i>
                                عرض الطلاب
                            </a>
                            <a href="{{ route('admin.classes.servants', $class->id) }}" 
                               class="btn btn-outline-secondary">
                                <i class="fas fa-user-tie me-1"></i>
                                عرض الخدام
                            </a>
                            <button type="button" 
                                    class="btn btn-outline-danger" 
                                    onclick="deleteClass({{ $class->id }}, '{{ $class->name }}', {{ $class->students_count }})"
                                    title="حذف الفصل">
                                <i class="fas fa-trash me-1"></i>
                                حذف
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-chalkboard-teacher"></i>
                    <h4>لا توجد فصول دراسية</h4>
                    <p>قم بإضافة فصل دراسي جديد للبدء</p>
                    <a href="{{ route('admin.classes.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>
                        إضافة فصل جديد
                    </a>
                </div>
            </div>
        @endforelse
    </div>
</div>



<script>
// البحث والفلترة
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const genderFilter = document.getElementById('genderFilter');
    const stageFilter = document.getElementById('stageFilter');
    
    function filterClasses() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedGender = genderFilter.value;
        const selectedStage = stageFilter.value;
        
        const classCards = document.querySelectorAll('.class-card');
        
        classCards.forEach(card => {
            const name = card.dataset.name;
            const gender = card.dataset.gender;
            const stage = card.dataset.stage;
            
            const matchesSearch = name.includes(searchTerm);
            const matchesGender = !selectedGender || gender === selectedGender;
            const matchesStage = !selectedStage || stage === selectedStage;
            
            if (matchesSearch && matchesGender && matchesStage) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
    
    searchInput.addEventListener('input', filterClasses);
    genderFilter.addEventListener('change', filterClasses);
    stageFilter.addEventListener('change', filterClasses);
});

// دالة حذف الفصل
function deleteClass(classId, className, studentsCount) {
    if (studentsCount > 0) {
        alert(`لا يمكن حذف الفصل "${className}" لوجود ${studentsCount} طالب مسجل فيه.\n\nيجب نقل جميع الطلاب من هذا الفصل أولاً قبل حذفه.`);
        return;
    }
    
    const confirmMessage = `هل أنت متأكد من حذف الفصل "${className}"؟\n\nهذا الإجراء لا يمكن التراجع عنه.`;
    
    if (confirm(confirmMessage)) {
        // إنشاء نموذج حذف
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.classes.destroy", ":id") }}'.replace(':id', classId);
        form.style.display = 'none';
        
        // إضافة token CSRF
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
        // إضافة method DELETE
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection 