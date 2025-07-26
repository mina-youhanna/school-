@extends('layouts.app')

@section('title', 'تعديل مكتبة الصور - ' . $gallery->title)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/photo-gallery.css') }}">
<style>
/* Photo Gallery Edit Custom Styles - Inline CSS for better compatibility */

/* تحسينات عامة للنموذج */
.bg-white.rounded-lg.shadow-lg {
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 3px solid #0A2A4F;
    background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
    border-radius: 25px;
    box-shadow: 0 15px 40px rgba(10, 42, 79, 0.2);
    position: relative;
    overflow: hidden;
}

.bg-white.rounded-lg.shadow-lg::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, #FFD700, #FFA500, #FFD700);
    background-size: 200% 100%;
    animation: shimmer 2.5s infinite;
}

@keyframes shimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
}

.bg-white.rounded-lg.shadow-lg:hover {
    box-shadow: 0 25px 50px rgba(10, 42, 79, 0.3);
    border-color: #FFD700;
    transform: translateY(-5px);
}

.bg-white.rounded-lg.shadow-lg:hover::before {
    background: linear-gradient(90deg, #FFD700, #FFA500, #FFD700);
    animation: shimmer 1.5s infinite;
}

/* تحسينات للعناوين */
.text-3xl.font-bold {
    background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* تحسينات للحقول */
input, textarea {
    transition: all 0.3s ease;
    border: 2px solid #e5e7eb;
}

input:focus, textarea:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    transform: translateY(-1px);
}

/* تحسينات للحقول المقروءة فقط */
input[readonly] {
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    border-color: #cbd5e1;
    color: #64748b;
}

/* تحسينات للـ Checkbox */
input[type="checkbox"] {
    transition: all 0.3s ease;
    transform: scale(1.1);
}

input[type="checkbox"]:checked {
    background-color: #3b82f6;
    border-color: #3b82f6;
}

/* تحسينات للأزرار */
.bg-gray-600, .bg-yellow-600, .bg-red-600 {
    transition: all 0.4s ease;
    font-weight: 700;
    letter-spacing: 1px;
    border: 3px solid transparent;
    border-radius: 15px;
    position: relative;
    overflow: hidden;
    text-transform: uppercase;
    font-size: 0.9rem;
}

.bg-gray-600 {
    background: linear-gradient(135deg, #374151 0%, #6b7280 100%);
    border-color: #FFD700;
}

.bg-yellow-600 {
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    color: #0A2A4F;
    border-color: #0A2A4F;
}

.bg-red-600 {
    background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
    border-color: #FFD700;
}

.bg-gray-600::before, .bg-yellow-600::before, .bg-red-600::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.3), transparent);
    transition: left 0.6s;
}

.bg-gray-600:hover, .bg-yellow-600:hover, .bg-red-600:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 15px 30px rgba(10, 42, 79, 0.4);
    border-color: #FFD700;
}

.bg-gray-600:hover::before, .bg-yellow-600:hover::before, .bg-red-600:hover::before {
    left: 100%;
}

/* تحسينات للعناوين الفرعية */
.text-gray-600 {
    color: #FFD700;
    font-weight: 600;
    text-shadow: 0 2px 4px rgba(255, 215, 0, 0.3);
    font-size: 1.1rem;
    letter-spacing: 1px;
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

/* تحسينات للـ Labels */
label {
    font-weight: 600;
    color: #374151;
    transition: color 0.3s ease;
}

label:hover {
    color: #3b82f6;
}

/* تحسينات للرسائل */
.text-red-500 {
    background: rgba(239, 68, 68, 0.1);
    padding: 0.5rem;
    border-radius: 0.375rem;
    border-left: 3px solid #ef4444;
}

/* تحسينات للوصف */
.text-xs.text-gray-500 {
    background: rgba(107, 114, 128, 0.1);
    padding: 0.5rem;
    border-radius: 0.375rem;
    border-left: 3px solid #6b7280;
}

/* تحسينات للـ Border */
.border-t.border-gray-200 {
    border-top: 2px solid #e5e7eb;
}

/* تحسينات للـ Max Width */
.max-w-2xl {
    animation: fadeInUp 0.4s ease-out;
}

/* تحسينات للعرض المتجاوب */
@media (max-width: 768px) {
    .text-3xl.font-bold {
        font-size: 2rem;
    }
    
    .bg-white.rounded-lg.shadow-lg {
        margin: 0 1rem;
    }
}

/* تحسينات للـ Focus States */
input:focus, textarea:focus {
    outline: none;
}

/* تحسينات للـ Placeholder */
input::placeholder, textarea::placeholder {
    color: #9ca3af;
    transition: color 0.3s ease;
}

input:focus::placeholder, textarea:focus::placeholder {
    color: #6b7280;
}

/* تحسينات للمعلومات الإضافية */
.bg-gray-50 {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
}

.bg-gray-50 h3 {
    color: #374151;
    font-weight: 600;
    border-bottom: 2px solid #e5e7eb;
    padding-bottom: 0.5rem;
    margin-bottom: 1rem;
}

/* تحسينات للـ Grid في المعلومات */
.bg-gray-50 .grid {
    gap: 1rem;
}

.bg-gray-50 .grid > div {
    padding: 0.75rem;
    background: rgba(255, 255, 255, 0.5);
    border-radius: 0.375rem;
    border: 1px solid rgba(229, 231, 235, 0.5);
}

/* تحسينات للـ Font Weight */
.font-semibold {
    color: #1f2937;
}

/* تحسينات للـ Space */
.space-y-6 > * + * {
    margin-top: 1.5rem;
}

/* تحسينات للـ Padding */
.p-6 {
    padding: 2rem;
}

/* تحسينات للـ Margin */
.mb-8 {
    margin-bottom: 2rem;
}

/* تحسينات للـ Flex */
.flex.items-center.justify-between {
    gap: 1rem;
}

.flex.space-x-4.space-x-reverse {
    gap: 1rem;
}

/* تحسينات للـ Button Groups */
.flex.space-x-4.space-x-reverse > * {
    flex: 1;
    max-width: 150px;
}

/* تحسينات للـ Checkbox Container */
.flex.items-center {
    padding: 0.75rem;
    background: rgba(59, 130, 246, 0.05);
    border-radius: 0.5rem;
    border: 1px solid rgba(59, 130, 246, 0.1);
    transition: all 0.3s ease;
}

.flex.items-center:hover {
    background: rgba(59, 130, 246, 0.1);
    border-color: rgba(59, 130, 246, 0.2);
}

/* تحسينات للـ Text */
.text-sm.font-medium {
    color: #374151;
    font-weight: 600;
}

/* تحسينات للـ Readonly Field */
input[readonly] {
    cursor: not-allowed;
    opacity: 0.8;
}

/* تحسينات للـ Hover Effects */
.bg-gray-50:hover {
    background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
    border-color: #cbd5e1;
}

/* تحسينات للـ Animation */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
}

.bg-gray-50 .grid > div:hover {
    animation: pulse 1s ease-in-out;
    background: rgba(255, 255, 255, 0.8);
}
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">تعديل مكتبة الصور</h1>
            <p class="text-gray-600">قم بتعديل معلومات المكتبة</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <form action="{{ route('photo-gallery.update', $gallery->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <!-- عنوان المكتبة -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        عنوان المكتبة <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" 
                           value="{{ old('title', $gallery->title) }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="مثال: مؤتمر الخدام 2025" required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- وصف المكتبة -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        وصف المكتبة
                    </label>
                    <textarea name="description" id="description" rows="3" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                              placeholder="وصف مختصر عن محتوى المكتبة">{{ old('description', $gallery->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- اسم المجلد (للقراءة فقط) -->
                <div>
                    <label for="folder_name" class="block text-sm font-medium text-gray-700 mb-2">
                        اسم المجلد
                    </label>
                    <input type="text" value="{{ $gallery->folder_name }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" 
                           readonly>
                    <p class="text-xs text-gray-500 mt-1">
                        لا يمكن تغيير اسم المجلد بعد الإنشاء
                    </p>
                </div>

                <!-- حالة المكتبة -->
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" 
                               {{ old('is_active', $gallery->is_active) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="mr-2 text-sm font-medium text-gray-700">مكتبة نشطة</span>
                    </label>
                    <p class="text-xs text-gray-500 mt-1">
                        المكتبات غير النشطة لن تظهر للمستخدمين العاديين
                    </p>
                </div>

                <!-- معلومات إضافية -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-700 mb-3">معلومات المكتبة</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
                        <div>
                            <span class="font-semibold">المنشئ:</span> {{ $gallery->creator->full_name }}
                        </div>
                        <div>
                            <span class="font-semibold">تاريخ الإنشاء:</span> {{ $gallery->created_at->format('Y/m/d H:i') }}
                        </div>
                        <div>
                            <span class="font-semibold">عدد الصور:</span> {{ $gallery->photos->count() }}
                        </div>
                        <div>
                            <span class="font-semibold">آخر تحديث:</span> {{ $gallery->updated_at->format('Y/m/d H:i') }}
                        </div>
                    </div>
                </div>

                <!-- أزرار الإجراءات -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <div class="flex space-x-4 space-x-reverse">
                        <a href="{{ route('photo-gallery.show', $gallery->id) }}" 
                           class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">
                            إلغاء
                        </a>
                        <button type="button" onclick="deleteGallery()" 
                                class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition duration-300">
                            حذف المكتبة
                        </button>
                    </div>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-8 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                        حفظ التغييرات
                    </button>
                </div>
            </form>
        </div>

        <!-- رابط إدارة الصور -->
        <div class="mt-8 text-center">
            <a href="{{ route('photo-gallery.show', $gallery->id) }}" 
               class="inline-flex items-center bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition duration-300">
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                إدارة الصور
            </a>
        </div>
    </div>
</div>

<script>
function deleteGallery() {
    if (confirm('هل أنت متأكد من حذف هذه المكتبة؟ سيتم حذف جميع الصور الموجودة فيها نهائياً.')) {
        // إنشاء form للحذف
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("photo-gallery.destroy", $gallery->id) }}';
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection 