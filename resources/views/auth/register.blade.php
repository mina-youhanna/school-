@extends('layouts.app')

@section('title', 'إنشاء حساب جديد')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="header-image">
    <img src="{{ asset('images/snapedit_1751805472563.png') }}" alt="صورة مقدسة">
</div>
<div class="register-container-box">
    <h2 class="register-title">إنشاء حساب جديد</h2>
    <div id="errorMessages" class="center-message error-message" style="display: none;"></div>
    @if(session('success'))
        <div class="center-message success-message" style="margin: 30px auto; font-size: 22px;">
            🎉 {{ session('success') }} 🎉<br>
            مرحبًا بك في عائلتنا!
        </div>
    @endif
    @if ($errors->has('email'))
        <span class="field-error">{{ $errors->first('email') }}</span>
    @endif
    @if ($errors->has('full_name'))
        <span class="field-error">{{ $errors->first('full_name') }}</span>
    @endif
    <form id="signupForm" action="{{ route('register') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="profile-image-upload">
            <div class="image-preview" id="imagePreviewContainer">
                <input type="file" id="profileImage" name="profile_image" accept="image/*" style="display:none;" required>
                <label for="profileImage" class="upload-btn">
                    <i class="plus-icon">+</i>
                </label>
                <img id="imagePreview" src="" alt="" style="display:none;">
            </div>
            <p class="upload-text">صورة شخصية <span class="required">*</span></p>
        </div>
        <label for="fullName">👤 الاسم الرباعي <span class="required">*</span></label>
        <input type="text" id="fullName" name="full_name" required>
        @if ($errors->has('full_name'))
            <span class="field-error">{{ $errors->first('full_name') }}</span>
        @endif
        <label for="phone">📞 رقم الهاتف</label>
        <input type="tel" id="phone" name="phone" pattern="[0-9]{11}" title="الرجاء إدخال رقم هاتف صحيح مكون من 11 رقم">
        <label for="whatsapp">📱 رقم الواتساب <span class="required">*</span></label>
        <input type="tel" id="whatsapp" name="whatsapp" required pattern="[0-9]{11}" title="الرجاء إدخال رقم واتساب صحيح مكون من 11 رقم">
        <label for="relativePhone">☎️ رقم أحد الأقارب <span class="required">*</span></label>
        <input type="tel" id="relativePhone" name="relative_phone" required pattern="[0-9]{11}" title="الرجاء إدخال رقم هاتف صحيح مكون من 11 رقم">
        <label for="address">📍 العنوان <span class="required">*</span></label>
        <input type="text" id="address" name="address" required>
        <label for="confessionFather">⛪ اسم أب الاعتراف <span class="required">*</span></label>
        <input type="text" id="confessionFather" name="confession_father" required>
        <label for="email">📧 البريد الإلكتروني <span class="required">*</span></label>
        <input type="email" id="email" name="email" required>
        @if ($errors->has('email'))
            <span class="field-error">{{ $errors->first('email') }}</span>
        @endif
        <label for="dob">📅 تاريخ الميلاد <span class="required">*</span></label>
        <input type="date" id="dob" name="dob" required>
        <input type="hidden" id="age" name="age">
        <div class="radio-group">
            <label>⚤ النوع <span class="required">*</span></label>
            <div class="radio-options">
                <div class="radio-option">
                    <input type="radio" id="male" name="gender" value="ذكر" required>
                    <label for="male">ذكر ♂️</label>
                </div>
                <div class="radio-option">
                    <input type="radio" id="female" name="gender" value="أنثى">
                    <label for="female">أنثى ♀️</label>
                </div>
            </div>
        </div>
        <div class="radio-group">
            <label>🔹 الدور <span class="required">*</span></label>
            <div class="radio-options">
                <div class="radio-option">
                    <input type="radio" id="servant" name="role" value="خادم" required>
                    <label for="servant">خادم</label>
                </div>
                <div class="radio-option">
                    <input type="radio" id="served" name="role" value="مخدوم">
                    <label for="served">مخدوم</label>
                </div>
            </div>
        </div>
        <div id="servantFields" style="display: none;">
            <label for="servingClasses">📚 الفصول التي أخدم فيها <span class="required">*</span></label>
            <div class="multiselect-container">
                <select id="servingClasses" name="serving_classes[]" multiple class="select2-multi"></select>
            </div>
        </div>
        <label for="myClass">📚 الفصل الذي أنا طالب فيه <span class="required">*</span></label>
        <select id="myClass" name="my_class_id" required>
            <option value="">-- اختر الفصل --</option>
        </select>
        <div class="radio-group">
            <label>🕊️ هل أنت شماس؟ <span class="required">*</span></label>
            <div class="radio-options">
                <div class="radio-option">
                    <input type="radio" id="deacon-yes" name="is_deacon" value="نعم" required>
                    <label for="deacon-yes">نعم</label>
                </div>
                <div class="radio-option">
                    <input type="radio" id="deacon-no" name="is_deacon" value="لا">
                    <label for="deacon-no">لا</label>
                </div>
            </div>
        </div>
        <div id="deaconFields" style="display: none;">
            <label for="ordinationDate">📅 تاريخ الرسامة <span class="required">*</span></label>
            <input type="date" id="ordinationDate" name="ordination_date">
            <label for="ordinationBishop">✝️ بيد أي أسقف تمت الرسامة؟ <span class="required">*</span></label>
            <input type="text" id="ordinationBishop" name="ordination_bishop">
            <label for="deaconRank">🕊️ الرتبة الشماسية <span class="required">*</span></label>
            <select id="deaconRank" name="deacon_rank">
                <option value="">-- اختر الرتبة --</option>
                <option value="أغنسطوس">أغنسطوس</option>
                <option value="أبيوذياكون">أبيوذياكون</option>
                <option value="دياكون">دياكون</option>
                <option value="ابصالتيس">ابصالتيس</option>
                <option value="بروتوبسالتي">بروتوبسالتي</option>
            </select>
        </div>
        <label for="code">🔑 الكود <span class="required">*</span></label>
        <input type="text" id="code" name="code" required>
        <label for="password">🔑 كلمة المرور <span class="required">*</span></label>
        <input type="password" id="password" name="password" required minlength="8">
        <label for="confirmPassword">🔑 تأكيد كلمة المرور <span class="required">*</span></label>
        <input type="password" id="confirmPassword" name="password_confirmation" required minlength="8">
        <button type="submit">🚀 إنشاء الحساب</button>
        <p class="login-link">لديك حساب بالفعل؟ <a href="{{ route('login') }}">تسجيل الدخول</a></p>
    </form>
</div>
<div id="loadingOverlay" style="display:none">
    <div class="spinner"></div>
    <div class="loading-text">جاري تسجيل البيانات...</div>
</div>
<div id="messageContainer" style="display:none"></div>
@endsection

@section('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
body {
    background: #0A2A4F url('../images/download.png');
    background-size: 300px;
    background-blend-mode: multiply;
    min-height: 100vh;
}
.header-image {
    width: 100%;
    display: flex;
    justify-content: center;
    padding: 0;
    position: relative;
    z-index: 1;
    margin-top: 40px;
}
.header-image img {
    width: 320px;
    max-width: 100%;
    display: block;
    position: relative;
    z-index: 1;
    margin-bottom: -40px;
    pointer-events: none;
    -webkit-user-drag: none;
}
.register-container-box {
    width: 100%;
    max-width: 500px;
    background: white;
    padding: 35px 30px 25px 30px;
    border-radius: 18px;
    box-shadow: 0px 5px 25px rgba(0, 0, 0, 0.15);
    text-align: center;
    color: #333;
    position: relative;
    z-index: 2;
    margin: 0 auto 40px auto;
    transition: all 0.3s ease;
}
.register-title {
    text-align: center;
    color: #0056b3;
    margin-bottom: 25px;
    font-size: 28px;
    font-weight: bold;
}
.center-message {
    margin: 0 auto 18px auto;
    text-align: center;
    padding: 12px 18px;
    border-radius: 8px;
    font-size: 16px;
    max-width: 90%;
    font-weight: bold;
}
.success-message {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 4px;
}
.error-message {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    padding: 10px;
    margin-bottom: 15px;
    border-radius: 4px;
}
.profile-image-upload {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 18px;
}
.image-preview {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background-color: #f8f9fa;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    position: relative;
    border: 2px dashed #007bff;
    cursor: pointer;
    margin-bottom: 8px;
    transition: border-color 0.3s;
}
.image-preview:hover {
    border-color: #0056b3;
}
.image-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}
.upload-btn {
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    position: absolute;
    width: 100%;
    height: 100%;
}
.plus-icon {
    font-size: 36px;
    color: #aaa;
}
.upload-text {
    font-size: 14px;
    color: #666;
    text-align: center;
}
form {
    display: flex;
    flex-direction: column;
    gap: 0;
}
form label {
    margin-top: 10px;
    margin-bottom: 5px;
    font-weight: bold;
    color: #0A2A4F;
    text-align: right;
}
form input, form select {
    padding: 12px;
    margin-bottom: 12px;
    border: 1px solid #ced4da;
    border-radius: 8px;
    font-size: 16px;
    background: #f9f9f9;
    color: #333;
    transition: border-color 0.3s;
    text-align: right;
}
form input:focus, form select:focus {
    border-color: #007bff;
    outline: none;
    background: #fff;
}
.required {
    color: #dc3545;
    font-size: 15px;
}
.radio-group {
    margin-bottom: 10px;
    text-align: right;
}
.radio-options {
    display: flex;
    gap: 20px;
    margin-top: 5px;
}
.radio-option {
    display: flex;
    align-items: center;
    gap: 5px;
}
.multiselect-container {
    margin-bottom: 10px;
}
.select2-container {
    width: 100% !important;
    direction: rtl;
}
.select2-selection--multiple {
    min-height: 38px !important;
    border-radius: 8px !important;
    border: 1px solid #ced4da !important;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 2px 8px;
    margin: 3px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: white;
    margin-right: 5px;
}
.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: #007bff;
}
.select2-dropdown {
    direction: rtl;
}
.login-link {
    text-align: center;
    margin-top: 18px;
}
.login-link a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}
.login-link a:hover {
    text-decoration: underline;
}
button[type="submit"] {
    padding: 14px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 18px;
    cursor: pointer;
    margin-top: 10px;
    font-weight: bold;
    transition: background 0.3s;
}
button[type="submit"]:hover {
    background-color: #0056b3;
}
@media (max-width: 600px) {
    .register-container-box {
        padding: 12px 2px 8px 2px;
        border-radius: 22px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.10);
    }
    .header-image img {
        width: 90px;
        margin-bottom: -40px;
    }
    form input, form select {
        font-size: 17px;
        border-radius: 14px;
        padding: 14px 10px;
    }
    .register-title {
        font-size: 22px;
    }
    button[type="submit"] {
        font-size: 20px;
        border-radius: 14px;
        padding: 16px;
    }
}
.image-preview {
    border: 3px solid #007bff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}
.select2-container--default .select2-selection--multiple {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    border-radius: 8px;
    min-height: 38px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    padding: 2px 8px;
    margin: 3px;
}

.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    color: white;
    margin-right: 5px;
}

.select2-container--default .select2-results__option--highlighted[aria-selected] {
    background-color: #007bff;
}

.select2-dropdown {
    background-color: #f8f9fa;
    border: 1px solid #ced4da;
    border-radius: 8px;
}

#deaconFields {
    width: 100% !important;
    max-width: 100% !important;
    box-sizing: border-box !important;
    margin-top: 15px;
    padding: 0 !important;
    border: 1px solid #ced4da;
    border-radius: 8px;
    background-color: #f8f9fa;
}

#deaconFields label {
    display: block;
    margin-bottom: 8px;
}

/* Error message styling */
.field-error {
    color: #dc3545;
    font-size: 14px;
    margin-top: 5px;
    display: block;
    text-align: right;
}

.input-error {
    border-color: #dc3545 !important;
}

.input-error:focus {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

/* Remove the old error message styles */
#errorMessages {
    display: none;
}

.select2-container--default .select2-selection--single {
    color: #222 !important;
    background: #fff !important;
}
.select2-container--default .select2-results__option {
    color: #222 !important;
    background: #fff !important;
}

#deaconFields input,
#deaconFields select {
    width: 100% !important;
    max-width: 100% !important;
    margin: 0 0 12px 0 !important;
    display: block !important;
    box-sizing: border-box !important;
    text-align: right !important;
}
#deaconFields {
    padding: 0 !important;
    text-align: right !important;
}

.school-page {
    background: transparent;
    /* باقي التنسيقات كما هي */
}

#loadingOverlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.spinner {
    width: 50px;
    height: 50px;
    border: 5px solid #f3f3f3;
    border-top: 5px solid #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

.loading-text {
    color: white;
    margin-top: 20px;
    font-size: 18px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

#messageContainer {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 9999;
    width: 90%;
    max-width: 500px;
}

#messageContainer .success-message,
#messageContainer .error-message {
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 10px;
    text-align: center;
    font-weight: bold;
}

#messageContainer .success-message {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

#messageContainer .error-message {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
</style>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    const maleClasses = @json($maleClasses);
    const femaleClasses = @json($femaleClasses);

    console.log('Male Classes:', maleClasses);
    console.log('Female Classes:', femaleClasses);

$(document).ready(function() {
    // Initialize select2 with dropdownParent
    $('.select2-multi').select2({
        dropdownParent: $('.multiselect-container'),
        width: '100%'
    });

    // Handle image upload
    const imagePreview = document.getElementById('imagePreview');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const profileImage = document.getElementById('profileImage');
    let isUploading = false;

    // Only allow clicking on the plus icon or image preview
    imagePreviewContainer.addEventListener('click', function(e) {
        if (isUploading) return;
        
        const target = e.target;
        if (target.classList.contains('plus-icon') || target.tagName === 'IMG') {
            profileImage.click();
        }
    });

    profileImage.addEventListener('change', function(e) {
        if (isUploading) return;
        isUploading = true;

        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
                document.querySelector('.plus-icon').style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
        isUploading = false;
    });

    // Validate full name (must be at least 4 words)
    const fullNameInput = document.getElementById('fullName');
    const nameError = document.createElement('div');
    nameError.className = 'error-message';
    nameError.style.display = 'none';
    fullNameInput.parentNode.insertBefore(nameError, fullNameInput.nextSibling);

    fullNameInput.addEventListener('input', function() {
        const words = this.value.trim().split(/\s+/);
        if (words.length < 4) {
            nameError.textContent = 'يجب أن يحتوي الاسم على 4 كلمات على الأقل';
            nameError.style.display = 'block';
            this.setCustomValidity('يجب أن يحتوي الاسم على 4 كلمات على الأقل');
        } else {
            nameError.style.display = 'none';
            this.setCustomValidity('');
        }
    });

    // تحديث خيارات الفصول
    function updateClassOptions(gender) {
        const myClassSelect = document.getElementById('myClass');
        const servingClassesSelect = document.getElementById('servingClasses');
        
        // Clear existing options
        myClassSelect.innerHTML = '<option value="">-- اختر الفصل --</option>';
        servingClassesSelect.innerHTML = '';
        
        // Get the appropriate classes based on gender
        const classesToUse = gender === 'ذكر' ? maleClasses : femaleClasses;
        
        if (!classesToUse || classesToUse.length === 0) {
            console.error('No classes found for gender:', gender);
            return;
        }
        
        // Sort classes by stage and name
        const sortedClasses = [...classesToUse].sort((a, b) => {
            if (a.stage !== b.stage) {
                return a.stage.localeCompare(b.stage);
            }
            return a.name.localeCompare(b.name);
        });
        
        // Add options to both selects
        sortedClasses.forEach(classItem => {
            // Skip classes with stage 'الخدام' for the main class select
            if (classItem.stage !== 'الخدام') {
            const option1 = document.createElement('option');
            option1.value = classItem.id;
            option1.textContent = classItem.name;
            myClassSelect.appendChild(option1);
            }
            
            // Add to serving classes select
            const option2 = document.createElement('option');
            option2.value = classItem.id;
            option2.textContent = classItem.name;
            servingClassesSelect.appendChild(option2);
        });
        
        // Reinitialize Select2
        if ($.fn.select2) {
            $(servingClassesSelect).select2('destroy');
            $(servingClassesSelect).select2({
                placeholder: "-- اختر الفصول --",
                allowClear: true,
                multiple: true,
                dir: "rtl",
                width: '100%'
            });
        }
    }

    // معالجة تغيير النوع
    document.querySelectorAll('input[name="gender"]').forEach(radio => {
        radio.addEventListener('change', function() {
            updateClassOptions(this.value);
            // Clear any validation errors
            const myClassSelect = document.getElementById('myClass');
            myClassSelect.setCustomValidity('');
        });
    });

    // معالجة تغيير الدور
    document.querySelectorAll('input[name="role"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const servantFields = document.getElementById('servantFields');
            if (this.value === 'خادم') {
                servantFields.style.display = 'block';
                document.getElementById('servingClasses').required = true;
            } else {
                servantFields.style.display = 'none';
                document.getElementById('servingClasses').required = false;
            }
        });
    });

    // معالجة حقول الشماس
    document.querySelectorAll('input[name="is_deacon"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const deaconFields = document.getElementById('deaconFields');
            if (this.value === 'نعم') {
                deaconFields.style.display = 'block';
                document.getElementById('ordinationDate').required = true;
                document.getElementById('ordinationBishop').required = true;
                document.getElementById('deaconRank').required = true;
            } else {
                deaconFields.style.display = 'none';
                document.getElementById('ordinationDate').required = false;
                document.getElementById('ordinationBishop').required = false;
                document.getElementById('deaconRank').required = false;
            }
        });
    });

    // تهيئة Select2 عند تحميل الصفحة
    if ($.fn.select2) {
        $('.select2-multi').select2({
            placeholder: "-- اختر الفصول --",
            allowClear: true,
            multiple: true,
            dir: "rtl"
        });
    }

    // تحديث الفصول عند تحميل الصفحة
    const selectedGender = document.querySelector('input[name="gender"]:checked');
    if (selectedGender) {
        updateClassOptions(selectedGender.value);
    }

    // تحديث حقول الشماس عند تحميل الصفحة
    const isDeacon = document.querySelector('input[name="is_deacon"]:checked');
    if (isDeacon && isDeacon.value === 'نعم') {
        document.getElementById('deaconFields').style.display = 'block';
        document.getElementById('ordinationDate').required = true;
        document.getElementById('ordinationBishop').required = true;
        document.getElementById('deaconRank').required = true;
    }

    // Phone number validation
    const phoneInputs = ['phone', 'whatsapp', 'relativePhone'];
    phoneInputs.forEach(id => {
        const input = document.getElementById(id);
        input.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);
        });
    });

    // Email validation
    const emailInput = document.getElementById('email');
    emailInput.addEventListener('input', function() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(this.value)) {
            this.setCustomValidity('الرجاء إدخال بريد إلكتروني صحيح');
        } else {
            this.setCustomValidity('');
        }
    });

    // Birth date validation
    const dobInput = document.getElementById('dob');
    const today = new Date();
    const minDate = new Date(today.getFullYear() - 100, today.getMonth(), today.getDate());
    const maxDate = new Date(today.getFullYear() - 5, today.getMonth(), today.getDate());

    dobInput.max = maxDate.toISOString().split('T')[0];
    dobInput.min = minDate.toISOString().split('T')[0];

    dobInput.addEventListener('change', function() {
        const selectedDate = new Date(this.value);
        if (selectedDate > today) {
            this.setCustomValidity('تاريخ الميلاد لا يمكن أن يكون في المستقبل');
        } else if (selectedDate < minDate) {
            this.setCustomValidity('تاريخ الميلاد غير صالح');
        } else {
            this.setCustomValidity('');
            // Calculate age
            const age = Math.floor((today - selectedDate) / (365.25 * 24 * 60 * 60 * 1000));
            document.getElementById('age').value = age;
        }
    });

    // Password validation
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirmPassword');

    password.addEventListener('input', function() {
        if (this.value.length < 8) {
            this.setCustomValidity('كلمة المرور يجب أن تكون 8 أحرف على الأقل');
        } else {
            this.setCustomValidity('');
        }
    });

    confirmPassword.addEventListener('input', function() {
        if (this.value !== password.value) {
            this.setCustomValidity('كلمة المرور غير متطابقة');
        } else {
            this.setCustomValidity('');
        }
    });

    // Form validation
    const form = document.getElementById('signupForm');
    
    // Function to show error for a field
    function showError(field, message) {
        let errorElement = field.nextElementSibling;
        if (!errorElement || !errorElement.classList.contains('field-error')) {
            errorElement = document.createElement('span');
            errorElement.className = 'field-error';
            field.parentNode.insertBefore(errorElement, field.nextSibling);
        }
        errorElement.textContent = message;
        field.classList.add('input-error');
    }

    // Function to clear all errors
    function clearErrors() {
        document.querySelectorAll('.field-error').forEach(error => {
            error.textContent = '';
        });
        document.querySelectorAll('.input-error').forEach(field => {
            field.classList.remove('input-error');
        });
    }

    // Function to validate a field
    function validateField(field) {
        if (field.hasAttribute('required') && !field.value) {
            showError(field, 'هذا الحقل مطلوب');
            return false;
        }
        return true;
    }

    // Function to validate phone number
    function validatePhone(field) {
        if (field.value && field.value.length !== 11) {
            showError(field, 'الرجاء إدخال رقم صحيح مكون من 11 رقم');
            return false;
        }
        return true;
    }

    // Function to validate email
    function validateEmail(field) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (field.value && !emailRegex.test(field.value)) {
            showError(field, 'الرجاء إدخال بريد إلكتروني صحيح');
            return false;
        }
        return true;
    }

    // Function to validate password
    function validatePassword(field) {
        if (field.value && field.value.length < 8) {
            showError(field, 'كلمة المرور يجب أن تكون 8 أحرف على الأقل');
            return false;
        }
        return true;
    }

    // Function to validate password confirmation
    function validatePasswordConfirmation(field) {
        const password = document.getElementById('password');
        if (field.value !== password.value) {
            showError(field, 'كلمة المرور غير متطابقة');
            return false;
        }
        return true;
    }

        // تحقق من الكود عند الخروج من الحقل فقط
        const codeInput = document.getElementById('code');
        let codeError = document.createElement('div');
        codeError.className = 'field-error';
        codeError.style.display = 'none';
        codeInput.parentNode.insertBefore(codeError, codeInput.nextSibling);

        const profileInput = document.getElementById('profileImage');
        let imageError = document.createElement('div');
        imageError.className = 'field-error';
        imageError.style.display = 'none';
        profileInput.parentNode.appendChild(imageError);

        codeInput.addEventListener('blur', function() {
            if (!this.value) return;
            
            const role = $('input[name="role"]:checked').val();
            const gender = $('input[name="gender"]:checked').val();
            
            if (!role || !gender) {
                codeError.textContent = 'الرجاء اختيار الدور والنوع أولاً';
                codeError.style.display = 'block';
                codeInput.classList.add('input-error');
                codeInput.dataset.valid = '0';
                return;
            }

            showLoadingOverlay();
            
            $.ajax({
                url: '{{ route('check.code') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    role: role,
                    gender: gender,
                    code: codeInput.value
                },
                success: function(response) {
                    hideLoadingOverlay();
                    if (response.success) {
                        codeError.style.display = 'none';
                        codeInput.classList.remove('input-error');
                        codeInput.dataset.valid = '1';
                    } else {
                        codeError.textContent = response.message || 'الكود غير صحيح';
                        codeError.style.display = 'block';
                        codeInput.classList.add('input-error');
                        codeInput.dataset.valid = '0';
                    }
                },
                error: function() {
                    hideLoadingOverlay();
                    codeError.textContent = 'حدث خطأ أثناء التحقق من الكود';
                    codeError.style.display = 'block';
                    codeInput.classList.add('input-error');
                    codeInput.dataset.valid = '0';
                }
            });
        });

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        clearErrors();
        
        let isValid = true;
        let firstErrorField = null;

        // Validate required fields
        document.querySelectorAll('input[required], select[required]').forEach(field => {
            if (!validateField(field)) {
                isValid = false;
                if (!firstErrorField) firstErrorField = field;
            }
        });

        // Validate profile image
        const profileInput = document.getElementById('profileImage');
        if (!profileInput.files[0]) {
            showError(profileInput, 'الرجاء تحميل صورة شخصية');
                isValid = false;
                if (!firstErrorField) firstErrorField = profileInput;
            } else {
                const file = profileInput.files[0];
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                if (!validTypes.includes(file.type)) {
                    showError(profileInput, 'نوع الصورة غير مدعوم. الرجاء استخدام JPG, PNG, أو GIF');
            isValid = false;
            if (!firstErrorField) firstErrorField = profileInput;
                }
                if (file.size > 2 * 1024 * 1024) {
                    showError(profileInput, 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت');
                    isValid = false;
                    if (!firstErrorField) firstErrorField = profileInput;
                }
        }

        // Validate phone numbers
        phoneInputs.forEach(id => {
            const field = document.getElementById(id);
            if (!validatePhone(field)) {
                isValid = false;
                if (!firstErrorField) firstErrorField = field;
            }
        });

        // Validate email
        const emailField = document.getElementById('email');
        if (!validateEmail(emailField)) {
            isValid = false;
            if (!firstErrorField) firstErrorField = emailField;
        }

        // Validate password
        const passwordField = document.getElementById('password');
        if (!validatePassword(passwordField)) {
            isValid = false;
            if (!firstErrorField) firstErrorField = passwordField;
        }

        // Validate password confirmation
        const confirmPasswordField = document.getElementById('confirmPassword');
        if (!validatePasswordConfirmation(confirmPasswordField)) {
            isValid = false;
            if (!firstErrorField) firstErrorField = confirmPasswordField;
        }

            // Validate code
            if (codeInput.dataset.valid !== '1') {
                showError(codeInput, 'الرجاء إدخال كود صحيح');
                isValid = false;
                if (!firstErrorField) firstErrorField = codeInput;
        }

        // Validate deacon fields if applicable
        if (document.querySelector('input[name="is_deacon"]:checked')?.value === 'نعم') {
            ['ordinationDate', 'ordinationBishop', 'deaconRank'].forEach(id => {
                const field = document.getElementById(id);
                if (!validateField(field)) {
                    isValid = false;
                    if (!firstErrorField) firstErrorField = field;
                }
            });
        }

        // Validate serving classes if servant
        if (document.querySelector('input[name="role"]:checked')?.value === 'خادم') {
            const servingClasses = $('#servingClasses').val();
            if (!servingClasses || servingClasses.length === 0) {
                const field = document.getElementById('servingClasses');
                showError(field, 'الرجاء اختيار الفصول التي تخدم فيها');
                isValid = false;
                if (!firstErrorField) firstErrorField = field;
            }
        }

        if (!isValid && firstErrorField) {
            firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
        }

            // If all validations pass, submit the form using AJAX
            showLoadingOverlay();
            
            const formData = new FormData(form);
            
            $.ajax({
                url: form.action,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    hideLoadingOverlay();
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        showSuccessMessage('تم إنشاء الحساب بنجاح!');
                        setTimeout(() => {
                            window.location.href = '{{ route('login') }}';
                        }, 2000);
                    }
                },
                error: function(xhr) {
                    hideLoadingOverlay();
                    console.log('Error:', xhr.responseJSON);
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        Object.keys(xhr.responseJSON.errors).forEach(field => {
                            const input = document.querySelector(`[name="${field}"]`);
                            if (input) {
                                showError(input, xhr.responseJSON.errors[field][0]);
                            } else {
                                showErrorMessage(xhr.responseJSON.errors[field][0]);
                            }
                        });
                    } else {
                        showErrorMessage('حدث خطأ أثناء إنشاء الحساب. الرجاء المحاولة مرة أخرى.');
                    }
                }
            });
    });

    // Real-time validation on input
    document.querySelectorAll('input, select').forEach(field => {
        field.addEventListener('input', function() {
            if (this.classList.contains('input-error')) {
                this.classList.remove('input-error');
                const errorElement = this.nextElementSibling;
                if (errorElement && errorElement.classList.contains('field-error')) {
                    errorElement.textContent = '';
                }
            }
        });
    });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function showLoadingOverlay() {
            document.getElementById('loadingOverlay').style.display = 'flex';
        }

        function hideLoadingOverlay() {
            document.getElementById('loadingOverlay').style.display = 'none';
        }

        function showSuccessMessage(message) {
            const container = document.getElementById('messageContainer');
            container.innerHTML = `<div class="success-message">${message}</div>`;
            container.style.display = 'block';
            setTimeout(() => {
                container.style.display = 'none';
            }, 3000);
        }

        function showErrorMessage(message) {
            const container = document.getElementById('messageContainer');
            container.innerHTML = `<div class="error-message">${message}</div>`;
            container.style.display = 'block';
            setTimeout(() => {
                container.style.display = 'none';
            }, 3000);
        }
});
</script>
@endsection 