@extends('layouts.app')
@section('title', 'الملف الشخصي')
@section('content')
<div class="profile-header-image">
    <div class="image-container">
        <img src="{{ $profile->profile_image ? asset('storage/' . $profile->profile_image) : asset('images/default-avatar.png') }}" alt="الصورة الشخصية" class="profile-avatar">
        <label for="profile_image" class="camera-icon">
            <i class="fas fa-camera"></i>
        </label>
    </div>
</div>
<div class="profile-box">
    <h2 class="profile-title">بياناتي الشخصية</h2>
    @if($profile->last_profile_update && \Carbon\Carbon::parse($profile->last_profile_update)->diffInDays(now()) > 180)
        <div class="alert alert-warning text-center mb-4">
            <i class="fas fa-exclamation-triangle"></i> لم تقم بتحديث بياناتك منذ فترة طويلة. يرجى تحديث بياناتك!
        </div>
    @endif
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="profile-form">
        @csrf
        @method('PUT')
        <input type="file" id="profile_image" name="profile_image" accept="image/*" style="display: none" onchange="this.form.submit()">
        <ul class="nav nav-tabs mb-4" id="profileTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="personal-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab">بيانات شخصية</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="church-tab" data-bs-toggle="tab" data-bs-target="#church" type="button" role="tab">بيانات كنسية</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="edu-tab" data-bs-toggle="tab" data-bs-target="#edu" type="button" role="tab">بيانات تعليمية/وظيفية</button>
            </li>
        </ul>
        <div class="tab-content" id="profileTabContent">
            <div class="tab-pane fade show active" id="personal" role="tabpanel">
                <div class="form-group"><label><i class="fas fa-user"></i> الاسم الرباعي:</label><input type="text" name="full_name" value="{{ $profile->full_name }}" required></div>
                <div class="form-group"><label><i class="fas fa-user"></i> الاسم بالإنجليزي:</label><input type="text" name="full_name_en" value="{{ $profile->full_name_en }}"></div>
                <div class="form-group"><label><i class="fas fa-id-card"></i> الرقم القومي:</label><input type="text" name="national_id" value="{{ $profile->national_id }}"></div>
                <div class="form-group"><label><i class="fas fa-envelope"></i> البريد الإلكتروني:</label><input type="email" name="email" value="{{ $profile->email }}" required></div>
                <div class="form-group"><label><i class="fas fa-venus-mars"></i> النوع:</label><div>{{ $profile->gender }}</div></div>
                <div class="form-group"><label><i class="fas fa-birthday-cake"></i> تاريخ الميلاد:</label><div>{{ $profile->dob }}</div></div>
                <div class="form-group"><label><i class="fas fa-phone"></i> رقم الهاتف:</label><input type="tel" name="phone" value="{{ $profile->phone }}"></div>
                <div class="form-group"><label><i class="fab fa-whatsapp"></i> رقم الواتساب:</label><input type="tel" name="whatsapp" value="{{ $profile->whatsapp }}"></div>
                <div class="form-group"><label><i class="fas fa-user-friends"></i> رقم أحد الأقارب:</label><input type="tel" name="relative_phone" value="{{ $profile->relative_phone }}"></div>
                <div class="form-group"><label><i class="fas fa-map-marker-alt"></i> العنوان:</label><input type="text" name="address" value="{{ $profile->address }}"></div>
            </div>
            <div class="tab-pane fade" id="church" role="tabpanel">
                <div class="form-group"><label><i class="fas fa-church"></i> اسم أب الاعتراف:</label><input type="text" name="confession_father" value="{{ $profile->confession_father }}"></div>
                <div class="form-group"><label><i class="fas fa-user-tag"></i> الدور:</label><div>{{ $profile->role }}</div></div>
                <div class="form-group"><label><i class="fas fa-users"></i> الفصول التي أخدم فيها:</label><div>@if($profile->serving_classes)@foreach(json_decode($profile->serving_classes, true) as $class)<span class="profile-badge">{{ $class }}</span>@endforeach@endif</div></div>
                <div class="form-group"><label><i class="fas fa-book-reader"></i> فصلي:</label><div><span class="profile-badge">{{ $profile->myClass?->name ?? '-' }}</span></div></div>
                <div class="form-group"><label><i class="fas fa-chess-king"></i> هل أنت شماس؟</label><div>{{ $profile->is_deacon ? 'نعم' : 'لا' }}</div></div>
                @if($profile->is_deacon)
                    <div class="form-group"><label><i class="fas fa-calendar-alt"></i> تاريخ الرسامة:</label><div>{{ $profile->ordination_date }}</div></div>
                    <div class="form-group"><label><i class="fas fa-user-tie"></i> بيد أي أسقف:</label><div>{{ $profile->ordination_bishop }}</div></div>
                    <div class="form-group"><label><i class="fas fa-medal"></i> الرتبة الشماسية:</label><div>{{ $profile->deacon_rank }}</div></div>
                    <div class="form-group"><label><i class="fas fa-arrow-up"></i> الترقية الشماسية:</label><input type="text" name="promotion_rank" value="{{ $profile->promotion_rank }}"></div>
                    <div class="form-group"><label><i class="fas fa-calendar-check"></i> تاريخ الترقية:</label><input type="date" name="promotion_date" value="{{ $profile->promotion_date }}"></div>
                    <div class="form-group"><label><i class="fas fa-user-shield"></i> بيد من تمت الترقية:</label><input type="text" name="promotion_by" value="{{ $profile->promotion_by }}"></div>
                @endif
            </div>
            <div class="tab-pane fade" id="edu" role="tabpanel">
                
                <div class="form-group"><label><i class="fas fa-graduation-cap"></i> آخر مؤهل:</label><input type="text" name="last_degree" value="{{ $profile->last_degree }}"></div>
                <div class="form-group"><label><i class="fas fa-briefcase"></i> الوظيفة:</label><input type="text" name="job" value="{{ $profile->job }}"></div>
            </div>
        </div>
        <div class="form-actions mt-4 text-center">
            <button type="submit" class="btn btn-primary btn-lg"><i class="fas fa-save"></i> حفظ التغييرات</button>
        </div>
    </form>
    <div class="password-section mt-5">
        <h3><i class="fas fa-key"></i> تغيير كلمة المرور</h3>
        <form method="POST" action="{{ route('profile.change-password') }}" class="password-form">
            @csrf
            <div class="form-group"><label><i class="fas fa-lock"></i> كلمة المرور الحالية:</label><input type="password" name="current_password" required></div>
            <div class="form-group"><label><i class="fas fa-lock"></i> كلمة المرور الجديدة:</label><input type="password" name="new_password" required></div>
            <div class="form-group"><label><i class="fas fa-lock"></i> تأكيد كلمة المرور الجديدة:</label><input type="password" name="new_password_confirmation" required></div>
            <div class="form-actions text-center"><button type="submit" class="btn btn-primary"><i class="fas fa-key"></i> تغيير كلمة المرور</button></div>
        </form>
    </div>
</div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />
<style>
.profile-header-image {
    width: 100%;
    display: flex;
    justify-content: center;
    margin-top: 40px;
}
.image-container {
    position: relative;
    display: inline-block;
}
.profile-avatar {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid #007bff;
    background: #fff;
    box-shadow: 0 4px 16px rgba(0,0,0,0.13);
}
.camera-icon {
    position: absolute;
    bottom: 5px;
    right: 5px;
    background: #007bff;
    color: white;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
}
.camera-icon:hover {
    background: #0056b3;
    transform: scale(1.1);
}
.profile-box {
    max-width: 700px;
    margin: 0 auto 40px auto;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0px 5px 25px rgba(0, 0, 0, 0.15);
    padding: 35px 30px 25px 30px;
    text-align: right;
    color: #222;
    position: relative;
    z-index: 2;
    transition: all 0.3s ease;
}
.profile-title {
    text-align: center;
    color: #0056b3;
    margin-bottom: 25px;
    font-size: 28px;
    font-weight: bold;
}
.profile-info {
    font-size: 17px;
    line-height: 1.8;
}
.profile-badge {
    display: inline-block;
    background: #007bff;
    color: #fff;
    border-radius: 12px;
    padding: 2px 12px;
    margin: 0 3px;
    font-size: 15px;
}
.form-group {
    margin-bottom: 15px;
    display: flex;
    flex-direction: column;
}
.form-group label {
    font-weight: bold;
    margin-bottom: 4px;
}
.form-actions {
    margin-top: 20px;
}
.nav-tabs .nav-link {
    color: #007bff;
    font-weight: bold;
    font-size: 18px;
    border: none;
    border-bottom: 3px solid transparent;
    background: none;
}
.nav-tabs .nav-link.active {
    color: #fff;
    background: #007bff;
    border-radius: 8px 8px 0 0;
    border-bottom: 3px solid #0056b3;
}
.tab-content {
    background: #f8f9fa;
    border-radius: 0 0 12px 12px;
    padding: 24px 18px 12px 18px;
    margin-bottom: 10px;
}
.alert-warning {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeeba;
    border-radius: 8px;
    font-size: 17px;
}
</style>
@endsection 