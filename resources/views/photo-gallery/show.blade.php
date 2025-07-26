@push('styles')
<style>
    /* تصميم جديد وعصري لمعرض الصور بألوان الموقع */
    .photo-gallery-container {
        background: #0A2A4F;
        background-image: url('../images/download.png');
        background-size: 300px;
        background-blend-mode: multiply;
        min-height: 100vh;
        padding: 2rem 0;
    }

    .gallery-header {
        background: rgba(255, 255, 255, 0.97);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 20px 40px rgba(10, 42, 79, 0.18);
        border: 2px solid #FFD700;
        color: #0A2A4F;
    }

    .gallery-title {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(45deg, #FFD700, #FFC107);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-align: center;
        margin-bottom: 1rem;
        text-shadow: 0 2px 8px rgba(10, 42, 79, 0.1);
    }

    .gallery-subtitle {
        color: #0A2A4F;
        text-align: center;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
        font-weight: 500;
    }

    .gallery-meta {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .meta-item {
        background: linear-gradient(135deg, #0A2A4F 0%, #1e3a8a 100%);
        color: #FFD700;
        padding: 1rem;
        border-radius: 15px;
        text-align: center;
        box-shadow: 0 10px 20px rgba(10, 42, 79, 0.2);
        transition: transform 0.3s ease;
        border: 1px solid #FFD700;
    }

    .meta-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(255, 215, 0, 0.3);
    }

    .meta-label {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-bottom: 0.5rem;
        color: #FFD700;
    }

    .meta-value {
        font-size: 1.2rem;
        font-weight: 700;
        color: #FFD700;
    }

    .view-controls {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .view-btn {
        background: linear-gradient(90deg, #FFD700 60%, #FFC107 100%);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        color: #0A2A4F;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
    }

    .view-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
        background: #0A2A4F;
        color: #FFD700;
        border: 1.5px solid #FFD700;
    }

    .view-btn.active {
        background: #0A2A4F;
        color: #FFD700;
        border: 1.5px solid #FFD700;
    }

    /* تصميم جديد للصور بألوان الموقع */
    .photo-masonry {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        padding: 1rem;
    }

    .photo-card {
        background: rgba(255, 255, 255, 0.97);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 35px rgba(10, 42, 79, 0.15);
        transition: all 0.4s ease;
        position: relative;
        border: 2px solid #0A2A4F;
    }

    .photo-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 50px rgba(10, 42, 79, 0.25);
        border-color: #FFD700;
    }

    .photo-image-container {
        position: relative;
        overflow: hidden;
        height: 250px;
    }

    .photo-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .photo-card:hover .photo-image {
        transform: scale(1.1);
    }

    .photo-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255, 215, 0, 0.9), rgba(255, 193, 7, 0.9));
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .photo-card:hover .photo-overlay {
        opacity: 1;
    }

    .photo-number {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(10, 42, 79, 0.9);
        color: #FFD700;
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.9rem;
        border: 1px solid #FFD700;
    }

    .photo-actions {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .action-btn {
        background: rgba(255, 255, 255, 0.95);
        border: none;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        color: #0A2A4F;
        border: 1px solid #FFD700;
    }

    .action-btn:hover {
        background: #FFD700;
        color: #0A2A4F;
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(255, 215, 0, 0.4);
    }

    .photo-info {
        padding: 1.5rem;
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-top: 2px solid #FFD700;
    }

    .photo-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #0A2A4F;
        margin-bottom: 0.5rem;
        text-align: center;
    }

    .photo-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.85rem;
        color: #0A2A4F;
    }

    .photo-size, .photo-date {
        display: flex;
        align-items: center;
        gap: 0.3rem;
        color: #0A2A4F;
    }

    /* Lightbox محسن بألوان الموقع */
    .lightbox {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(10, 42, 79, 0.95);
        display: none;
        z-index: 9999;
        backdrop-filter: blur(10px);
    }

    .lightbox.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .lightbox-content {
        position: relative;
        max-width: 90%;
        max-height: 90%;
        text-align: center;
    }

    .lightbox-image {
        max-width: 100%;
        max-height: 80vh;
        border-radius: 15px;
        box-shadow: 0 20px 60px rgba(10, 42, 79, 0.5);
        border: 2px solid #FFD700;
    }

    .lightbox-info {
        background: rgba(255, 255, 255, 0.97);
        padding: 1rem 2rem;
        border-radius: 15px;
        margin-top: 1rem;
        backdrop-filter: blur(10px);
        border: 2px solid #FFD700;
        color: #0A2A4F;
    }

    .lightbox-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #0A2A4F;
        margin-bottom: 0.5rem;
    }

    .lightbox-counter {
        color: #0A2A4F;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .lightbox-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.95);
        border: none;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        color: #0A2A4F;
        border: 1px solid #FFD700;
    }

    .lightbox-nav:hover {
        background: #FFD700;
        color: #0A2A4F;
        transform: translateY(-50%) scale(1.1);
        box-shadow: 0 5px 15px rgba(255, 215, 0, 0.4);
    }

    .lightbox-prev {
        left: 20px;
    }

    .lightbox-next {
        right: 20px;
    }

    .lightbox-close {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(255, 255, 255, 0.95);
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        color: #0A2A4F;
        border: 1px solid #FFD700;
    }

    .lightbox-close:hover {
        background: #FFD700;
        color: #0A2A4F;
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(255, 215, 0, 0.4);
    }

    .lightbox-download {
        position: absolute;
        top: 20px;
        left: 20px;
        background: linear-gradient(90deg, #FFD700 60%, #FFC107 100%);
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 25px;
        cursor: pointer;
        color: #0A2A4F;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        border: 1px solid #0A2A4F;
    }

    .lightbox-download:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
        background: #0A2A4F;
        color: #FFD700;
        border-color: #FFD700;
        text-decoration: none;
    }

    /* تحسينات للعرض المتجاوب */
    @media (max-width: 768px) {
        .photo-masonry {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }

        .gallery-title {
            font-size: 2rem;
        }

        .gallery-meta {
            grid-template-columns: 1fr;
        }

        .lightbox-nav {
            width: 40px;
            height: 40px;
        }

        .lightbox-prev {
            left: 10px;
        }

        .lightbox-next {
            right: 10px;
        }
    }

    /* انيميشن للتحميل */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .photo-card {
        animation: fadeInUp 0.6s ease forwards;
    }

    .photo-card:nth-child(1) { animation-delay: 0.1s; }
    .photo-card:nth-child(2) { animation-delay: 0.2s; }
    .photo-card:nth-child(3) { animation-delay: 0.3s; }
    .photo-card:nth-child(4) { animation-delay: 0.4s; }
    .photo-card:nth-child(5) { animation-delay: 0.5s; }
    .photo-card:nth-child(6) { animation-delay: 0.6s; }
    .photo-card:nth-child(7) { animation-delay: 0.7s; }
    .photo-card:nth-child(8) { animation-delay: 0.8s; }
</style>
@endpush

@extends('layouts.app')

@section('content')
<div class="photo-gallery-container">
    <div class="container mx-auto px-4">
        <!-- رأس المعرض -->
        <div class="gallery-header">
            <h1 class="gallery-title">{{ $gallery->title }}</h1>
            <p class="gallery-subtitle">{{ $gallery->description }}</p>
            
            <div class="gallery-meta">
                <div class="meta-item">
                    <div class="meta-label">أنشئ بواسطة</div>
                    <div class="meta-value">{{ $gallery->creator->name }}</div>
                </div>
                <div class="meta-item">
                    <div class="meta-label">تاريخ الإنشاء</div>
                    <div class="meta-value">{{ $gallery->created_at->format('Y/m/d') }}</div>
                </div>
                <div class="meta-item">
                    <div class="meta-label">عدد الصور</div>
                    <div class="meta-value">{{ $gallery->photos->count() > 0 ? $gallery->photos->count() : '8' }}</div>
                </div>
            </div>

            <!-- أزرار التحكم في العرض -->
            <div class="view-controls">
                <button class="view-btn active" onclick="switchView('grid')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    عرض شبكي
                </button>
                <button class="view-btn" onclick="switchView('list')">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    عرض قائمة
                </button>
            </div>
        </div>

        <!-- عرض شبكي -->
        <div id="grid-container" class="photo-masonry">
            @if($gallery->photos->count() > 0)
                @foreach($gallery->photos as $index => $photo)
                    <div class="photo-card">
                        <!-- الصورة -->
                        <div class="photo-image-container">
                            <img src="{{ $photo->thumbnail_url }}" 
                                 alt="{{ $photo->original_name }}" 
                                 class="photo-image"
                                 onclick="openLightbox('{{ $photo->image_url }}', '{{ $photo->original_name }}', {{ $index }})"
                                 loading="lazy">
                            
                            <!-- Overlay مع الأزرار -->
                            <div class="photo-overlay">
                                <div class="photo-number">{{ $index + 1 }}</div>
                                <div class="photo-actions">
                                    <button onclick="openLightbox('{{ $photo->image_url }}', '{{ $photo->original_name }}', {{ $index }})" 
                                            class="action-btn view-btn">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    
                                    <a href="{{ route('photo-gallery.download', ['galleryId' => $gallery->id, 'photoId' => $photo->id]) }}" 
                                       class="action-btn download-btn">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </a>
                                    
                                    @if(auth()->user()->isServant() && $gallery->created_by === auth()->id())
                                        <button onclick="deletePhoto({{ $gallery->id }}, {{ $photo->id }}, '{{ $photo->original_name }}')" 
                                                class="action-btn delete-btn">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- معلومات الصورة -->
                        <div class="photo-info">
                            <h4 class="photo-title">{{ $photo->original_name }}</h4>
                            <div class="photo-meta">
                                <span class="photo-size">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    {{ $photo->formatted_file_size }}
                                </span>
                                <span class="photo-date">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $photo->created_at->format('Y/m/d') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- صور عشوائية جميلة للعرض -->
                @php
                    $demoImages = [
                        ['url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=300&fit=crop', 'name' => 'صورة تجمع 1.jpg', 'size' => '2.3 MB'],
                        ['url' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=400&h=300&fit=crop', 'name' => 'صورة تجمع 2.jpg', 'size' => '1.8 MB'],
                        ['url' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&h=300&fit=crop', 'name' => 'صورة تجمع 3.jpg', 'size' => '3.1 MB'],
                        ['url' => 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=400&h=300&fit=crop', 'name' => 'صورة تجمع 4.jpg', 'size' => '2.7 MB'],
                        ['url' => 'https://images.unsplash.com/photo-1521737711867-e3b97375f902?w=400&h=300&fit=crop', 'name' => 'صورة تجمع 5.jpg', 'size' => '2.0 MB'],
                        ['url' => 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=400&h=300&fit=crop', 'name' => 'صورة تجمع 6.jpg', 'size' => '1.9 MB'],
                        ['url' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=400&h=300&fit=crop', 'name' => 'صورة تجمع 7.jpg', 'size' => '2.5 MB'],
                        ['url' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=400&h=300&fit=crop', 'name' => 'صورة تجمع 8.jpg', 'size' => '2.1 MB']
                    ];
                @endphp
                
                @foreach($demoImages as $index => $demoImage)
                    <div class="photo-card">
                        <!-- الصورة -->
                        <div class="photo-image-container">
                            <img src="{{ $demoImage['url'] }}" 
                                 alt="{{ $demoImage['name'] }}" 
                                 class="photo-image"
                                 onclick="openLightbox('{{ $demoImage['url'] }}', '{{ $demoImage['name'] }}', {{ $index }})"
                                 loading="lazy">
                            
                            <!-- Overlay مع الأزرار -->
                            <div class="photo-overlay">
                                <div class="photo-number">{{ $index + 1 }}</div>
                                <div class="photo-actions">
                                    <button onclick="openLightbox('{{ $demoImage['url'] }}', '{{ $demoImage['name'] }}', {{ $index }})" 
                                            class="action-btn view-btn">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </button>
                                    
                                    <a href="#" class="action-btn download-btn">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- معلومات الصورة -->
                        <div class="photo-info">
                            <h4 class="photo-title">{{ $demoImage['name'] }}</h4>
                            <div class="photo-meta">
                                <span class="photo-size">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    {{ $demoImage['size'] }}
                                </span>
                                <span class="photo-date">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ now()->format('Y/m/d') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- عرض قائمة (مخفي افتراضياً) -->
        <div id="list-container" class="hidden">
            <!-- محتوى عرض القائمة -->
        </div>
    </div>
</div>

<!-- Lightbox محسن -->
<div id="lightbox" class="lightbox" onclick="closeLightbox()">
    <div class="lightbox-content" onclick="event.stopPropagation()">
        <img id="lightbox-image" class="lightbox-image" src="" alt="">
        <div class="lightbox-info">
            <div id="lightbox-title" class="lightbox-title"></div>
            <div id="lightbox-counter" class="lightbox-counter"></div>
        </div>
        
        <button class="lightbox-nav lightbox-prev" onclick="previousImage()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        
        <button class="lightbox-nav lightbox-next" onclick="nextImage()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
        
        <button class="lightbox-close" onclick="closeLightbox()">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <a href="#" id="lightbox-download" class="lightbox-download">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            تحميل الصورة
        </a>
    </div>
</div>

<script>
let currentImageIndex = 0;
let images = [];

// تجميع الصور
document.addEventListener('DOMContentLoaded', function() {
    const photoCards = document.querySelectorAll('.photo-card');
    images = Array.from(photoCards).map((card, index) => {
        const img = card.querySelector('.photo-image');
        const title = card.querySelector('.photo-title').textContent;
        const downloadLink = card.querySelector('.download-btn')?.href || '#';
        return {
            src: img.src,
            title: title,
            downloadLink: downloadLink
        };
    });
});

function openLightbox(src, title, index) {
    currentImageIndex = index;
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxCounter = document.getElementById('lightbox-counter');
    const lightboxDownload = document.getElementById('lightbox-download');
    
    lightboxImage.src = src;
    lightboxTitle.textContent = title;
    lightboxCounter.textContent = `${index + 1} من ${images.length}`;
    lightboxDownload.href = images[index].downloadLink;
    
    lightbox.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.remove('active');
    document.body.style.overflow = 'auto';
}

function previousImage() {
    currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
    const image = images[currentImageIndex];
    openLightbox(image.src, image.title, currentImageIndex);
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % images.length;
    const image = images[currentImageIndex];
    openLightbox(image.src, image.title, currentImageIndex);
}

function switchView(view) {
    const gridContainer = document.getElementById('grid-container');
    const listContainer = document.getElementById('list-container');
    const buttons = document.querySelectorAll('.view-btn');
    
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');
    
    if (view === 'grid') {
        gridContainer.classList.remove('hidden');
        listContainer.classList.add('hidden');
    } else {
        gridContainer.classList.add('hidden');
        listContainer.classList.remove('hidden');
    }
}

function deletePhoto(galleryId, photoId, photoName) {
    if (confirm(`هل أنت متأكد من حذف الصورة "${photoName}"؟`)) {
        fetch(`/photo-gallery/${galleryId}/photos/${photoId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('حدث خطأ أثناء حذف الصورة');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ أثناء حذف الصورة');
        });
    }
}

// إغلاق Lightbox بالضغط على ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeLightbox();
    } else if (event.key === 'ArrowLeft') {
        previousImage();
    } else if (event.key === 'ArrowRight') {
        nextImage();
    }
});
</script>
@endsection 