@extends('layouts.app')

@section('title', 'إدارة الحضور والغياب')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-gradient-primary text-white">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-clipboard-list me-2"></i>
                        إدارة الحضور والغياب
                    </h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="row">
                        @forelse($classes as $class)
                            <div class="col-md-6 col-lg-4 mb-4">
                                <div class="card h-100 shadow-sm border-0">
                                    <div class="card-header bg-gradient-info text-white">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="card-title mb-0">
                                                <i class="fas fa-graduation-cap me-2"></i>
                                                {{ $class->name }}
                                            </h5>
                                            <span class="badge bg-light text-dark">{{ $class->stage }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <small class="text-muted">الطلاب:</small>
                                                <div class="fw-bold text-primary">{{ $class->students_count }}</div>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted">الخدام:</small>
                                                <div class="fw-bold text-success">{{ $class->servants_count }}</div>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <small class="text-muted">الجدول:</small>
                                            <div class="fw-bold">{{ $class->schedule }}</div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <small class="text-muted">المكان:</small>
                                            <div class="fw-bold">{{ $class->place }}</div>
                                        </div>
                                        
                                        <!-- إحصائيات الحضور -->
                                        <div class="border-top pt-3">
                                            <h6 class="text-muted mb-2">إحصائيات الحضور</h6>
                                            <div class="row text-center">
                                                <div class="col-4">
                                                    <div class="text-success">
                                                        <i class="fas fa-check-circle fa-lg mb-1"></i>
                                                        <div class="small">حاضر</div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="text-danger">
                                                        <i class="fas fa-times-circle fa-lg mb-1"></i>
                                                        <div class="small">غائب</div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="text-warning">
                                                        <i class="fas fa-clock fa-lg mb-1"></i>
                                                        <div class="small">متأخر</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-light">
                                        <div class="btn-group w-100" role="group">
                                            <a href="{{ route('admin.attendance.show', $class->id) }}" 
                                               class="btn btn-outline-primary btn-sm">
                                                <i class="fas fa-clipboard-check me-1"></i>
                                                تسجيل الحضور
                                            </a>
                                            <a href="{{ route('admin.classes.show', $class->id) }}" 
                                               class="btn btn-outline-info btn-sm">
                                                <i class="fas fa-eye me-1"></i>
                                                عرض الفصل
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="text-center py-5">
                                    <i class="fas fa-chalkboard-teacher fa-3x text-muted mb-3"></i>
                                    <h4 class="text-muted">لا توجد فصول دراسية</h4>
                                    <p class="text-muted">قم بإضافة فصول دراسية للبدء في إدارة الحضور</p>
                                    <a href="{{ route('admin.classes.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-1"></i>
                                        إضافة فصل جديد
                                    </a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-5px);
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
</style>
@endsection 