@extends('layouts.app')

@section('title', 'إضافة صور - ' . $gallery->title)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/photo-gallery.css') }}">
<style>
.add-photos-container {
    background: linear-gradient(135deg, rgba(10, 42, 79, 0.1) 0%, rgba(30, 58, 138, 0.1) 100%);
    border-radius: 20px;
    padding: 2rem;
    margin-top: 1rem;
}

.add-photos-header {
    text-align: center;
    margin-bottom: 2rem;
}

.add-photos-title {
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 50%, #FFD700 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 2rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.gallery-info-card {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 10px 30px rgba(10, 42, 79, 0.15);
    margin-bottom: 2rem;
    border: 2px solid #FFD700;
}

.gallery-info-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.gallery-avatar {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #0A2A4F 0%, #1e3a8a 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #FFD700;
    font-weight: bold;
    font-size: 1.5rem;
}

.gallery-details h3 {
    font-size: 1.5rem;
    font-weight: bold;
    color: #0A2A4F;
    margin-bottom: 0.25rem;
}

.gallery-details p {
    color: #6b7280;
    font-size: 0.9rem;
}

.gallery-stats {
    display: flex;
    gap: 2rem;
    margin-top: 1rem;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 1.5rem;
    font-weight: bold;
    color: #0A2A4F;
}

.stat-label {
    color: #6b7280;
    font-size: 0.875rem;
}

.upload-section {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(10, 42, 79, 0.15);
    margin-bottom: 2rem;
}

.upload-area {
    border: 3px dashed #FFD700;
    border-radius: 15px;
    padding: 3rem;
    text-align: center;
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.05) 0%, rgba(255, 165, 0, 0.05) 100%);
    transition: all 0.3s ease;
    cursor: pointer;
}

.upload-area:hover {
    border-color: #0A2A4F;
    background: linear-gradient(135deg, rgba(255, 215, 0, 0.1) 0%, rgba(255, 165, 0, 0.1) 100%);
}

.upload-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1rem;
    background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #0A2A4F;
}

.upload-text {
    font-size: 1.2rem;
    font-weight: 600;
    color: #0A2A4F;
    margin-bottom: 0.5rem;
}

.upload-subtext {
    color: #6b7280;
    font-size: 0.9rem;
}

.file-input {
    display: none;
}

.preview-section {
    background: white;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(10, 42, 79, 0.15);
}

.preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.preview-item {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.preview-item:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

.preview-image {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.preview-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.preview-item:hover .preview-overlay {
    opacity: 1;
}

.remove-btn {
    background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%);
    color: white;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.remove-btn:hover {
    transform: scale(1.1);
}

.upload-progress {
    background: white;
    border-radius: 15px;
    padding: 1.5rem;
    box-shadow: 0 10px 30px rgba(10, 42, 79, 0.15);
    margin-bottom: 2rem;
    display: none;
}

.progress-bar {
    width: 100%;
    height: 10px;
    background: #e5e7eb;
    border-radius: 5px;
    overflow: hidden;
    margin-bottom: 1rem;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #FFD700, #FFA500);
    width: 0%;
    transition: width 0.3s ease;
}

.progress-text {
    text-align: center;
    color: #6b7280;
    font-size: 0.9rem;
}

.action-buttons {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 2rem;
}

.btn-primary {
    background: linear-gradient(135deg, #059669 0%, #10b981 100%);
    color: white;
    padding: 0.75rem 2rem;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(5, 150, 105, 0.3);
}

.btn-secondary {
    background: linear-gradient(135deg, #6b7280 0%, #9ca3af 100%);
    color: white;
    padding: 0.75rem 2rem;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(107, 114, 128, 0.3);
}

@media (max-width: 768px) {
    .preview-grid {
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    }
    
    .action-buttons {
        flex-direction: column;
        align-items: center;
    }
}
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="add-photos-container">
        <div class="add-photos-header">
            <h1 class="add-photos-title">إضافة صور لمكتبة</h1>
        </div>

        <!-- معلومات المكتبة -->
        <div class="gallery-info-card">
            <div class="gallery-info-header">
                <div class="gallery-avatar">
                    {{ substr($gallery->title, 0, 1) }}
                </div>
                <div class="gallery-details">
                    <h3>{{ $gallery->title }}</h3>
                    <p>{{ $gallery->description ?? 'لا يوجد وصف' }}</p>
                </div>
            </div>
            
            <div class="gallery-stats">
                <div class="stat-item">
                    <div class="stat-number">{{ $gallery->photos->count() }}</div>
                    <div class="stat-label">عدد الصور الحالية</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $gallery->created_at->format('Y/m/d') }}</div>
                    <div class="stat-label">تاريخ الإنشاء</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $gallery->creator->full_name ?? 'غير محدد' }}</div>
                    <div class="stat-label">المنشئ</div>
                </div>
            </div>
        </div>

        <!-- منطقة رفع الصور -->
        <div class="upload-section">
            <h3 class="text-xl font-bold text-gray-800 mb-4">اختر الصور لإضافتها</h3>
            
            <form action="{{ route('photo-gallery.upload-photos', $gallery->id) }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                @csrf
                
                <div class="upload-area" onclick="document.getElementById('photos').click()">
                    <div class="upload-icon">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                    </div>
                    <div class="upload-text">اضغط لاختيار الصور</div>
                    <div class="upload-subtext">أو اسحب الصور إلى هنا</div>
                    <input type="file" name="photos[]" id="photos" class="file-input" multiple accept="image/*" onchange="previewFiles(this)">
                </div>
                
                <div class="preview-section" id="previewSection" style="display: none;">
                    <h4 class="text-lg font-semibold text-gray-800 mb-4">معاينة الصور المختارة</h4>
                    <div class="preview-grid" id="previewGrid"></div>
                </div>
                
                <div class="upload-progress" id="uploadProgress">
                    <div class="progress-bar">
                        <div class="progress-fill" id="progressFill"></div>
                    </div>
                    <div class="progress-text" id="progressText">جاري الرفع...</div>
                </div>
                
                <div class="action-buttons">
                    <button type="submit" class="btn-primary" id="uploadBtn" style="display: none;">
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        رفع الصور
                    </button>
                    
                    <a href="{{ route('photo-gallery.show', $gallery->id) }}" class="btn-secondary">
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        العودة إلى المكتبة
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let selectedFiles = [];

function previewFiles(input) {
    const files = input.files;
    const previewSection = document.getElementById('previewSection');
    const previewGrid = document.getElementById('previewGrid');
    const uploadBtn = document.getElementById('uploadBtn');
    
    if (files.length > 0) {
        selectedFiles = Array.from(files);
        previewSection.style.display = 'block';
        uploadBtn.style.display = 'inline-flex';
        previewGrid.innerHTML = '';
        
        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewItem = document.createElement('div');
                previewItem.className = 'preview-item';
                previewItem.innerHTML = `
                    <img src="${e.target.result}" alt="Preview" class="preview-image">
                    <div class="preview-overlay">
                        <button type="button" class="remove-btn" onclick="removeFile(${index})">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                `;
                previewGrid.appendChild(previewItem);
            };
            reader.readAsDataURL(file);
        });
    } else {
        previewSection.style.display = 'none';
        uploadBtn.style.display = 'none';
        selectedFiles = [];
    }
}

function removeFile(index) {
    selectedFiles.splice(index, 1);
    const input = document.getElementById('photos');
    const dt = new DataTransfer();
    
    selectedFiles.forEach(file => {
        dt.items.add(file);
    });
    
    input.files = dt.files;
    previewFiles(input);
}

// Drag and drop functionality
const uploadArea = document.querySelector('.upload-area');

uploadArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    uploadArea.style.borderColor = '#0A2A4F';
    uploadArea.style.background = 'linear-gradient(135deg, rgba(255, 215, 0, 0.1) 0%, rgba(255, 165, 0, 0.1) 100%)';
});

uploadArea.addEventListener('dragleave', (e) => {
    e.preventDefault();
    uploadArea.style.borderColor = '#FFD700';
    uploadArea.style.background = 'linear-gradient(135deg, rgba(255, 215, 0, 0.05) 0%, rgba(255, 165, 0, 0.05) 100%)';
});

uploadArea.addEventListener('drop', (e) => {
    e.preventDefault();
    uploadArea.style.borderColor = '#FFD700';
    uploadArea.style.background = 'linear-gradient(135deg, rgba(255, 215, 0, 0.05) 0%, rgba(255, 165, 0, 0.05) 100%)';
    
    const files = e.dataTransfer.files;
    const input = document.getElementById('photos');
    input.files = files;
    previewFiles(input);
});

// Form submission with progress
document.getElementById('uploadForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const progressBar = document.getElementById('progressFill');
    const progressText = document.getElementById('progressText');
    const uploadProgress = document.getElementById('uploadProgress');
    const uploadBtn = document.getElementById('uploadBtn');
    
    uploadProgress.style.display = 'block';
    uploadBtn.disabled = true;
    
    fetch(this.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            progressBar.style.width = '100%';
            progressText.textContent = 'تم رفع الصور بنجاح!';
            setTimeout(() => {
                window.location.href = data.redirect_url;
            }, 1500);
        } else {
            progressText.textContent = 'حدث خطأ أثناء رفع الصور';
        }
    })
    .catch(error => {
        progressText.textContent = 'حدث خطأ أثناء رفع الصور';
        console.error('Error:', error);
    });
});
</script>
@endsection 