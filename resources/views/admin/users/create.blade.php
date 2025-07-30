@extends('layouts.app')

@section('title', 'إضافة مستخدم جديد')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/create-user.css') }}">
@endpush

@section('content')
<div class="container-fluid create-user-page">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
            <!-- Header Card -->
            <div class="header-card">
                <div class="header-content">
                    <div class="header-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="header-text">
                        <h1>إضافة مستخدم جديد</h1>
                        <p>قم بإضافة مستخدم جديد إلى النظام</p>
                    </div>
                </div>
            </div>

            <!-- Form Card -->
            <div class="form-card">
                <form method="POST" action="{{ route('admin.users.store') }}" id="createUserForm">
                    @csrf

                    <!-- Basic Information Section -->
                    <div class="form-section">
                        <div class="section-header">
                            <i class="fas fa-user"></i>
                            <h3>المعلومات الأساسية</h3>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="full_name" class="form-label">
                                        <i class="fas fa-user"></i>
                                        الاسم الكامل *
                                    </label>
                                    <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                        id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                                    @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="email" class="form-label">
                                        <i class="fas fa-envelope"></i>
                                        البريد الإلكتروني *
                                    </label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="phone" class="form-label">
                                        <i class="fas fa-phone"></i>
                                        رقم الهاتف
                                    </label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="gender" class="form-label">
                                        <i class="fas fa-venus-mars"></i>
                                        النوع
                                    </label>
                                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                                        <option value="">اختر النوع</option>
                                        <option value="ذكر" {{ old('gender') == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                                        <option value="أنثى" {{ old('gender') == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                                    </select>
                                    @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security Section -->
                    <div class="form-section">
                        <div class="section-header">
                            <i class="fas fa-shield-alt"></i>
                            <h3>معلومات الأمان</h3>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="password" class="form-label">
                                        <i class="fas fa-lock"></i>
                                        كلمة المرور *
                                    </label>
                                    <div class="password-input-group">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" required>
                                        <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="password-strength" id="passwordStrength"></div>
                                    @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="password_confirmation" class="form-label">
                                        <i class="fas fa-lock"></i>
                                        تأكيد كلمة المرور *
                                    </label>
                                    <div class="password-input-group">
                                        <input type="password" class="form-control"
                                            id="password_confirmation" name="password_confirmation" required>
                                        <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <div class="password-match" id="passwordMatch"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Information Section -->
                    <div class="form-section">
                        <div class="section-header">
                            <i class="fas fa-info-circle"></i>
                            <h3>معلومات إضافية</h3>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="birth_date" class="form-label">
                                        <i class="fas fa-birthday-cake"></i>
                                        تاريخ الميلاد
                                    </label>
                                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror"
                                        id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
                                    @error('birth_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="role" class="form-label">
                                        <i class="fas fa-user-tag"></i>
                                        الدور *
                                    </label>
                                    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                        <option value="">اختر الدور</option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>مدير</option>
                                        <option value="خادم" {{ old('role') == 'خادم' ? 'selected' : '' }}>خادم</option>
                                        <option value="مخدوم" {{ old('role') == 'مخدوم' ? 'selected' : '' }}>مخدوم</option>
                                    </select>
                                    @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="my_class" class="form-label">
                                        <i class="fas fa-graduation-cap"></i>
                                        الفصل
                                    </label>
                                    <select class="form-select @error('my_class') is-invalid @enderror" id="my_class" name="my_class">
                                        <option value="">اختر الفصل</option>
                                        @foreach($classes as $class)
                                        <option value="{{ $class->id }}" {{ old('my_class') == $class->id ? 'selected' : '' }}>
                                            {{ $class->name }} - {{ $class->stage }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('my_class')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="form-group">
                                    <label for="address" class="form-label">
                                        <i class="fas fa-map-marker-alt"></i>
                                        العنوان
                                    </label>
                                    <textarea class="form-control @error('address') is-invalid @enderror"
                                        id="address" name="address" rows="3">{{ old('address') }}</textarea>
                                    @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary submit-btn">
                            <i class="fas fa-save"></i>
                            <span>حفظ المستخدم</span>
                        </button>
                        <a href="{{ route('admin.users') }}" class="btn btn-secondary cancel-btn">
                            <i class="fas fa-arrow-left"></i>
                            <span>رجوع</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const toggle = field.nextElementSibling;
        const icon = toggle.querySelector('i');

        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    $(document).ready(function() {
        // Auto-hide validation messages after 5 seconds
        setTimeout(function() {
            $('.invalid-feedback').fadeOut();
        }, 5000);

        // Password strength indicator
        $('#password').on('input', function() {
            const password = $(this).val();
            let strength = 0;
            let strengthText = '';
            let strengthClass = '';

            if (password.length >= 6) strength++;
            if (password.match(/[a-z]/)) strength++;
            if (password.match(/[A-Z]/)) strength++;
            if (password.match(/[0-9]/)) strength++;
            if (password.match(/[^a-zA-Z0-9]/)) strength++;

            if (strength <= 1) {
                strengthText = 'ضعيفة';
                strengthClass = 'weak';
            } else if (strength <= 2) {
                strengthText = 'متوسطة';
                strengthClass = 'medium';
            } else if (strength <= 3) {
                strengthText = 'جيدة';
                strengthClass = 'medium';
            } else if (strength <= 4) {
                strengthText = 'قوية';
                strengthClass = 'strong';
            } else {
                strengthText = 'قوية جداً';
                strengthClass = 'strong';
            }

            $('#passwordStrength').html(`قوة كلمة المرور: <span class="${strengthClass}">${strengthText}</span>`);
        });

        // Password confirmation check
        $('#password_confirmation').on('input', function() {
            const password = $('#password').val();
            const confirmPassword = $(this).val();

            if (password && confirmPassword) {
                if (password === confirmPassword) {
                    $(this).removeClass('is-invalid');
                    $('#passwordMatch').html('<span class="match">✓ كلمة المرور متطابقة</span>');
                } else {
                    $(this).addClass('is-invalid');
                    $('#passwordMatch').html('<span class="no-match">✗ كلمة المرور غير متطابقة</span>');
                }
            } else {
                $(this).removeClass('is-invalid');
                $('#passwordMatch').html('');
            }
        });

        // Check password match when password changes
        $('#password').on('input', function() {
            $('#password_confirmation').trigger('input');
        });

        // Form submission with loading state
        $('#createUserForm').on('submit', function() {
            const submitBtn = $('.submit-btn');
            submitBtn.prop('disabled', true);
            submitBtn.html('<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...');
        });
    });
</script>
@endsection
