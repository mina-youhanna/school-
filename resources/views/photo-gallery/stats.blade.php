@extends('layouts.app')

@section('title', 'إحصائيات مكتبة الصور')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/photo-gallery.css') }}">
<style>
.stats-container {
    background: linear-gradient(135deg, rgba(10, 42, 79, 0.1) 0%, rgba(30, 58, 138, 0.1) 100%);
    border-radius: 20px;
    padding: 2rem;
    margin-top: 1rem;
}

.stats-header {
    text-align: center;
    margin-bottom: 3rem;
}

.stats-title {
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 50%, #FFD700 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 1rem;
}

.stats-subtitle {
    color: #6b7280;
    font-size: 1.1rem;
}

.main-stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.main-stat-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 15px 35px rgba(10, 42, 79, 0.15);
    text-align: center;
    border: 3px solid transparent;
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

.main-stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #FFD700, #FFA500, #FFD700);
    background-size: 200% 100%;
    animation: shimmer 3s infinite;
}

@keyframes shimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
}

.main-stat-card:hover {
    transform: translateY(-10px);
    border-color: #FFD700;
    box-shadow: 0 25px 50px rgba(10, 42, 79, 0.25);
}

.main-stat-number {
    font-size: 3.5rem;
    font-weight: bold;
    background: linear-gradient(135deg, #0A2A4F 0%, #1e3a8a 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1rem;
}

.main-stat-label {
    color: #6b7280;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.main-stat-description {
    color: #9ca3af;
    font-size: 0.9rem;
}

.charts-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    margin-bottom: 3rem;
}

.chart-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 15px 35px rgba(10, 42, 79, 0.15);
    border: 2px solid transparent;
    transition: all 0.3s ease;
}

.chart-card:hover {
    border-color: #FFD700;
    transform: translateY(-5px);
}

.chart-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #0A2A4F;
    margin-bottom: 1.5rem;
    text-align: center;
}

.recent-galleries {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 15px 35px rgba(10, 42, 79, 0.15);
    margin-bottom: 2rem;
}

.gallery-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border-bottom: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}

.gallery-item:hover {
    background: rgba(255, 215, 0, 0.05);
    border-radius: 10px;
}

.gallery-item:last-child {
    border-bottom: none;
}

.gallery-avatar {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #0A2A4F 0%, #1e3a8a 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #FFD700;
    font-weight: bold;
    font-size: 1.2rem;
}

.gallery-info {
    flex: 1;
}

.gallery-name {
    font-weight: bold;
    color: #0A2A4F;
    margin-bottom: 0.25rem;
}

.gallery-creator {
    color: #6b7280;
    font-size: 0.9rem;
}

.gallery-stats {
    text-align: right;
}

.gallery-photo-count {
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    color: #0A2A4F;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.875rem;
    font-weight: 600;
}

.top-creators {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 15px 35px rgba(10, 42, 79, 0.15);
}

.creator-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem;
    border-bottom: 1px solid #e5e7eb;
    transition: all 0.3s ease;
}

.creator-item:hover {
    background: rgba(255, 215, 0, 0.05);
    border-radius: 10px;
}

.creator-item:last-child {
    border-bottom: none;
}

.creator-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.creator-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #0A2A4F 0%, #1e3a8a 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #FFD700;
    font-weight: bold;
}

.creator-name {
    font-weight: 600;
    color: #0A2A4F;
}

.creator-count {
    background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.875rem;
    font-weight: 600;
}

@media (max-width: 768px) {
    .charts-section {
        grid-template-columns: 1fr;
    }
    
    .main-stats-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="stats-container">
        <div class="stats-header">
            <h1 class="stats-title">إحصائيات مكتبة الصور</h1>
            <p class="stats-subtitle">نظرة شاملة على أداء المكتبات والصور</p>
        </div>

        <!-- الإحصائيات الرئيسية -->
        <div class="main-stats-grid">
            <div class="main-stat-card">
                <div class="main-stat-number">{{ $stats['total_galleries'] }}</div>
                <div class="main-stat-label">إجمالي المكتبات</div>
                <div class="main-stat-description">عدد جميع المكتبات في النظام</div>
            </div>
            
            <div class="main-stat-card">
                <div class="main-stat-number">{{ $stats['active_galleries'] }}</div>
                <div class="main-stat-label">المكتبات النشطة</div>
                <div class="main-stat-description">المكتبات المتاحة للعرض</div>
            </div>
            
            <div class="main-stat-card">
                <div class="main-stat-number">{{ $stats['total_photos'] }}</div>
                <div class="main-stat-label">إجمالي الصور</div>
                <div class="main-stat-description">عدد جميع الصور المرفوعة</div>
            </div>
            
            <div class="main-stat-card">
                <div class="main-stat-number">{{ $stats['total_creators'] }}</div>
                <div class="main-stat-label">عدد المنشئين</div>
                <div class="main-stat-description">المستخدمين الذين أنشأوا مكتبات</div>
            </div>
        </div>

        <!-- الرسوم البيانية والإحصائيات التفصيلية -->
        <div class="charts-section">
            <div class="chart-card">
                <h3 class="chart-title">نسبة المكتبات النشطة</h3>
                <div class="text-center">
                    @php
                        $activePercentage = $stats['total_galleries'] > 0 ? round(($stats['active_galleries'] / $stats['total_galleries']) * 100, 1) : 0;
                    @endphp
                    <div class="text-4xl font-bold text-green-600 mb-2">{{ $activePercentage }}%</div>
                    <div class="text-gray-600">{{ $stats['active_galleries'] }} من {{ $stats['total_galleries'] }} مكتبة</div>
                </div>
            </div>
            
            <div class="chart-card">
                <h3 class="chart-title">متوسط الصور لكل مكتبة</h3>
                <div class="text-center">
                    @php
                        $avgPhotos = $stats['total_galleries'] > 0 ? round($stats['total_photos'] / $stats['total_galleries'], 1) : 0;
                    @endphp
                    <div class="text-4xl font-bold text-blue-600 mb-2">{{ $avgPhotos }}</div>
                    <div class="text-gray-600">صورة لكل مكتبة</div>
                </div>
            </div>
        </div>

        <!-- المكتبات الحديثة -->
        <div class="recent-galleries">
            <h3 class="chart-title">المكتبات الحديثة</h3>
            @if($stats['recent_galleries']->count() > 0)
                @foreach($stats['recent_galleries'] as $gallery)
                    <div class="gallery-item">
                        <div class="gallery-avatar">
                            {{ substr($gallery->creator->full_name ?? 'غير محدد', 0, 1) }}
                        </div>
                        <div class="gallery-info">
                            <div class="gallery-name">{{ $gallery->title }}</div>
                            <div class="gallery-creator">بواسطة: {{ $gallery->creator->full_name ?? 'غير محدد' }}</div>
                        </div>
                        <div class="gallery-stats">
                            <span class="gallery-photo-count">{{ $gallery->photos->count() }} صورة</span>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="text-center text-gray-500 py-8">
                    لا توجد مكتبات حديثة
                </div>
            @endif
        </div>

        <!-- أفضل المنشئين -->
        <div class="top-creators">
            <h3 class="chart-title">أفضل المنشئين</h3>
            @if($stats['top_creators']->count() > 0)
                @foreach($stats['top_creators'] as $creator)
                    <div class="creator-item">
                        <div class="creator-info">
                            <div class="creator-avatar">
                                {{ substr($creator->creator->full_name ?? 'غير محدد', 0, 1) }}
                            </div>
                            <div class="creator-name">{{ $creator->creator->full_name ?? 'غير محدد' }}</div>
                        </div>
                        <div class="creator-count">{{ $creator->gallery_count }} مكتبة</div>
                    </div>
                @endforeach
            @else
                <div class="text-center text-gray-500 py-8">
                    لا توجد بيانات للمنشئين
                </div>
            @endif
        </div>

        <!-- أزرار التنقل -->
        <div class="text-center mt-8">
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('photo-gallery.manage') }}" class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    إدارة المكتبات
                </a>
                
                <a href="{{ route('photo-gallery.index') }}" class="inline-flex items-center bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition duration-300">
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    العودة إلى المكتبات
                </a>
            </div>
        </div>
    </div>
</div>
@endsection 