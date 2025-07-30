@extends('layouts.app')

@section('title', 'إضافة فصل جديد')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-gradient-primary text-white">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        إضافة فصل دراسي جديد
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.classes.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">
                                        <i class="fas fa-graduation-cap me-1"></i>
                                        اسم الفصل
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           id="name" 
                                           name="name" 
                                           value="{{ old('name') }}" 
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="stage" class="form-label">
                                        <i class="fas fa-layer-group me-1"></i>
                                        المرحلة
                                    </label>
                                    <select class="form-select @error('stage') is-invalid @enderror" 
                                            id="stage" 
                                            name="stage" 
                                            required>
                                        <option value="">اختر المرحلة</option>
                                        <option value="تمهيدي 1" {{ old('stage') == 'تمهيدي 1' ? 'selected' : '' }}>تمهيدي 1 </option>
                                        <option value="تمهيدي 2" {{ old('stage') == 'تمهيدي 2' ? 'selected' : '' }}>تمهيدي 2 </option>
                                        <option value="A1" {{ old('stage') == 'A1' ? 'selected' : '' }}>A1 </option>
                                        <option value="A2" {{ old('stage') == 'A2' ? 'selected' : '' }}>A2</option>
                                        <option value="A3" {{ old('stage') == 'A3' ? 'selected' : '' }}>A3</option>
                                        <option value="B1" {{ old('stage') == 'B1' ? 'selected' : '' }}>B1 </option>
                                        <option value="B2" {{ old('stage') == 'B2' ? 'selected' : '' }}>B2 </option>
                                        <option value="B3" {{ old('stage') == 'B3' ? 'selected' : '' }}>B3 </option>
                                        <option value="C1" {{ old('stage') == 'C1' ? 'selected' : '' }}>C1 </option>
                                        <option value="C2" {{ old('stage') == 'C2' ? 'selected' : '' }}>C2 </option>
                                        <option value="C3" {{ old('stage') == 'C3' ? 'selected' : '' }}>C3 </option>
                                        <option value="خدام" {{ old('stage') == 'خدام' ? 'selected' : '' }}>خدام </option>
                                        <option value="خاص" {{ old('stage') == 'خاص' ? 'selected' : '' }}>خاص </option>
                                    </select>
                                    @error('stage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="schedule" class="form-label">
                                        <i class="fas fa-calendar-alt me-1"></i>
                                        الجدول الزمني
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('schedule') is-invalid @enderror" 
                                           id="schedule" 
                                           name="schedule" 
                                           value="{{ old('schedule') }}" 
                                           placeholder="مثال: الجمعة - 11:00 إلى 12:30"
                                           required>
                                    @error('schedule')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="place" class="form-label">
                                        <i class="fas fa-map-marker-alt me-1"></i>
                                        مكان الفصل
                                    </label>
                                    <input type="text" 
                                           class="form-control @error('place') is-invalid @enderror" 
                                           id="place" 
                                           name="place" 
                                           value="{{ old('place') }}" 
                                           placeholder="مثال: فصل 2 - الدور 6"
                                           required>
                                    @error('place')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">
                                        <i class="fas fa-venus-mars me-1"></i>
                                        النوع
                                    </label>
                                    <select class="form-select @error('gender') is-invalid @enderror" 
                                            id="gender" 
                                            name="gender" 
                                            required>
                                        <option value="">اختر النوع</option>
                                        <option value="ذكر" {{ old('gender') == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                                        <option value="أنثى" {{ old('gender') == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                                        <option value="مختلط" {{ old('gender') == 'مختلط' ? 'selected' : '' }}>مختلط</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="main_servant_email" class="form-label">
                                        <i class="fas fa-user-tie me-1"></i>
                                        الخادم الرئيسي
                                    </label>
                                    <select class="form-select @error('main_servant_email') is-invalid @enderror" 
                                            id="main_servant_email" 
                                            name="main_servant_email" 
                                            required>
                                        <option value="">اختر الخادم الرئيسي</option>
                                        @foreach($servants as $servant)
                                            <option value="{{ $servant->email }}" 
                                                    {{ old('main_servant_email') == $servant->email ? 'selected' : '' }}>
                                                {{ $servant->full_name }} ({{ $servant->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('main_servant_email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="assistant_servants_emails" class="form-label">
                                <i class="fas fa-users me-1"></i>
                                الخدام المساعدين (اختياري)
                            </label>
                            <div class="selected-servants-container mb-2">
                                <div id="selected-servants" class="d-flex flex-wrap gap-2"></div>
                            </div>
                            <div class="servants-grid mb-2">
                                @foreach($servants as $servant)
                                    <div class="servant-item" 
                                         data-email="{{ $servant->email }}" 
                                         data-name="{{ $servant->full_name }}">
                                        <div class="servant-card">
                                            <div class="servant-info">
                                                <strong>{{ $servant->full_name }}</strong>
                                                <small>{{ $servant->email }}</small>
                                            </div>
                                            <button type="button" class="btn-add-servant" onclick="toggleServant('{{ $servant->email }}', '{{ $servant->full_name }}')">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" id="assistant_servants_emails" name="assistant_servants_emails" value="{{ old('assistant_servants_emails', '[]') }}">
                            <div class="form-text">اضغط على أي خادم لإضافته كمساعد. سيظهر كعلامة يمكن إزالتها</div>
                            @error('assistant_servants_emails')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-image me-1"></i>
                                صورة القديس <span class="text-danger">*</span>
                            </label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="saint_image_file" class="form-label">
                                            <i class="fas fa-upload me-1"></i>
                                            رفع صورة من الجهاز
                                        </label>
                                        <input type="file" 
                                               class="form-control @error('saint_image_file') is-invalid @enderror" 
                                               id="saint_image_file" 
                                               name="saint_image_file" 
                                               accept="image/*">
                                        @error('saint_image_file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="saint_image_url" class="form-label">
                                            <i class="fas fa-link me-1"></i>
                                            أو رابط صورة من الإنترنت
                                        </label>
                                        <input type="url" 
                                               class="form-control @error('saint_image_url') is-invalid @enderror" 
                                               id="saint_image_url" 
                                               name="saint_image_url" 
                                               value="{{ old('saint_image_url') }}" 
                                               placeholder="https://example.com/image.jpg">
                                        @error('saint_image_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-text">يجب اختيار إما رفع صورة من الجهاز أو إدخال رابط صورة من الإنترنت</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.classes.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i>
                                رجوع
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                حفظ الفصل
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #0A2A4F 0%, #1a4a8a 100%);
}

.card {
    border: none;
    border-radius: 15px;
    background-color: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
}

.card-header {
    border-radius: 15px 15px 0 0 !important;
}

.form-control, .form-select {
    border-radius: 8px;
    border: 2px solid #e9ecef;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    background-color: rgba(255, 255, 255, 0.9);
}

.form-control:focus, .form-select:focus {
    border-color: #0A2A4F;
    box-shadow: 0 0 0 0.2rem rgba(10, 42, 79, 0.25);
    background-color: white;
}

.btn {
    border-radius: 8px;
    padding: 10px 20px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #0A2A4F;
    border-color: #0A2A4F;
}

.btn-primary:hover {
    background-color: #1a4a8a;
    border-color: #1a4a8a;
    transform: translateY(-2px);
}

.btn-secondary {
    background-color: #6c757d;
    border-color: #6c757d;
}

.btn-secondary:hover {
    background-color: #5a6268;
    border-color: #545b62;
    transform: translateY(-2px);
}

.selected-servant-tag {
    background-color: #0A2A4F;
    color: white;
    padding: 5px 10px;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.9rem;
}

.remove-servant {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 1.2rem;
    padding: 0;
    margin-left: 5px;
}

.remove-servant:hover {
    color: #ff6b6b;
}

.form-label {
    color: #0A2A4F;
    font-weight: 600;
}

.form-text {
    color: #6c757d;
    font-size: 0.875rem;
}

.servants-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 10px;
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    padding: 10px;
}

.servant-card {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border: 1px solid #e9ecef;
    border-radius: 6px;
    background-color: #f8f9fa;
    transition: all 0.3s ease;
}

.servant-card:hover {
    background-color: #e9ecef;
    transform: translateY(-2px);
}

.servant-card.selected {
    background-color: #0A2A4F;
    color: white;
    border-color: #0A2A4F;
}

.servant-info {
    flex: 1;
}

.servant-info strong {
    display: block;
    font-size: 0.9rem;
}

.servant-info small {
    color: #6c757d;
    font-size: 0.8rem;
}

.servant-card.selected .servant-info small {
    color: #ccc;
}

.btn-add-servant {
    background: none;
    border: none;
    color: #0A2A4F;
    font-size: 1.2rem;
    cursor: pointer;
    padding: 5px;
    border-radius: 4px;
    transition: all 0.3s ease;
}

.btn-add-servant:hover {
    background-color: #0A2A4F;
    color: white;
}

.servant-card.selected .btn-add-servant {
    color: white;
}

.servant-card.selected .btn-add-servant:hover {
    background-color: #ff6b6b;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hiddenInput = document.getElementById('assistant_servants_emails');
    const selectedContainer = document.getElementById('selected-servants');
    const selectedServants = new Set();

    // تحميل الخدام المحددين مسبقاً
    try {
        const oldValue = hiddenInput.value;
        if (oldValue && oldValue !== '[]') {
            const servants = JSON.parse(oldValue);
            servants.forEach(servant => {
                addServantTag(servant.email, servant.name);
            });
        }
    } catch (e) {
        console.log('لا توجد بيانات سابقة');
    }

    // دالة إضافة خادم كعلامة
    function addServantTag(email, name) {
        if (selectedServants.has(email)) return;
        
        selectedServants.add(email);
        
        const tag = document.createElement('div');
        tag.className = 'selected-servant-tag';
        tag.innerHTML = `
            <span>${name}</span>
            <button type="button" class="remove-servant" onclick="removeServant('${email}')">
                <i class="fas fa-times"></i>
            </button>
        `;
        selectedContainer.appendChild(tag);
        
        // تحديث الحقل المخفي
        updateHiddenInput();
    }

    // دالة إزالة خادم من القائمة
    window.removeServant = function(email) {
        selectedServants.delete(email);
        
        // إزالة العلامة
        const tags = selectedContainer.querySelectorAll('.selected-servant-tag');
        tags.forEach(tag => {
            const name = tag.querySelector('span').textContent;
            const servantElement = document.querySelector(`[data-email="${email}"]`);
            if (servantElement && servantElement.dataset.name === name) {
                tag.remove();
            }
        });
        
        // تحديث الحقل المخفي
        updateHiddenInput();
    };

    // دالة تبديل حالة الخادم
    window.toggleServant = function(email, name) {
        const servantCard = document.querySelector(`[data-email="${email}"] .servant-card`);
        
        if (selectedServants.has(email)) {
            // إزالة الخادم
            selectedServants.delete(email);
            servantCard.classList.remove('selected');
            servantCard.querySelector('.btn-add-servant i').className = 'fas fa-plus';
            
            // إزالة العلامة
            const tags = selectedContainer.querySelectorAll('.selected-servant-tag');
            tags.forEach(tag => {
                const tagName = tag.querySelector('span').textContent;
                if (tagName === name) {
                    tag.remove();
                }
            });
        } else {
            // إضافة الخادم
            addServantTag(email, name);
            servantCard.classList.add('selected');
            servantCard.querySelector('.btn-add-servant i').className = 'fas fa-check';
        }
        
        // تحديث الحقل المخفي
        updateHiddenInput();
    };

    // استبعاد الخادم الأساسي من قائمة الخدام المساعدين
    const mainServantSelect = document.getElementById('main_servant_email');
    mainServantSelect.addEventListener('change', function() {
        const selectedMainServant = this.value;
        
        // إخفاء الخادم الأساسي من قائمة الخدام المساعدين
        const servantItems = document.querySelectorAll('.servant-item');
        servantItems.forEach(item => {
            const email = item.dataset.email;
            if (email === selectedMainServant) {
                item.style.display = 'none';
                // إزالة الخادم من القائمة المحددة إذا كان موجوداً
                if (selectedServants.has(email)) {
                    removeServant(email);
                    const servantCard = item.querySelector('.servant-card');
                    servantCard.classList.remove('selected');
                    servantCard.querySelector('.btn-add-servant i').className = 'fas fa-plus';
                }
            } else {
                item.style.display = 'block';
            }
        });
    });

    // دالة تحديث الحقل المخفي
    function updateHiddenInput() {
        const servantsArray = Array.from(selectedServants).map(email => {
            const name = document.querySelector(`[data-email="${email}"]`).dataset.name;
            return { email, name };
        });
        hiddenInput.value = JSON.stringify(servantsArray);
    }

    // التحقق من الصورة
    const form = document.querySelector('form');
    const fileInput = document.getElementById('saint_image_file');
    const urlInput = document.getElementById('saint_image_url');

    form.addEventListener('submit', function(e) {
        const hasFile = fileInput.files.length > 0;
        const hasUrl = urlInput.value.trim() !== '';

        if (!hasFile && !hasUrl) {
            e.preventDefault();
            alert('يجب إدخال صورة القديس إما برفع ملف أو إدخال رابط');
            return;
        }

        if (hasFile && hasUrl) {
            e.preventDefault();
            alert('يجب اختيار إما رفع ملف أو إدخال رابط، وليس كلاهما');
            return;
        }
    });
});
</script>
@endsection 