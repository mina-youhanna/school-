@extends('layouts.app')

@section('title', 'تعديل المستخدم - ' . $user->full_name)

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/user-details.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin-edit-fixes.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
<div class="container-fluid edit-user-page">
    <!-- Header Section -->
    <div class="page-header">
        <div class="header-content">
            <div class="header-title">
                <div class="title-icon">
                    <i class="fas fa-edit"></i>
                </div>
                <div class="title-text">
                    <h1>تعديل بيانات المستخدم</h1>
                    <p>{{ $user->full_name }}</p>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right"></i>
                    <span>العودة للتفاصيل</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <div class="edit-form-section">
        <div class="edit-form-card">
            <div class="card-header">
                <h3><i class="fas fa-user-edit"></i> تعديل البيانات</h3>
            </div>
            <div class="card-content">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST" id="editUserForm">
                    @csrf
                    @method('PUT')

                    <div class="form-grid">
                        <!-- Personal Information -->
                        <div class="form-section">
                            <h4><i class="fas fa-user-circle"></i> المعلومات الشخصية</h4>

                            <div class="form-group">
                                <label for="full_name" class="form-label">
                                    <i class="fas fa-user"></i>
                                    الاسم الكامل
                                </label>
                                <input type="text"
                                    class="form-control @error('full_name') is-invalid @enderror"
                                    id="full_name"
                                    name="full_name"
                                    value="{{ old('full_name', $user->full_name) }}"
                                    required>
                                @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i>
                                    البريد الإلكتروني
                                </label>
                                <input type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="email"
                                    name="email"
                                    value="{{ old('email', $user->email) }}"
                                    required>
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="phone" class="form-label">
                                    <i class="fas fa-phone"></i>
                                    رقم الهاتف
                                </label>
                                <input type="text"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone', $user->phone) }}">
                                @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="whatsapp" class="form-label">
                                    <i class="fab fa-whatsapp"></i>
                                    رقم الواتساب
                                </label>
                                <input type="text"
                                    class="form-control @error('whatsapp') is-invalid @enderror"
                                    id="whatsapp"
                                    name="whatsapp"
                                    value="{{ old('whatsapp', $user->whatsapp) }}">
                                @error('whatsapp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="relative_phone" class="form-label">
                                    <i class="fas fa-phone-alt"></i>
                                    رقم هاتف ولي الأمر
                                </label>
                                <input type="text"
                                    class="form-control @error('relative_phone') is-invalid @enderror"
                                    id="relative_phone"
                                    name="relative_phone"
                                    value="{{ old('relative_phone', $user->relative_phone) }}">
                                @error('relative_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="gender" class="form-label">
                                    <i class="fas fa-venus-mars"></i>
                                    النوع
                                </label>
                                <select class="form-select @error('gender') is-invalid @enderror"
                                    id="gender"
                                    name="gender">
                                    <option value="">اختر النوع</option>
                                    <option value="ذكر" {{ old('gender', $user->gender) == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                                    <option value="أنثى" {{ old('gender', $user->gender) == 'أنثى' ? 'selected' : '' }}>أنثى</option>
                                </select>
                                @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="birth_date" class="form-label">
                                    <i class="fas fa-birthday-cake"></i>
                                    تاريخ الميلاد
                                </label>
                                <input type="date"
                                    class="form-control @error('birth_date') is-invalid @enderror"
                                    id="birth_date"
                                    name="birth_date"
                                    value="{{ old('birth_date', $user->dob ? \Carbon\Carbon::parse($user->dob)->format('Y-m-d') : '') }}">
                                @error('birth_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Additional Information -->
                        <div class="form-section">
                            <h4><i class="fas fa-info-circle"></i> معلومات إضافية</h4>

                            <div class="form-group">
                                <label for="address" class="form-label">
                                    <i class="fas fa-map-marker-alt"></i>
                                    العنوان
                                </label>
                                <textarea class="form-control @error('address') is-invalid @enderror"
                                    id="address"
                                    name="address"
                                    rows="3">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="confession_father" class="form-label">
                                    <i class="fas fa-cross"></i>
                                    أب الاعتراف
                                </label>
                                <input type="text"
                                    class="form-control @error('confession_father') is-invalid @enderror"
                                    id="confession_father"
                                    name="confession_father"
                                    value="{{ old('confession_father', $user->confession_father) }}">
                                @error('confession_father')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="role" class="form-label">
                                    <i class="fas fa-user-shield"></i>
                                    الدور
                                </label>
                                <select class="form-select @error('role') is-invalid @enderror"
                                    id="role"
                                    name="role"
                                    required>
                                    <option value="">اختر الدور</option>
                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>مدير</option>
                                    <option value="خادم" {{ old('role', $user->role) == 'خادم' ? 'selected' : '' }}>خادم</option>
                                    <option value="مخدوم" {{ old('role', $user->role) == 'مخدوم' ? 'selected' : '' }}>مخدوم</option>
                                </select>
                                @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="my_class" class="form-label">
                                    <i class="fas fa-graduation-cap"></i>
                                    الفصل
                                </label>
                                <select class="form-select @error('my_class') is-invalid @enderror"
                                    id="my_class"
                                    name="my_class">
                                    <option value="">اختر الفصل</option>
                                    @if($classes && $classes->count() > 0)
                                    @foreach($classes as $class)
                                    <option value="{{ $class->id }}" {{ old('my_class', $user->my_class_id) == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }} - {{ $class->stage }}
                                    </option>
                                    @endforeach
                                    @else
                                    <option value="" disabled>لا توجد فصول متاحة</option>
                                    @endif
                                </select>
                                @error('my_class')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="score" class="form-label">
                                    <i class="fas fa-star"></i>
                                    النقاط
                                </label>
                                <input type="number"
                                    class="form-control @error('score') is-invalid @enderror"
                                    id="score"
                                    name="score"
                                    value="{{ old('score', $user->score) }}"
                                    min="0"
                                    max="100">
                                @error('score')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Account Settings -->
                        <div class="form-section">
                            <h4><i class="fas fa-cog"></i> إعدادات الحساب</h4>

                            <div class="form-group">
                                <label for="is_main_servant" class="form-label">
                                    <i class="fas fa-crown"></i>
                                    خادم رئيسي
                                </label>
                                <div class="form-check">
                                    <input type="checkbox"
                                        class="form-check-input @error('is_main_servant') is-invalid @enderror"
                                        id="is_main_servant"
                                        name="is_main_servant"
                                        value="1"
                                        {{ old('is_main_servant', $user->is_main_servant) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_main_servant">
                                        نعم، خادم رئيسي
                                    </label>
                                </div>
                                @error('is_main_servant')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deacon Information Section -->
                            <div class="form-group">
                                <label for="is_deacon" class="form-label">
                                    <i class="fas fa-cross"></i>
                                    هل انت شماس؟
                                </label>
                                <div class="form-check">
                                    <input type="checkbox"
                                        class="form-check-input @error('is_deacon') is-invalid @enderror"
                                        id="is_deacon"
                                        name="is_deacon"
                                        value="1"
                                        {{ old('is_deacon', $user->is_deacon) ? 'checked' : '' }}
                                        onchange="toggleDeaconFields()">
                                    <label class="form-check-label" for="is_deacon">
                                        نعم، شماس
                                    </label>
                                </div>
                                @error('is_deacon')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group deacon-field" id="deacon_rank_group" style="{{ old('is_deacon', $user->is_deacon) ? '' : 'display: none;' }}">
                                <label for="deacon_rank" class="form-label">
                                    <i class="fas fa-medal"></i>
                                    الرتبة
                                </label>
                                <select class="form-select @error('deacon_rank') is-invalid @enderror"
                                    id="deacon_rank"
                                    name="deacon_rank">
                                    <option value="">اختر الرتبة</option>
                                    <option value="شماس إنجيلي" {{ old('deacon_rank', $user->deacon_rank) == 'شماس إنجيلي' ? 'selected' : '' }}>شماس إنجيلي</option>
                                    <option value="شماس إبصالتوس" {{ old('deacon_rank', $user->deacon_rank) == 'شماس إبصالتوس' ? 'selected' : '' }}>شماس إبصالتوس</option>
                                    <option value="شماس أناغنوستيس" {{ old('deacon_rank', $user->deacon_rank) == 'شماس أناغنوستيس' ? 'selected' : '' }}>شماس أناغنوستيس</option>
                                    <option value="شماس إيبودياكون" {{ old('deacon_rank', $user->deacon_rank) == 'شماس إيبودياكون' ? 'selected' : '' }}>شماس إيبودياكون</option>
                                    <option value="شماس دياكون" {{ old('deacon_rank', $user->deacon_rank) == 'شماس دياكون' ? 'selected' : '' }}>شماس دياكون</option>
                                    <option value="شماس أرشدياكون" {{ old('deacon_rank', $user->deacon_rank) == 'شماس أرشدياكون' ? 'selected' : '' }}>شماس أرشدياكون</option>
                                </select>
                                @error('deacon_rank')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group deacon-field" id="ordination_bishop_group" style="{{ old('is_deacon', $user->is_deacon) ? '' : 'display: none;' }}">
                                <label for="ordination_bishop" class="form-label">
                                    <i class="fas fa-user-tie"></i>
                                    بيد مين من الاساقفة
                                </label>
                                <input type="text"
                                    class="form-control @error('ordination_bishop') is-invalid @enderror"
                                    id="ordination_bishop"
                                    name="ordination_bishop"
                                    value="{{ old('ordination_bishop', $user->ordination_bishop) }}"
                                    placeholder="اسم الأسقف">
                                @error('ordination_bishop')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group deacon-field" id="ordination_date_group" style="{{ old('is_deacon', $user->is_deacon) ? '' : 'display: none;' }}">
                                <label for="ordination_date" class="form-label">
                                    <i class="fas fa-calendar-alt"></i>
                                    تاريخ السيامة
                                </label>
                                <input type="date"
                                    class="form-control @error('ordination_date') is-invalid @enderror"
                                    id="ordination_date"
                                    name="ordination_date"
                                    value="{{ old('ordination_date', $user->ordination_date ? \Carbon\Carbon::parse($user->ordination_date)->format('Y-m-d') : '') }}">
                                @error('ordination_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Section -->
                            <div class="form-group">
                                <label for="password" class="form-label">
                                    <i class="fas fa-key"></i>
                                    كلمة المرور الجديدة (اتركها فارغة إذا لم ترد تغييرها)
                                </label>
                                <div class="password-input-group">
                                    <input type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        id="password"
                                        name="password"
                                        minlength="6">
                                    <button type="button" class="btn btn-outline-secondary toggle-password-btn"
                                        onclick="togglePasswordField()">
                                        <i class="fas fa-eye" id="passwordToggleIcon"></i>
                                    </button>
                                </div>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">
                                    <i class="fas fa-key"></i>
                                    تأكيد كلمة المرور
                                </label>
                                <input type="password"
                                    class="form-control"
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    minlength="6"
                                    data-required-if="password">
                                <small class="form-text text-muted">أدخل تأكيد كلمة المرور فقط إذا كنت تريد تغيير كلمة المرور</small>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary save-btn">
                            <i class="fas fa-save"></i>
                            <span>حفظ التغييرات</span>
                        </button>
                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-secondary cancel-btn">
                            <i class="fas fa-times"></i>
                            <span>إلغاء</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // وظائف كلمة المرور
    function togglePasswordField() {
        const passwordField = document.getElementById('password');
        const passwordToggleIcon = document.getElementById('passwordToggleIcon');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordToggleIcon.className = 'fas fa-eye-slash';
        } else {
            passwordField.type = 'password';
            passwordToggleIcon.className = 'fas fa-eye';
        }
    }

    // دالة للتحكم في حقول الشماسية
    function toggleDeaconFields() {
        const isDeacon = document.getElementById('is_deacon').checked;
        const deaconFields = document.querySelectorAll('.deacon-field');

        deaconFields.forEach(field => {
            field.style.display = isDeacon ? 'block' : 'none';
        });
    }
</script>

@push('scripts')
<script src="{{ asset('js/user-details.js') }}"></script>
<script src="{{ asset('js/admin-edit-enhancements.js') }}"></script>
@endpush
@endsection
