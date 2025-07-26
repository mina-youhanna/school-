@extends('layouts.app')

@section('title', 'مكتبة الصور')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/photo-gallery.css') }}">
<style>
/* Photo Gallery Index Custom Styles - Enhanced with Site Colors */

/* تحسينات عامة للبطاقات */
.bg-white.rounded-lg.shadow-lg {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid #0A2A4F;
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(10, 42, 79, 0.15);
    position: relative;
    overflow: hidden;
}

.bg-white.rounded-lg.shadow-lg::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #FFD700, #FFA500, #FFD700);
    background-size: 200% 100%;
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
}

.bg-white.rounded-lg.shadow-lg:hover {
    transform: translateY(-12px) scale(1.03);
    box-shadow: 0 25px 50px rgba(10, 42, 79, 0.25);
    border-color: #FFD700;
}

.bg-white.rounded-lg.shadow-lg:hover::before {
    background: linear-gradient(90deg, #FFD700, #FFA500, #FFD700);
    animation: shimmer 1s infinite;
}

/* تحسينات للصور */
.bg-white.rounded-lg.shadow-lg img {
    transition: transform 0.4s ease;
    border-radius: 15px 15px 0 0;
}

.bg-white.rounded-lg.shadow-lg:hover img {
    transform: scale(1.08);
}

/* تحسينات للعداد */
.absolute.top-2.right-2 {
    background: linear-gradient(135deg, #0A2A4F 0%, #1e3a8a 100%) !important;
    backdrop-filter: blur(15px);
    border: 2px solid #FFD700;
    font-weight: 700;
    border-radius: 15px;
    padding: 8px 12px;
    box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
    color: #FFD700;
    font-size: 0.875rem;
}

/* تحسينات للمعلومات */
.p-4 {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
}

/* تحسينات للأزرار */
.bg-blue-600, .bg-yellow-600, .bg-green-600, .bg-gray-600 {
    transition: all 0.4s ease;
    font-weight: 700;
    letter-spacing: 1px;
    border-radius: 15px;
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
    text-transform: uppercase;
    font-size: 0.9rem;
}

.bg-blue-600 {
    background: linear-gradient(135deg, #0A2A4F 0%, #1e3a8a 100%);
    border-color: #FFD700;
}

.bg-yellow-600 {
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    color: #0A2A4F;
    border-color: #0A2A4F;
}

.bg-green-600 {
    background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    border-color: #FFD700;
}

.bg-gray-600 {
    background: linear-gradient(135deg, #374151 0%, #6b7280 100%);
    border-color: #FFD700;
}

.bg-blue-600:hover, .bg-yellow-600:hover, .bg-green-600:hover, .bg-gray-600:hover {
    transform: translateY(-4px) scale(1.05);
    box-shadow: 0 15px 30px rgba(10, 42, 79, 0.4);
    border-color: #FFD700;
}

.bg-blue-600::before, .bg-yellow-600::before, .bg-green-600::before, .bg-gray-600::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.3), transparent);
    transition: left 0.6s;
}

.bg-blue-600:hover::before, .bg-yellow-600:hover::before, .bg-green-600:hover::before, .bg-gray-600:hover::before {
    left: 100%;
}

/* تحسينات للعناوين */
.text-4xl.font-bold {
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 50%, #FFD700 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
    font-size: 3rem;
    letter-spacing: 2px;
}

/* تحسينات للرسائل */
.bg-blue-50 {
    background: linear-gradient(135deg, #0A2A4F 0%, #1e3a8a 100%);
    border: 3px solid #FFD700;
    border-radius: 20px;
    color: white;
    box-shadow: 0 10px 30px rgba(10, 42, 79, 0.3);
}

/* تأثيرات التحميل */
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

.bg-white.rounded-lg.shadow-lg {
    animation: fadeInUp 0.6s ease-out;
}

/* تحسينات للشبكة */
.grid {
    animation: fadeInUp 0.8s ease-out;
}

/* تحسينات للخلفية العامة */
.container {
    background: linear-gradient(135deg, rgba(10, 42, 79, 0.1) 0%, rgba(30, 58, 138, 0.1) 100%);
    border-radius: 20px;
    padding: 2rem;
    margin-top: 1rem;
}

/* تصميم Masonry جديد */
.gallery-masonry {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2.5rem;
    padding: 1rem 0;
}

.gallery-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(10, 42, 79, 0.1);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    border: 3px solid transparent;
    position: relative;
    backdrop-filter: blur(10px);
}

.gallery-card::before {
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

.gallery-card:hover {
    transform: translateY(-15px) scale(1.03);
    box-shadow: 0 30px 60px rgba(10, 42, 79, 0.2);
    border-color: #FFD700;
    box-shadow: 0 25px 50px rgba(255, 215, 0, 0.15);
}

.gallery-cover {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.cover-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.gallery-card:hover .cover-image {
    transform: scale(1.1);
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 0%, rgba(10, 42, 79, 0.8) 100%);
    opacity: 0;
    transition: opacity 0.4s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 1.5rem;
}

.gallery-card:hover .gallery-overlay {
    opacity: 1;
}

.gallery-stats {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: white;
    font-weight: 600;
}

.photo-count {
    background: rgba(255, 215, 0, 0.9);
    color: #0A2A4F;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
}

.gallery-date {
    background: rgba(255, 255, 255, 0.2);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
}

.gallery-actions {
    display: flex;
    justify-content: center;
}

.view-btn {
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    color: #0A2A4F;
    padding: 0.75rem 1.5rem;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.view-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(255, 215, 0, 0.3);
    border-color: #0A2A4F;
}

.gallery-info {
    padding: 1.5rem;
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
}

.gallery-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
}

.gallery-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #0A2A4F;
    margin: 0;
    line-height: 1.3;
    position: relative;
    padding-bottom: 0.5rem;
}

.gallery-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background: linear-gradient(90deg, #FFD700, #FFA500);
    border-radius: 2px;
}

.gallery-badge {
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0A2A4F;
    flex-shrink: 0;
}

.gallery-description {
    color: #6b7280;
    font-size: 0.9rem;
    line-height: 1.6;
    margin-bottom: 1rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    padding: 0.75rem;
    background: rgba(255, 215, 0, 0.05);
    border-radius: 10px;
    border-right: 3px solid #FFD700;
    font-style: italic;
}

.gallery-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
    padding: 1rem;
    background: linear-gradient(135deg, rgba(10, 42, 79, 0.05) 0%, rgba(30, 58, 138, 0.05) 100%);
    border-radius: 15px;
    border-left: 4px solid #FFD700;
    position: relative;
    overflow: hidden;
}

.gallery-meta::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: linear-gradient(90deg, #FFD700, #FFA500, #FFD700);
    background-size: 200% 100%;
    animation: shimmer 3s infinite;
}

.creator-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.creator-avatar {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #0A2A4F 0%, #1e3a8a 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #FFD700;
}

.creator-name {
    color: #0A2A4F;
    font-weight: 600;
    font-size: 0.9rem;
}

.gallery-date-full {
    color: #6b7280;
    font-size: 0.875rem;
    font-weight: 500;
}

.gallery-buttons {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    margin-top: 1.5rem;
    gap: 0.75rem;.edit-btn {
    width: 52px;
    height: 52px;
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    color: #0A2A4F;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 3px solid #0A2A4F;
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 16px rgba(255, 215, 0, 0.3);
}

.edit-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.6s;
}

.edit-btn:hover {
    transform: scale(1.15) rotate(8deg);
    box-shadow: 0 15px 30px rgba(255, 215, 0, 0.5);
    border-color: #FFD700;
    background: linear-gradient(135deg, #FFA500 0%, #FFD700 100%);
}

.edit-btn:hover::before {
    left: 100%;
}

/* تحسينات للعرض المتجاوب */
@media (max-width: 768px) {
    .gallery-masonry {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }
    
    .gallery-cover {
        height: 180px;
    }
    
    .gallery-info {
        padding: 1rem;
    }
    
    .gallery-title {
        font-size: 1.1rem;
    }
}

@media (max-width: 480px) {
    .gallery-masonry {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .gallery-meta {
        flex-direction: column;
        gap: 0.75rem;
        align-items: flex-start;
    }
}

/* تحسينات للعناوين */
h1, h3 {
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* تحسينات للأيقونات */
svg {
    transition: transform 0.3s ease;
}

.bg-white.rounded-lg.shadow-lg:hover svg {
    transform: scale(1.1);
}

/* تحسينات للوصف */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* تحسينات للعناوين الفرعية */
.text-gray-600.text-lg {
    color: #FFD700;
    font-weight: 600;
    text-shadow: 0 2px 4px rgba(255, 215, 0, 0.3);
    font-size: 1.25rem;
    letter-spacing: 1px;
}

/* تصميم العنوان الرئيسي */
.page-title {
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 50%, #FFD700 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 3.5rem;
    font-weight: bold;
    text-align: center;
    margin-bottom: 2rem;
    position: relative;
    text-shadow: none;
}

.page-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 120px;
    height: 5px;
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    border-radius: 3px;
    box-shadow: 0 2px 8px rgba(255, 215, 0, 0.5);
}

/* تحسينات للبطاقات الفارغة */
.flex.items-center.justify-center {
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
}

/* تصميم البطاقة الفارغة */
.empty-state-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 25px;
    padding: 3rem 2rem;
    box-shadow: 0 20px 40px rgba(10, 42, 79, 0.1);
    border: 3px solid rgba(255, 215, 0, 0.2);
    max-width: 500px;
    margin: 0 auto;
    position: relative;
    overflow: hidden;
}

.empty-state-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #FFD700, #FFA500, #FFD700);
    background-size: 200% 100%;
    animation: shimmer 2s infinite;
}

.empty-icon {
    width: 120px;
    height: 120px;
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.1) 0%, rgba(255, 165, 0, 0.1) 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    border: 3px solid rgba(255, 215, 0, 0.3);
    color: #FFD700;
}

.empty-title {
    font-size: 1.5rem;
    font-weight: bold;
    color: #0A2A4F;
    margin-bottom: 1rem;
    text-align: center;
}

.empty-description {
    color: #6b7280;
    font-size: 1.1rem;
    text-align: center;
    margin-bottom: 2rem;
}

.empty-action-btn {
    display: inline-flex;
    align-items: center;
    background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    color: white;
    padding: 1rem 2rem;
    border-radius: 15px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid #047857;
    box-shadow: 0 8px 16px rgba(5, 150, 105, 0.3);
}

.empty-action-btn:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 15px 30px rgba(5, 150, 105, 0.4);
    background: linear-gradient(135deg, #047857 0%, #059669 100%);
}

/* تحسينات للأزرار في الرسائل */
.space-x-4 a {
    transition: all 0.3s ease;
    font-weight: 600;
}

.space-x-4 a:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* تصميم جديد لأزرار الإدارة */
.admin-controls {
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.1) 0%, rgba(255, 165, 0, 0.1) 100%);
    border-radius: 20px;
    padding: 2rem;
    border: 2px solid rgba(255, 215, 0, 0.3);
    margin-bottom: 2rem;
}

.controls-container {
    max-width: 1200px;
    margin: 0 auto;
}

.control-buttons {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    justify-items: center;
}

.control-btn {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem;
    border-radius: 15px;
    text-decoration: none;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    min-width: 280px;
    position: relative;
    overflow: hidden;
    border: 2px solid transparent;
}

.control-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: left 0.6s;
}

.control-btn:hover::before {
    left: 100%;
}

.control-btn:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.btn-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    position: relative;
    z-index: 2;
}

.btn-icon svg {
    width: 24px;
    height: 24px;
    stroke-width: 2;
}

.btn-content {
    flex: 1;
    text-align: right;
    position: relative;
    z-index: 2;
}

.btn-title {
    display: block;
    font-size: 1.1rem;
    font-weight: bold;
    margin-bottom: 0.25rem;
}

.btn-subtitle {
    display: block;
    font-size: 0.875rem;
    opacity: 0.8;
}

/* ألوان الأزرار */
.create-btn {
    background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    color: white;
    border-color: #047857;
}

.create-btn .btn-icon {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.manage-btn {
    background: linear-gradient(135deg, #0A2A4F 0%, #1e3a8a 100%);
    color: #FFD700;
    border-color: #FFD700;
}

.manage-btn .btn-icon {
    background: rgba(255, 215, 0, 0.2);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 215, 0, 0.3);
}

.stats-btn {
    background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
    color: white;
    border-color: #6d28d9;
}

.stats-btn .btn-icon {
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
}

/* تحسينات للعرض المتجاوب */
@media (max-width: 768px) {
    .control-buttons {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .control-btn {
        min-width: 100%;
        padding: 1.25rem;
    }
    
    .btn-icon {
        width: 50px;
        height: 50px;
    }
    
    .btn-title {
        font-size: 1rem;
    }
    
    .btn-subtitle {
        font-size: 0.8rem;
    }
}

/* تحسينات للعناوين */
h1, h3 {
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* تحسينات للشبكة */
.grid.grid-cols-1.md\:grid-cols-2.lg\:grid-cols-3.xl\:grid-cols-4 {
    gap: 1.5rem;
}

/* تحسينات للعرض المتجاوب */
@media (max-width: 768px) {
    .text-4xl.font-bold {
        font-size: 2rem;
    }
    
    .bg-white.rounded-lg.shadow-lg:hover {
        transform: translateY(-4px) scale(1.01);
    }
}

/* تحسينات للصور */
.relative.h-48 {
    overflow: hidden;
    border-radius: 8px 8px 0 0;
}

/* تحسينات للمعلومات */
.flex.items-center.justify-between {
    border-top: 1px solid #e5e7eb;
    padding-top: 0.75rem;
    margin-top: 0.75rem;
}

/* تحسينات للأزرار */
.flex.space-x-2.space-x-reverse {
    gap: 0.5rem;
}

/* تحسينات للعناوين */
.text-lg.font-semibold {
    color: #1f2937;
    line-height: 1.4;
}

/* تحسينات للوصف */
.text-gray-600.text-sm {
    line-height: 1.5;
    color: #6b7280;
}
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="page-title">مكتبة الصور</h1>
        <p class="text-gray-600 text-lg">استكشف مجموعات الصور المختلفة</p>
    </div>



    @guest
        <!-- رسالة للمستخدمين غير المسجلين -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8 text-center">
            <div class="text-blue-800 mb-4">
                <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
                <h3 class="text-xl font-semibold mb-2">يرجى تسجيل الدخول</h3>
                <p class="text-blue-600">للتمكن من الوصول إلى مكتبة الصور، يرجى تسجيل الدخول أولاً</p>
            </div>
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                    تسجيل الدخول
                </a>
                <a href="{{ route('register') }}" class="inline-block bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition duration-300">
                    إنشاء حساب جديد
                </a>
            </div>
        </div>
    @else
        <!-- أزرار الإدارة للخدام والأدمن -->
        @if(auth()->check())
            <div class="admin-controls mb-8">
                <div class="controls-container">
                    <div class="control-buttons">
                        <a href="{{ route('photo-gallery.create') }}" class="control-btn create-btn" onclick="console.log('Create button clicked')">
                            <div class="btn-icon">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: white;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </div>
                            <div class="btn-content">
                                <span class="btn-title">إنشاء مكتبة جديدة</span>
                                <span class="btn-subtitle">أضف مكتبة صور جديدة</span>
                            </div>
                        </a>
                        
                        @if(auth()->check())
                            <a href="{{ route('photo-gallery.manage') }}" class="control-btn manage-btn" onclick="console.log('Manage button clicked')">
                                <div class="btn-icon">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #FFD700;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <div class="btn-content">
                                    <span class="btn-title">إدارة المكتبات</span>
                                    <span class="btn-subtitle">تحكم في جميع المكتبات</span>
                                </div>
                            </a>
                            
                            <a href="{{ route('photo-gallery.stats') }}" class="control-btn stats-btn" onclick="console.log('Stats button clicked')">
                                <div class="btn-icon">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: white;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                </div>
                                <div class="btn-content">
                                    <span class="btn-title">إحصائيات المكتبات</span>
                                    <span class="btn-subtitle">عرض الإحصائيات والتقارير</span>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- قائمة المكتبات -->
        @if($galleries && $galleries->count() > 0)
            <div class="gallery-masonry">
                @foreach($galleries as $gallery)
                    <div class="gallery-card">
                        <!-- صورة الغلاف -->
                        <div class="gallery-cover">
                            @if($gallery->coverPhoto && $gallery->coverPhoto->thumbnail_url)
                                <img src="{{ $gallery->coverPhoto->thumbnail_url }}" 
                                     alt="{{ $gallery->title }}" 
                                     class="cover-image">
                            @else
                                <!-- صور عشوائية جميلة -->
                                @php
                                    $randomImages = [
                                        'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=300&fit=crop',
                                        'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=400&h=300&fit=crop',
                                        'https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&h=300&fit=crop',
                                        'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=400&h=300&fit=crop',
                                        'https://images.unsplash.com/photo-1521737711867-e3b97375f902?w=400&h=300&fit=crop',
                                        'https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=400&h=300&fit=crop',
                                        'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=400&h=300&fit=crop',
                                        'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=400&h=300&fit=crop'
                                    ];
                                    $randomImage = $randomImages[array_rand($randomImages)];
                                @endphp
                                <img src="{{ $randomImage }}" 
                                     alt="{{ $gallery->title }}" 
                                     class="cover-image">
                            @endif
                            
                            <!-- Overlay مع معلومات سريعة -->
                            <div class="gallery-overlay">
                                <div class="gallery-stats">
                                    <span class="photo-count">{{ $gallery->photos()->count() }} صورة</span>
                                    <span class="gallery-date">{{ $gallery->created_at->format('M Y') }}</span>
                                </div>
                                <div class="gallery-actions">
                                    <a href="{{ route('photo-gallery.show', $gallery->id) }}" class="view-btn">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        عرض الصور
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- معلومات المكتبة -->
                        <div class="gallery-info">
                            <div class="gallery-header">
                                <h3 class="gallery-title">{{ $gallery->title }}</h3>
                                <div class="gallery-badge">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            
                            @if($gallery->description)
                                <p class="gallery-description">{{ $gallery->description }}</p>
                            @endif

                            <div class="gallery-meta">
                                <div class="creator-info">
                                    <div class="creator-avatar">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <span class="creator-name">{{ $gallery->creator->full_name }}</span>
                                </div>
                                <div class="gallery-date-full">{{ $gallery->created_at->format('Y/m/d') }}</div>
                            </div>

                            <!-- أزرار الإجراءات -->
                            <div class="gallery-buttons">
                                @if(auth()->check() && ((auth()->user()->isServant() && $gallery->created_by === auth()->id()) || auth()->user()->isAdmin()))
                                    <div class="flex gap-2 justify-end">
                                        <a href="{{ route('photo-gallery.edit', $gallery->id) }}" class="edit-btn" title="تعديل المكتبة">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        
                                        @if(auth()->check())
                                            <a href="{{ route('photo-gallery.add-photos', $gallery->id) }}" class="edit-btn" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%);" title="إضافة صور">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                            </a>
                                            
                                            <form action="{{ route('photo-gallery.destroy', $gallery->id) }}" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذه المكتبة؟')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="edit-btn" style="background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);" title="حذف المكتبة">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- رسالة عندما لا توجد مكتبات -->
            <div class="text-center py-12">
                <div class="empty-state-card">
                    <div class="empty-icon">
                        <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="empty-title">لا توجد مكتبات صور</h3>
                    <p class="empty-description">لم يتم إنشاء أي مكتبات صور بعد</p>
                    
                    @if(auth()->check())
                        <div class="mt-6">
                            <a href="{{ route('photo-gallery.create') }}" class="empty-action-btn">
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                إنشاء أول مكتبة
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    @endguest
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // التأكد من إن الأزرار شغالة
    const buttons = document.querySelectorAll('.control-btn');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            console.log('Button clicked:', this.href);
        });
    });
    
    // إظهار رسالة تأكيد
    console.log('Photo Gallery page loaded successfully!');
});
</script>
@endsection