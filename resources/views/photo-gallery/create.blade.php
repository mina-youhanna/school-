@extends('layouts.app')

@section('title', 'إنشاء مكتبة صور جديدة')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/photo-gallery.css') }}">
<style>
/* Photo Gallery Create Custom Styles - Inline CSS for better compatibility */

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

/* تحسينات لمنطقة رفع الملفات */
.border-2.border-dashed {
    transition: all 0.4s ease;
    background: linear-gradient(135deg, #0A2A4F 0%, #1e3a8a 100%);
    border: 3px dashed #FFD700;
    border-radius: 20px;
    color: white;
    position: relative;
    overflow: hidden;
}

.border-2.border-dashed::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(255, 215, 0, 0.1) 50%, transparent 70%);
    background-size: 200% 200%;
    animation: shimmer 3s infinite;
}

@keyframes shimmer {
    0% { background-position: -200% -200%; }
    100% { background-position: 200% 200%; }
}

.border-2.border-dashed:hover {
    border-color: #FFA500;
    background: linear-gradient(135deg, #1e3a8a 0%, #0A2A4F 100%);
    transform: translateY(-5px) scale(1.02);
    box-shadow: 0 20px 40px rgba(255, 215, 0, 0.3);
}

.border-2.border-dashed:hover::before {
    animation: shimmer 1.5s infinite;
}

/* تحسينات للأيقونات */
svg {
    transition: transform 0.3s ease;
}

.border-2.border-dashed:hover svg {
    transform: scale(1.1);
    color: #3b82f6;
}

/* تحسينات للأزرار */
.bg-gray-600, .bg-green-600 {
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

.bg-green-600 {
    background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    border-color: #FFD700;
}

.bg-gray-600::before, .bg-green-600::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.3), transparent);
    transition: left 0.6s;
}

.bg-gray-600:hover, .bg-green-600:hover {
    transform: translateY(-5px) scale(1.05);
    box-shadow: 0 15px 30px rgba(10, 42, 79, 0.4);
    border-color: #FFD700;
}

.bg-gray-600:hover::before, .bg-green-600:hover::before {
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

/* تحسينات للـ Cursor */
.cursor-pointer {
    transition: all 0.3s ease;
}

.cursor-pointer:hover {
    transform: scale(1.02);
}

/* تحسينات للـ Text */
.text-lg.font-medium {
    color: #374151;
    font-weight: 600;
}

.text-sm.text-gray-500 {
    line-height: 1.5;
}

/* تحسينات للـ SVG في منطقة الرفع */
.border-2.border-dashed svg {
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
}

/* تحسينات للـ Hover Effects */
.border-2.border-dashed:hover p {
    color: #3b82f6;
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

/* تحسينات للـ Button Groups */
.flex.items-center.justify-between > * {
    flex: 1;
    max-width: 200px;
}
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-4">إنشاء مكتبة صور جديدة</h1>
            <p class="text-gray-600">قم بإنشاء مكتبة جديدة ورفع الصور الخاصة بها</p>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <form action="{{ route('photo-gallery.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- عنوان المكتبة -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        عنوان المكتبة <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" id="title" 
                           value="{{ old('title') }}" 
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
                              placeholder="وصف مختصر عن محتوى المكتبة">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- اسم المجلد -->
                <div>
                    <label for="folder_name" class="block text-sm font-medium text-gray-700 mb-2">
                        اسم المجلد <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="folder_name" id="folder_name" 
                           value="{{ old('folder_name') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="مثال: conference-2025" required>
                    <p class="text-xs text-gray-500 mt-1">
                        استخدم أحرف إنجليزية وأرقام وشرطة فقط. مثال: conference-2025
                    </p>
                    @error('folder_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- رفع الصور -->
                <div>
                    <label for="photos" class="block text-sm font-medium text-gray-700 mb-2">
                        الصور <span class="text-red-500">*</span>
                    </label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition duration-300">
                        <input type="file" name="photos[]" id="photos" multiple accept="image/*" 
                               class="hidden" required>
                        <label for="photos" class="cursor-pointer">
                            <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            <p class="text-lg font-medium text-gray-700 mb-2">اختر الصور</p>
                            <p class="text-sm text-gray-500">اضغط هنا لاختيار الصور أو اسحبها إلى هنا</p>
                            <p class="text-xs text-gray-400 mt-2">الحد الأقصى: 10MB لكل صورة</p>
                        </label>
                    </div>
                    
                    <!-- Preview للصور المختارة -->
                    <div id="photo-preview" class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-4 hidden">
                        <!-- سيتم ملء هذا القسم بالصور المختارة -->
                    </div>
                    
                    @error('photos.*')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- أزرار الإجراءات -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <a href="{{ route('photo-gallery.index') }}" 
                       class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">
                        إلغاء
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-8 py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                        إنشاء المكتبة
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Preview للصور المختارة
document.getElementById('photos').addEventListener('change', function(e) {
    const preview = document.getElementById('photo-preview');
    preview.innerHTML = '';
    
    if (e.target.files.length > 0) {
        preview.classList.remove('hidden');
        
        Array.from(e.target.files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const div = document.createElement('div');
                div.className = 'relative bg-gray-100 rounded-lg p-2';
                div.innerHTML = `
                    <img src="${e.target.result}" alt="${file.name}" class="w-full h-24 object-cover rounded">
                    <p class="text-xs text-gray-600 mt-1 truncate" title="${file.name}">${file.name}</p>
                    <p class="text-xs text-gray-500">${(file.size / 1024 / 1024).toFixed(2)} MB</p>
                `;
                preview.appendChild(div);
            };
            reader.readAsDataURL(file);
        });
    } else {
        preview.classList.add('hidden');
    }
});

// Drag and Drop
const dropZone = document.querySelector('.border-dashed');
const fileInput = document.getElementById('photos');

dropZone.addEventListener('dragover', function(e) {
    e.preventDefault();
    dropZone.classList.add('border-blue-400', 'bg-blue-50');
});

dropZone.addEventListener('dragleave', function(e) {
    e.preventDefault();
    dropZone.classList.remove('border-blue-400', 'bg-blue-50');
});

dropZone.addEventListener('drop', function(e) {
    e.preventDefault();
    dropZone.classList.remove('border-blue-400', 'bg-blue-50');
    
    const files = e.dataTransfer.files;
    fileInput.files = files;
    
    // Trigger change event
    const event = new Event('change');
    fileInput.dispatchEvent(event);
});
</script>
@endsection 