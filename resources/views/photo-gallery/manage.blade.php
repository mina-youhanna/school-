@extends('layouts.app')

@section('title', 'إدارة مكتبة الصور')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/photo-gallery.css') }}">
<style>
.admin-manage-container {
    background: linear-gradient(135deg, rgba(10, 42, 79, 0.1) 0%, rgba(30, 58, 138, 0.1) 100%);
    border-radius: 20px;
    padding: 2rem;
    margin-top: 1rem;
}

.admin-header {
    text-align: center;
    margin-bottom: 2rem;
}

.admin-title {
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 50%, #FFD700 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
}

.admin-subtitle {
    color: #6b7280;
    font-size: 1.1rem;
}

.gallery-table {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(10, 42, 79, 0.15);
    margin-bottom: 2rem;
}

.table-header {
    background: linear-gradient(135deg, #0A2A4F 0%, #1e3a8a 100%);
    color: #FFD700;
    padding: 1rem;
    font-weight: bold;
}

.table-row {
    display: grid;
    grid-template-columns: 1fr 2fr 1fr 1fr 1fr 1fr;
    gap: 1rem;
    padding: 1rem;
    border-bottom: 1px solid #e5e7eb;
    align-items: center;
}

.table-row:hover {
    background: rgba(255, 215, 0, 0.05);
}

.table-row:last-child {
    border-bottom: none;
}

.gallery-actions {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
}

.action-btn {
    padding: 0.5rem;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 40px;
    height: 40px;
}

.action-btn:hover {
    transform: scale(1.1);
}

.btn-edit {
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    color: #0A2A4F;
}

.btn-delete {
    background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
    color: white;
}

.btn-toggle {
    background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    color: white;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    text-align: center;
}

.status-active {
    background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    color: white;
}

.status-inactive {
    background: linear-gradient(135deg, #6b7280 0%, #9ca3af 100%);
    color: white;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 8px 25px rgba(10, 42, 79, 0.15);
    text-align: center;
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    border-color: #FFD700;
    box-shadow: 0 15px 35px rgba(10, 42, 79, 0.25);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: bold;
    color: #0A2A4F;
    margin-bottom: 0.5rem;
}

.stat-label {
    color: #6b7280;
    font-size: 1rem;
    font-weight: 600;
}

@media (max-width: 768px) {
    .table-row {
        grid-template-columns: 1fr;
        gap: 0.5rem;
        text-align: center;
    }
    
    .gallery-actions {
        justify-content: center;
        margin-top: 0.5rem;
    }
}
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="admin-manage-container">
        <div class="admin-header">
            <h1 class="admin-title">إدارة مكتبة الصور</h1>
            <p class="admin-subtitle">إدارة جميع المكتبات والصور في النظام</p>
        </div>

        <!-- إحصائيات سريعة -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $galleries->count() }}</div>
                <div class="stat-label">إجمالي المكتبات</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $galleries->where('is_active', true)->count() }}</div>
                <div class="stat-label">المكتبات النشطة</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $galleries->sum(function($gallery) { return $gallery->photos->count(); }) }}</div>
                <div class="stat-label">إجمالي الصور</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $galleries->unique('created_by')->count() }}</div>
                <div class="stat-label">عدد المنشئين</div>
            </div>
        </div>

        <!-- جدول المكتبات -->
        <div class="gallery-table">
            <div class="table-header">
                <div class="table-row">
                    <div>المنشئ</div>
                    <div>عنوان المكتبة</div>
                    <div>عدد الصور</div>
                    <div>الحالة</div>
                    <div>تاريخ الإنشاء</div>
                    <div>الإجراءات</div>
                </div>
            </div>
            
            @foreach($galleries as $gallery)
                <div class="table-row">
                    <div>
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                {{ substr($gallery->creator->full_name ?? 'غير محدد', 0, 1) }}
                            </div>
                            <span class="text-sm font-medium">{{ $gallery->creator->full_name ?? 'غير محدد' }}</span>
                        </div>
                    </div>
                    
                    <div>
                        <div class="font-semibold text-gray-900">{{ $gallery->title }}</div>
                        @if($gallery->description)
                            <div class="text-sm text-gray-600 line-clamp-1">{{ $gallery->description }}</div>
                        @endif
                    </div>
                    
                    <div class="text-center">
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm font-medium">
                            {{ $gallery->photos->count() }} صورة
                        </span>
                    </div>
                    
                    <div class="text-center">
                        <span class="status-badge {{ $gallery->is_active ? 'status-active' : 'status-inactive' }}">
                            {{ $gallery->is_active ? 'نشطة' : 'غير نشطة' }}
                        </span>
                    </div>
                    
                    <div class="text-center text-sm text-gray-600">
                        {{ $gallery->created_at->format('Y/m/d') }}
                    </div>
                    
                    <div class="gallery-actions">
                        <a href="{{ route('photo-gallery.show', $gallery->id) }}" class="action-btn btn-edit" title="عرض المكتبة">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </a>
                        
                        <a href="{{ route('photo-gallery.edit', $gallery->id) }}" class="action-btn btn-edit" title="تعديل المكتبة">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        
                        <form action="{{ route('photo-gallery.toggle-status', $gallery->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="action-btn btn-toggle" title="{{ $gallery->is_active ? 'إيقاف المكتبة' : 'تفعيل المكتبة' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                            </button>
                        </form>
                        
                        <form action="{{ route('photo-gallery.destroy', $gallery->id) }}" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذه المكتبة؟')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn btn-delete" title="حذف المكتبة">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- أزرار إضافية -->
        <div class="text-center mt-8">
            <a href="{{ route('photo-gallery.index') }}" class="inline-flex items-center bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition duration-300">
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                العودة إلى المكتبات
            </a>
        </div>
    </div>
</div>
@endsection 