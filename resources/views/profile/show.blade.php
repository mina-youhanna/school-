@extends('layouts.app')

@section('title', 'بياناتي الشخصية')

@section('content')
<script>
    // رسائل الكونسول للتحقق من البيانات
    console.log('=== بيانات المستخدم ===');
    console.log('الدور:', '{{ $profile->role }}');
    console.log('الفصل من العلاقة:', '{{ $profile->studyClass->name ?? "غير موجود" }}');
    console.log('الفصل المباشر:', '{{ $profile->class }}');
    console.log('هل المستخدم مشرف؟:', '{{ auth()->user()->hasRole("admin") ? "نعم" : "لا" }}');
    console.log('===================');
</script>

<style>
    .profile-container {
        max-width: 900px;
        margin: 80px auto 40px auto; 
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 30px;
        position: relative;
        padding-top: 80px;
    }
    
    .profile-header {
        text-align: right;
        margin-top: 0;
        margin-bottom: 30px;
        color: #FFD700;
        font-size: 2.5em;
        font-weight: 700;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }
    
    .profile-tabs {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 0px;
    }
    
    .profile-tabs button {
        background: transparent;
        border: none;
        padding: 15px 25px;
        color: white;
        font-size: 1.1em;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        border-bottom: 3px solid transparent;
        margin: 0 10px;
    }
    
    .profile-tabs button:hover {
        color: #FFD700;
        border-color: rgba(255, 215, 0, 0.4);
    }
    
    .profile-tabs button.active {
        color: #FFD700;
        border-color: #FFD700;
        background: rgba(255, 215, 0, 0.1);
        border-radius: 8px 8px 0 0;
    }
    
    .tab-content {
        padding: 0 0 20px 0;
    }
    
    .tab-pane .input-group:first-child {
        margin-top: 0;
    }
    
    .tab-pane {
        display: none;
        animation: fadeIn 0.5s ease-out;
        margin-top: 20px;
    }
    
    .tab-pane.active {
        display: block;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .input-group {
        margin-bottom: 20px;
    }
    
    .input-group label {
        display: flex;
        align-items: center;
        flex-direction: row-reverse;
        color: white;
        margin-bottom: 8px;
        font-weight: 500;
        font-size: 1.1em;
        text-align: right;
        justify-content: flex-end;
    }
    
    .input-field-wrapper {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
    }
    
    .password-toggle {
        position: absolute;
        left: 15px; /* Adjust as needed */
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #FFD700; /* Golden color */
        font-size: 1.1em;
        transition: opacity 0.3s ease;
        opacity: 0; /* Reverted to 0 */
    }

    .password-toggle i {
        pointer-events: none; /* Ensure clicks pass through to the span */
    }
    
    .input-group input[type="text"],
    .input-group input[type="email"],
    .input-group input[type="tel"],
    .input-group input[type="date"],
    .input-group input[type="password"],
    .input-group select {
        width: 100%;
        padding: 12px 15px;
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.1) !important;
        color: white;
        font-size: 1em;
        transition: all 0.3s ease;
        text-align: right;
        padding-left: 15px;
        background-image: none !important;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }
    
    .input-group input:-webkit-autofill,
    .input-group input:-webkit-autofill:hover,
    .input-group input:-webkit-autofill:focus,
    .input-group input:-webkit-autofill:active {
        -webkit-box-shadow: 0 0 0px 1000px rgba(255, 255, 255, 0.1) inset !important;
        background-color: rgba(255, 255, 255, 0.1) !important;
        -webkit-text-fill-color: white !important;
        color: white !important;
        transition: background-color 500000s ease-in-out 0s !important;
    }
    
    .input-group label i {
        margin-left: 10px;
        color: #FFD700;
        font-size: 1.2em;
    }
    
    .input-group input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(1);
        cursor: pointer;
    }
    
    .input-group input[type="text"]::placeholder,
    .input-group input[type="email"]::placeholder,
    .input-group input[type="tel"]::placeholder,
    .input-group input[type="date"]::placeholder,
    .input-group input[type="password"]::placeholder,
    .input-group select option[disabled] {
        color: rgba(255, 255, 255, 0.6);
    }
    
    .input-group input[type="text"]:focus,
    .input-group input[type="email"]:focus,
    .input-group input[type="tel"]:focus,
    .input-group input[type="date"]:focus,
    .input-group input[type="password"]:focus,
    .input-group select:focus {
        border-color: #007bff; /* Blue border on focus */
        /* Removed background change on focus */
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.3); /* Blue glow on focus */
        outline: none;
    }
    
    .form-section-title {
        color: #FFD700;
        font-size: 1.8em;
        font-weight: 600;
        margin-top: 40px;
        margin-bottom: 25px;
        text-align: right;
        padding-bottom: 10px;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #FFD700, #FFC107);
        color: #0A2A4F;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        font-size: 1.1em;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        display: block;
        width: fit-content;
        margin: 30px auto 0 auto;
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
    }
    
    .btn-submit:hover {
        background: linear-gradient(135deg, #FFC107, #FFB300);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 215, 0, 0.5);
    }
    
    .radio-group {
        margin-bottom: 20px;
        text-align: right;
    }
    
    .radio-group label {
        display: block;
        color: white;
        margin-bottom: 8px;
        font-weight: 500;
        font-size: 1.1em;
    }
    
    .radio-options {
        display: flex;
        gap: 20px;
        justify-content: flex-end;
    }
    
    .radio-option {
        display: flex;
        align-items: center;
        gap: 5px;
        color: white;
        flex-direction: row-reverse; 
    }
    
    .radio-option input[type="radio"] {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        border: 2px solid #FFD700;
        border-radius: 50%;
        background-color: transparent;
        outline: none;
        cursor: pointer;
        position: relative;
        transition: all 0.2s ease;
    }
    
    .radio-option input[type="radio"]:checked {
        background-color: #FFD700;
        border-color: #FFD700;
    }
    
    .radio-option input[type="radio"]:checked::before {
        content: '';
        display: block;
        width: 10px;
        height: 10px;
        background-color: #0A2A4F;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    /* Enhanced Profile Image Styles - similar to the image you showed */
    .profile-image-container {
        position: absolute;
        top: 100px; /* Adjusted to push it further down */
        left: 50%;
        transform: translateX(-50%);
        z-index: 10;
    }
    
    .profile-image-wrapper {
        position: relative;
        width: 120px;
        height: 120px;
    }
    
    .profile-image-preview {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid #FFD700;
        background: linear-gradient(135deg, rgba(255, 215, 0, 0.2), rgba(255, 193, 7, 0.1));
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
        position: relative;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 0 20px rgba(255, 215, 0, 0.5), 0 0 40px rgba(255, 215, 0, 0.3);
    }
    
    .profile-image-preview:hover {
        transform: scale(1.05);
        box-shadow: 0 0 25px rgba(255, 215, 0, 0.7), 0 0 50px rgba(255, 215, 0, 0.4);
        border-color: #FFC107;
    }
    
    .profile-image-preview img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        display: block;
    }
    
    .profile-image-placeholder {
        color: rgba(255, 255, 255, 0.7);
        font-size: 3em;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .profile-image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        font-size: 1.5em;
        opacity: 0;
        transition: opacity 0.3s ease;
        border-radius: 50%;
    }
    
    .profile-image-preview:hover .profile-image-overlay {
        opacity: 1;
    }
    
    .profile-image-upload {
        display: none;
    }
    
    /* Loading animation */
    .loading-spinner {
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        border-top: 2px solid #FFD700;
        width: 20px;
        height: 20px;
        animation: spin 1s linear infinite;
        margin: 0 auto;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Error and success messages */
    .image-message {
        position: absolute;
        top: 130px;
        left: 50%;
        transform: translateX(-50%);
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 0.8em;
        text-align: center;
        min-width: 200px;
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 5;
    }
    
    .image-message.show {
        opacity: 1;
        transform: translateX(-50%) translateY(10px);
    }
    
    .image-message.success {
        background: rgba(40, 167, 69, 0.9);
        color: white;
    }
    
    .image-message.error {
        background: rgba(220, 53, 69, 0.9);
        color: white;
    }
    
    .error-message-inline {
        color: #dc3545;
        font-size: 0.9em;
        margin-top: 5px;
        text-align: right;
        display: block;
    }
    
    .info-display-box {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        padding: 10px 15px;
        color: white;
        font-size: 1em;
        margin-bottom: 20px;
        text-align: right;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        flex-direction: row-reverse;
    }
    
    .info-display-box i {
        color: #FFD700;
        margin-left: 0;
        margin-right: 10px;
    }
</style>

<!-- Profile Image Container -->
<div class="profile-image-container">
    <div class="profile-image-wrapper">
    <label for="profileImageUpload" class="profile-image-preview">
            @if(auth()->user()->profile_image)
                <img id="profileImagePreview" src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="الصورة الشخصية">
            @else
                <div class="profile-image-placeholder">
                    <i class="fas fa-user"></i>
                </div>
            @endif
            <div class="profile-image-overlay">
                <i class="fas fa-camera"></i>
            </div>
            <input type="file" id="profileImageUpload" name="profile_image" accept="image/*" class="profile-image-upload">
    </label>
    </div>
    <div id="imageMessage" class="image-message"></div>
</div>

<form method="POST" action="{{ route('profile.update') }}" class="profile-container" dir="rtl" enctype="multipart/form-data" id="profileForm">
    @csrf
    @method('put')
    <h2 class="profile-header text-center">بياناتي الشخصية</h2>

    <div class="profile-tabs">
        <button type="button" class="tab-button active" onclick="showTab('personal')">البيانات الشخصية</button>
        <button type="button" class="tab-button" onclick="showTab('church')">البيانات الكنسية</button>
        <button type="button" class="tab-button" onclick="showTab('educational')">البيانات التعليمية والوظيفية</button>
        <button type="button" class="tab-button" onclick="showTab('password')">تغير كلمة المرور</button>
    </div>

    <div class="tab-content">
        <!-- Personal Data Tab -->
        <div id="personal" class="tab-pane active">
            <div class="input-group">
                <label for="full_name">الاسم الرباعي: <i class="fas fa-user"></i></label>
                <div class="input-field-wrapper">
                    <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $profile->full_name) }}">
                </div>
                @error('full_name')
                    <span class="error-message-inline">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="full_name_en">الاسم بالإنجليزية: <i class="fas fa-user"></i></label>
                <div class="input-field-wrapper">
                    <input type="text" id="full_name_en" name="full_name_en" value="{{ old('full_name_en', $profile->full_name_en) }}">
                </div>
                @error('full_name_en')
                    <span class="error-message-inline">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="username">اسم المستخدم: <i class="fas fa-user-circle"></i></label>
                <div class="input-field-wrapper">
                    <input type="text" id="username" name="username" value="{{ old('username', $profile->username ?? (implode(' ', array_slice(explode(' ', $profile->full_name), 0, 2)))) }}">
                </div>
                @error('username')
                    <span class="error-message-inline">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="email">البريد الإلكتروني: <i class="fas fa-envelope"></i></label>
                <div class="input-field-wrapper">
                    <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}">
                </div>
            </div>

            <div class="input-group">
                <label for="national_id">الرقم القومي: <i class="fas fa-id-card"></i></label>
                <div class="input-field-wrapper">
                    <input type="text" id="national_id" name="national_id" value="{{ old('national_id', $profile->national_id) }}">
                </div>
                @error('national_id')
                    <span class="error-message-inline">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="gender">النوع: <i class="fas fa-venus-mars"></i></label>
                <div class="input-field-wrapper">
                    <input type="text" id="gender" name="gender" value="{{ old('gender', $profile->gender) }}" readonly>
                </div>
            </div>

            <div class="input-group">
                <label for="birth_date">تاريخ الميلاد: <i class="fas fa-calendar-alt"></i></label>
                <div class="input-field-wrapper">
                    <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $profile->dob ? Carbon\Carbon::parse($profile->dob)->format('Y-m-d') : '') }}" readonly>
                </div>
            </div>

            <div class="input-group">
                <label for="age">السن: <i class="fas fa-birthday-cake"></i></label>
                <div class="input-field-wrapper">
                    <input type="text" id="age" name="age" value="" readonly>
                </div>
            </div>
            
            <div class="input-group">
                <label for="phone">رقم الهاتف: <i class="fas fa-phone"></i></label>
                <div class="input-field-wrapper">
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $profile->phone) }}">
                </div>
                @error('phone')
                    <span class="error-message-inline">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="input-group">
                <label for="whatsapp">رقم الواتساب: <i class="fab fa-whatsapp"></i></label>
                <div class="input-field-wrapper">
                    <input type="tel" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $profile->whatsapp) }}">
                </div>
                @error('whatsapp')
                    <span class="error-message-inline">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="relative_phone">رقم هاتف أحد الأقارب: <i class="fas fa-phone-alt"></i></label>
                <div class="input-field-wrapper">
                    <input type="tel" id="relative_phone" name="relative_phone" value="{{ old('relative_phone', $profile->relative_phone) }}">
                </div>
                @error('relative_phone')
                    <span class="error-message-inline">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="address">العنوان: <i class="fas fa-map-marker-alt"></i></label>
                <div class="input-field-wrapper">
                    <input type="text" id="address" name="address" value="{{ old('address', $profile->address) }}">
                </div>
                @error('address')
                    <span class="error-message-inline">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Church Data Tab -->
        <div id="church" class="tab-pane">
            <div class="input-group">
                <label for="confession_father">أب الاعتراف: <i class="fas fa-church"></i></label>
                <div class="input-field-wrapper">
                    <input type="text" id="confession_father" name="confession_father" value="{{ old('confession_father', $profile->confession_father) }}">
                </div>
                @error('confession_father')
                    <span class="error-message-inline">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="role">الدور: <i class="fas fa-user-tag"></i></label>
                <div class="input-field-wrapper">
                    <input type="text" id="role" name="role" value="{{ old('role', $profile->role) }}" readonly>
                </div>
            </div>

            <div class="input-group">
                <label for="class">الفصل: <i class="fas fa-users"></i></label>
                <div class="input-field-wrapper">
                    <input type="text" id="class" name="class" value="{{ old('class', $profile->studyClass->name ?? 'غير محدد') }}" {{ auth()->user()->hasRole('admin') ? '' : 'readonly' }}>
                </div>
            </div>

            
            
            <div class="input-group">
                <label for="promotion_by">الترقية بواسطة: <i class="fas fa-user-tie"></i></label>
                <div class="input-field-wrapper">
                    <input type="text" id="promotion_by" name="promotion_by" value="{{ old('promotion_by', $profile->promotion_by) }}">
                </div>
                @error('promotion_by')
                    <span class="error-message-inline">{{ $message }}</span>
                @enderror
            </div>

           

            <div class="radio-group">
                <label><i class="fas fa-cross"></i>هل أنت شماس؟ </label>
                <div class="radio-options">
                    <div class="radio-option">
                        <input type="radio" id="is_deacon_yes" name="is_deacon" value="1" {{ old('is_deacon', $profile->is_deacon) == 1 ? 'checked' : '' }}>
                        <label for="is_deacon_yes">نعم</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="is_deacon_no" name="is_deacon" value="0" {{ old('is_deacon', $profile->is_deacon) == 0 ? 'checked' : '' }}>
                        <label for="is_deacon_no">لا</label>
                    </div>
                </div>
            </div>

            <div class="input-group">
                <label for="promotion_rank">الرتبة الكنسية: </label>
                <div class="input-field-wrapper">
                    <input type="text" id="promotion_rank" name="promotion_rank" value="{{ old('promotion_rank', $profile->promotion_rank) }}">
                </div>
                @error('promotion_rank')
                    <span class="error-message-inline">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="input-group">
                <label for="promotion_date">تاريخ الترقية: <i class="fas fa-calendar-alt"></i></label>
                <div class="input-field-wrapper">
                    <input type="date" id="promotion_date" name="promotion_date" value="{{ old('promotion_date', $profile->promotion_date ? Carbon\Carbon::parse($profile->promotion_date)->format('Y-m-d') : '') }}">
                </div>
                @error('promotion_date')
                    <span class="error-message-inline">{{ $message }}</span>
                @enderror
            </div>

            <div class="input-group">
                <label for="ordination_date">تاريخ الرسامة: <i class="fas fa-calendar-check"></i></label>
                <div class="input-field-wrapper">
                    <input type="date" id="ordination_date" name="ordination_date" value="{{ old('ordination_date', $profile->ordination_date ? Carbon\Carbon::parse($profile->ordination_date)->format('Y-m-d') : '') }}">
                </div>
            </div>

            <div class="input-group">
                <label for="ordained_by">بيد أي أسقف: <i class="fas fa-user-graduate"></i></label>
                <div class="input-field-wrapper">
                    <input type="text" id="ordained_by" name="ordained_by" value="{{ old('ordained_by', $profile->ordained_by) }}">
                </div>
            </div>

            <div class="input-group">
                <label for="current_deacon_rank">الرتبة الشماسية الحالية: <i class="fas fa-star"></i></label>
                <div class="input-field-wrapper">
                    <input type="text" id="current_deacon_rank" name="current_deacon_rank" value="{{ old('current_deacon_rank', $profile->current_deacon_rank) }}">
                </div>
            </div>
        </div>

        <!-- Educational and Functional Data Tab -->
        <div id="educational" class="tab-pane">
            <div class="input-group">
                <label for="last_degree">آخر شهادة علمية: <i class="fas fa-graduation-cap"></i></label>
                <div class="input-field-wrapper">
                    <input type="text" id="last_degree" name="last_degree" value="{{ old('last_degree', $profile->last_degree) }}">
                </div>
                @error('last_degree')
                    <span class="error-message-inline">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <label for="job">الوظيفة: <i class="fas fa-briefcase"></i></label>
                <div class="input-field-wrapper">
                    <input type="text" id="job" name="job" value="{{ old('job', $profile->job) }}">
                </div>
                @error('job')
                    <span class="error-message-inline">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Password Change Tab -->
        <div id="password" class="tab-pane">
            <div class="input-group">
                <label for="current_password">كلمة المرور الحالية: <i class="fas fa-lock"></i></label>
                <div class="input-field-wrapper">
                    <input type="password" id="current_password" name="current_password">
                    <span class="password-toggle" tabindex="-1"><i class="fas fa-eye"></i></span>
                </div>
                @error('current_password')
                    <span class="error-message-inline">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <label for="new_password">كلمة المرور الجديدة: <i class="fas fa-key"></i></label>
                <div class="input-field-wrapper">
                    <input type="password" id="new_password" name="new_password">
                    <span class="password-toggle" tabindex="-1"><i class="fas fa-eye"></i></span>
                </div>
                @error('new_password')
                    <span class="error-message-inline">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-group">
                <label for="new_password_confirmation">تأكيد كلمة المرور الجديدة: <i class="fas fa-key"></i></label>
                <div class="input-field-wrapper">
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation">
                    <span class="password-toggle" tabindex="-1"><i class="fas fa-eye"></i></span>
                </div>
                @error('new_password_confirmation')
                    <span class="error-message-inline">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="text-center mt-4">
        <button type="submit" class="btn btn-submit">حفظ التغييرات</button>
    </div>
</form>

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- jQuery Validation Plugin -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validation/1.19.3/jquery.validate.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validation/1.19.3/localization/messages_ar.min.js"></script>

<script>
    // Tab switching functionality - Moved to global scope
    function showTab(tabId) {
        const tabs = document.querySelectorAll('.tab-pane');
        tabs.forEach(tab => {
            tab.classList.remove('active');
        });

        const buttons = document.querySelectorAll('.tab-button');
        buttons.forEach(button => {
            button.classList.remove('active');
        });

        document.getElementById(tabId).classList.add('active');
        document.querySelector(`.tab-button[onclick="showTab('${tabId}')"]`).classList.add('active');
    }

    $(document).ready(function() {
        // Show the appropriate tab if coming from a profile update (server-side validation failed)
        @if(isset($isProfileUpdate) && $isProfileUpdate && $errors->any())
            @if($errors->has('current_password') || $errors->has('new_password') || $errors->has('new_password_confirmation'))
                showTab('password');
            @elseif($errors->has('promotion_rank') || $errors->has('promotion_date') || $errors->has('promotion_by') || $errors->has('last_degree') || $errors->has('job'))
                showTab('educational');
            @else
                showTab('personal');
            @endif
        @else
            showTab('personal');
        @endif

        // JavaScript for Age Calculation
        const birthDateInput = document.getElementById('birth_date');
        const ageInput = document.getElementById('age');

        function calculateAge() {
            const birthDate = new Date(birthDateInput.value);
            if (isNaN(birthDate)) {
                ageInput.value = '';
                return;
            }
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            ageInput.value = age > 0 ? age : '';
        }

        if (birthDateInput && ageInput) {
            birthDateInput.addEventListener('change', calculateAge);
            // Calculate age on page load if birth date is already present
            if (birthDateInput.value) {
                calculateAge();
            }
        }

        // Enhanced profile image upload functionality
        const profileImageUpload = document.getElementById('profileImageUpload');
        const profileImagePreview = document.getElementById('profileImagePreview');
        const profileImagePlaceholder = document.querySelector('.profile-image-placeholder');
        const profileImageContainer = document.querySelector('.profile-image-preview');
        const overlay = document.querySelector('.profile-image-overlay');
        const imageMessage = document.getElementById('imageMessage'); // For displaying messages

        if (profileImageUpload) { // Check if the upload input exists
            // Add loading state
            function setLoading(isLoading) {
                if (isLoading) {
                    overlay.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                    overlay.style.opacity = '1';
                    profileImageContainer.style.cursor = 'wait';
                    imageMessage.classList.remove('show', 'success', 'error');
                } else {
                    overlay.innerHTML = '<i class="fas fa-camera"></i>';
                    overlay.style.opacity = '0';
                    profileImageContainer.style.cursor = 'pointer';
                }
            }

            // Function to display messages
            function showMessage(message, type) {
                imageMessage.textContent = message;
                imageMessage.className = 'image-message show ' + type;
                setTimeout(() => {
                    imageMessage.classList.remove('show');
                }, 3000); // Hide after 3 seconds
            }

            // Handle file selection
            profileImageUpload.addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (!file) {
                    // If no file selected, reset to placeholder if no current image
                    if (!profileImagePreview || !profileImagePreview.src || profileImagePreview.src.includes('default-avatar.png') || profileImagePreview.src.includes('logo.png')) {
                        if (profileImagePreview) profileImagePreview.style.display = 'none';
                        if (profileImagePlaceholder) profileImagePlaceholder.style.display = 'flex';
                    }
                    return;
                }

                // Validate file type
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/svg+xml']; // Added SVG
                if (!validTypes.includes(file.type)) {
                    showMessage('نوع الصورة غير مدعوم. الرجاء استخدام JPG, PNG, GIF, أو SVG', 'error');
                    return;
                }

                // Validate file size (2MB max)
                if (file.size > 2 * 1024 * 1024) {
                    showMessage('حجم الصورة يجب أن لا يتجاوز 2 ميجابايت', 'error');
                    return;
                }

                setLoading(true);

                const reader = new FileReader();
                reader.onload = function(e) {
                    if (profileImagePreview) {
                        profileImagePreview.src = e.target.result;
                        profileImagePreview.style.display = 'block';
                    }
                    if (profileImagePlaceholder) profileImagePlaceholder.style.display = 'none';
                    setLoading(false);
                    showMessage('تم تحميل الصورة بنجاح!', 'success');
                };
                reader.onerror = function() {
                    showMessage('حدث خطأ أثناء قراءة الصورة', 'error');
                    setLoading(false);
                };
                reader.readAsDataURL(file);
            });

            // Handle drag and drop
            profileImageContainer.addEventListener('dragover', function(e) {
                e.preventDefault();
                profileImageContainer.style.borderColor = '#FFD700'; // Highlight border on drag over
                overlay.style.opacity = '1';
                overlay.innerHTML = '<i class="fas fa-cloud-upload-alt"></i> اسحب الصورة هنا';
            });

            profileImageContainer.addEventListener('dragleave', function(e) {
                e.preventDefault();
                profileImageContainer.style.borderColor = ''; // Reset border
                overlay.style.opacity = '0';
                overlay.innerHTML = '<i class="fas fa-camera"></i>';
            });

            profileImageContainer.addEventListener('drop', function(e) {
                e.preventDefault();
                profileImageContainer.style.borderColor = ''; // Reset border
                overlay.style.opacity = '0';
                overlay.innerHTML = '<i class="fas fa-camera"></i>';
                
                const file = e.dataTransfer.files[0];
                if (file) {
                    profileImageUpload.files = e.dataTransfer.files;
                    const event = new Event('change');
                    profileImageUpload.dispatchEvent(event);
                }
            });

            // Initial display check for profile image/placeholder
            if (profileImagePreview) {
                if (profileImagePreview.src && !profileImagePreview.src.includes('default-avatar.png') && !profileImagePreview.src.includes('logo.png')) {
                    profileImagePreview.style.display = 'block';
                    if (profileImagePlaceholder) profileImagePlaceholder.style.display = 'none';
                } else {
                    profileImagePreview.style.display = 'none';
                    if (profileImagePlaceholder) profileImagePlaceholder.style.display = 'flex';
                }
            }
        }

        // Password toggle functionality
        const passwordToggles = document.querySelectorAll('.password-toggle');

        passwordToggles.forEach(function(toggle) {
            const input = toggle.previousElementSibling;
            const icon = toggle.querySelector('i');

            toggle.addEventListener('mousedown', function(event) {
                event.preventDefault(); // Prevent default action to keep focus on input
                event.stopPropagation(); // Stop event from bubbling up to prevent focus loss
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
                input.focus(); // Explicitly re-focus the input
            });

            input.addEventListener('focus', function() {
                toggle.style.opacity = '1';
            });

            input.addEventListener('blur', function() {
                toggle.style.opacity = '0'; // Hide the toggle on blur
                if (input.type === 'text') {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        // jQuery Validation setup
        const profileForm = $('#profileForm');

        if (profileForm.length) { // Ensure the form exists
            console.log("$.validator before addMethod:", $.validator); // Debugging line

            // Define custom validation methods
            $.validator.addMethod("arabicNames", function(value, element) {
                return this.optional(element) || /^[؀-ۿ\s]+$/.test(value);
            }, "الرجاء إدخال حروف عربية ومسافات فقط.");

            $.validator.addMethod("fourArabicNames", function(value, element) {
                return this.optional(element) || value.split(/\s+/).length === 4;
            }, "يجب ان يكون الاسم رباعي.");

            $.validator.addMethod("englishNames", function(value, element) {
                return this.optional(element) || /^[A-Za-z\s]+$/.test(value);
            }, "الاسم بالإنجليزي يجب أن يحتوي على حروف إنجليزية ومسافات فقط.");

            $.validator.addMethod("egyptianPhone", function(value, element) {
                return this.optional(element) || /^01[0-9]{9}$/.test(value);
            }, "رقم الهاتف يجب أن يبدأ بـ 01 ويتكون من 11 رقم.");
            
            $.validator.addMethod("arabicCharacters", function(value, element) {
                return this.optional(element) || /^[؀-ۿ\s]*$/.test(value);
            }, "الاسم يجب أن يحتوي على حروف عربية ومسافات فقط.");


            profileForm.validate({
                debug: true, // Keep for now
                onkeyup: false, // Validate on keyup disabled as per user request
                onfocusout: false, // Validate on focusout disabled as per user request
                rules: {
                    full_name: {
                        required: true,
                        arabicNames: true,
                        fourArabicNames: true,
                    },
                    full_name_en: {
                        englishNames: true,
                    },
                    username: {
                        required: true,
                        minlength: 3,
                    },
                    national_id: {
                        digits: true,
                        minlength: 14,
                        maxlength: 14,
                    },
                    phone: {
                        egyptianPhone: true,
                    },
                    whatsapp: {
                        egyptianPhone: true,
                    },
                    relative_phone: {
                        egyptianPhone: true,
                    },
                    address: {
                        maxlength: 255
                    },
                    confession_father: {
                        arabicCharacters: true,
                    },
                    promotion_rank: {
                        maxlength: 255
                    },
                    promotion_by: {
                        maxlength: 255
                    },
                    last_degree: {
                        maxlength: 255
                    },
                    job: {
                        maxlength: 255
                    },
                    current_password: {
                        required: function(element) {
                            return $("#new_password").val().length > 0 || $("#new_password_confirmation").val().length > 0;
                        }
                    },
                    new_password: {
                        required: function(element) {
                            return $("#current_password").val().length > 0;
                        },
                        minlength: 8,
                    },
                    new_password_confirmation: {
                        required: function(element) {
                            return $("#new_password").val().length > 0;
                        },
                        minlength: 8,
                        equalTo: "#new_password"
                    },
                },
                messages: {
                    full_name: {
                        required: "الاسم الرباعي مطلوب.",
                    },
                    username: {
                        required: "اسم المستخدم مطلوب.",
                        minlength: "اسم المستخدم يجب أن لا يقل عن 3 أحرف."
                    },
                    national_id: {
                        digits: "الرقم القومي يجب أن يتكون من أرقام فقط.",
                        minlength: "الرقم القومي يجب أن يتكون من 14 رقم.",
                        maxlength: "الرقم القومي يجب أن يتكون من 14 رقم."
                    },
                    phone: {
                        egyptianPhone: "رقم الهاتف يجب أن يبدأ بـ 01 ويتكون من 11 رقم."
                    },
                    whatsapp: {
                        egyptianPhone: "رقم الواتساب يجب أن يبدأ بـ 01 ويتكون من 11 رقم."
                    },
                    relative_phone: {
                        egyptianPhone: "رقم هاتف أحد الأقارب يجب أن يبدأ بـ 01 ويتكون من 11 رقم."
                    },
                    current_password: {
                        required: "كلمة المرور الحالية مطلوبة لتغيير كلمة المرور."
                    },
                    new_password: {
                        required: "كلمة المرور الجديدة مطلوبة عند إدخال كلمة المرور الحالية.",
                        minlength: "كلمة المرور الجديدة يجب أن لا تقل عن 8 أحرف."
                    },
                    new_password_confirmation: {
                        required: "تأكيد كلمة المرور الجديدة مطلوب عند إدخال كلمة مرور جديدة.",
                        minlength: "تأكيد كلمة المرور الجديدة يجب أن لا يقل عن 8 أحرف.",
                        equalTo: "كلمة المرور الجديدة وتأكيدها غير متطابقين."
                    },
                },
                errorElement: 'span',
                errorClass: 'error-message-inline',
                errorPlacement: function(error, element) {
                    if (element.attr("name") === "profile_image") {
                        // Image errors are handled by custom JS via imageMessage div
                    } else if (element.attr("name") === "role" || element.attr("name") === "class" || element.attr("name") === "is_deacon") {
                        error.insertAfter(element.closest('.input-group').find('label'));
                    } else if (element.closest('.input-field-wrapper').length) {
                        error.insertAfter(element.closest('.input-field-wrapper'));
                    } else {
                        error.insertAfter(element);
                    }

                    const tabPane = element.closest('.tab-pane');
                    if (tabPane.length && !tabPane.hasClass('active')) {
                        const tabId = tabPane.attr('id');
                        showTab(tabId);
                    }
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                },
                // Add invalidHandler for scrolling and tab switching
                invalidHandler: function(event, validator) {
                    var errors = validator.numberOfInvalids();
                    if (errors) {
                        var firstInvalidElement = $(validator.errorList[0].element);
                        var tabPane = firstInvalidElement.closest('.tab-pane');
                        if (tabPane.length && !tabPane.hasClass('active')) {
                            var tabId = tabPane.attr('id');
                            showTab(tabId);
                        }
                        $('html, body').animate({
                            scrollTop: firstInvalidElement.offset().top - 100 // Adjust offset as needed
                        }, 500);
                    }
                },
            });
        }
    });
    </script>

@endsection