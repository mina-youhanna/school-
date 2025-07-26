                <div class="input-group">
                    <label for="nationalId">الرقم القومي: <i class="fas fa-id-card"></i></label>
                    <input type="text" id="nationalId" name="national_id" value="{{ auth()->user()->national_id ?? '' }}" pattern="[0-9]{14}" title="الرقم القومي يجب أن يكون 14 رقم" maxlength="14">
                    <span class="error-message-inline" id="nationalIdError" style="display: none;">الرقم القومي مطلوب ويجب أن يكون 14 رقم</span>
                </div>
                <div class="input-group">
                    <label for="email">البريد الإلكتروني: <i class="fas fa-envelope"></i></label>
                    <input type="email" id="email" name="email" value="{{ auth()->user()->email ?? 'minayouhanna2004@gmail.com' }}">
                </div>
                <div class="input-group">
                    <label for="type" class="input-group-label">النوع: <i class="fas fa-venus-mars"></i></label>
                    <div class="info-display-box">
                        {{ auth()->user()->gender ?? 'ذكر' }} <i class="fas fa-venus-mars"></i>
                    </div>
                </div>
                <div class="input-group">
                    <label for="birth_date">تاريخ الميلاد: <i class="fas fa-calendar-alt"></i></label>
                    <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', auth()->user()->dob ? \Carbon\Carbon::parse(auth()->user()->dob)->format('Y-m-d') : '') }}">
                    @error('birth_date')
                        <span class="error-message-inline">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="phone">رقم الهاتف: <i class="fas fa-phone"></i></label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', auth()->user()->phone) }}" placeholder="ادخل رقم الهاتف">
                    @error('phone')
                        <span class="error-message-inline">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="whatsapp">رقم الواتساب: <i class="fab fa-whatsapp"></i></label>
                    <input type="tel" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', auth()->user()->whatsapp) }}" placeholder="ادخل رقم الواتساب">
                    @error('whatsapp')
                        <span class="error-message-inline">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="relative_phone">رقم هاتف أحد الأقارب: <i class="fas fa-user-friends"></i></label>
                    <input type="tel" id="relative_phone" name="relative_phone" value="{{ old('relative_phone', auth()->user()->relative_phone) }}" placeholder="ادخل رقم هاتف أحد الأقارب">
                    @error('relative_phone')
                        <span class="error-message-inline">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="address">العنوان: <i class="fas fa-map-marker-alt"></i></label>
                    <input type="text" id="address" name="address" value="{{ old('address', auth()->user()->address) }}" placeholder="ادخل العنوان بالكامل">
                    @error('address')
                        <span class="error-message-inline">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="confessionFather">أسم أب الاعتراف: <i class="fas fa-church"></i></label>
                    <input type="text" id="confessionFather" name="confession_father" value="{{ old('confession_father', auth()->user()->confession_father) }}" placeholder="أبونا أنطون" required>
                    @error('confession_father')
                        <span class="error-message-inline">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="role" class="input-group-label">الدور: <i class="fas fa-user-friends"></i></label>
                    <div class="info-display-box">
                        {{ auth()->user()->role ?? 'مخدوم' }} <i class="fas fa-user-friends"></i>
                    </div>
                </div>
                <div class="input-group">
                    <label for="chapter" class="input-group-label">الفصل: <i class="fas fa-book"></i></label>
                    <div class="info-display-box">
                        {{ auth()->user()->studyClass?->name ?? 'غير محدد' }} <i class="fas fa-book"></i>
                    </div>
                </div>
                <div class="input-group radio-group">
                    <label>هل أنت شماس؟ <i class="fas fa-cross"></i></label>
                    <div class="radio-options">
                        <label class="radio-option">
                            <input type="radio" name="is_deacon" value="1" {{ old('is_deacon', auth()->user()->is_deacon) == 1 ? 'checked' : '' }}>
                            نعم
                        </label>
                        <label class="radio-option">
                            <input type="radio" name="is_deacon" value="0" {{ old('is_deacon', auth()->user()->is_deacon) == 0 ? 'checked' : '' }}>
                            لا
                        </label>
                    </div>
                    @error('is_deacon')
                        <span class="error-message-inline">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="ordination_date">تاريخ الرسامة: <i class="fas fa-calendar-alt"></i></label>
                    <input type="date" id="ordination_date" name="ordination_date" value="{{ old('ordination_date', auth()->user()->ordination_date ? \Carbon\Carbon::parse(auth()->user()->ordination_date)->format('Y-m-d') : '') }}">
                    @error('ordination_date')
                        <span class="error-message-inline">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="promotion_by">بيد أي أسقف: <i class="fas fa-church"></i></label>
                    <input type="text" id="promotion_by" name="promotion_by" value="{{ old('promotion_by', auth()->user()->promotion_by) }}" placeholder="اكتب اسم الأسقف">
                    @error('promotion_by')
                        <span class="error-message-inline">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="deacon_rank" class="input-group-label">الرتبة الشماسية الحالية: <i class="fas fa-user-tag"></i></label>
                    <div class="info-display-box">
                        {{ auth()->user()->promotion_rank ?? 'إبصالطس' }} <i class="fas fa-user-tag"></i>
                    </div>
                </div>
                <button type="submit" class="btn-submit">تحديث الملف الشخصي</button>
            </form>

            <h3 class="form-section-title">تغيير كلمة المرور</h3>
            <form action="{{ route('profile.change-password') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label for="currentPassword">كلمة المرور الحالية: <i class="fas fa-lock"></i></label>
                    <div class="password-input-wrapper">
                        <input type="password" id="currentPassword" name="current_password">
                        <span class="password-toggle" onclick="togglePasswordVisibility('currentPassword')"><i class="fas fa-eye"></i></span>
                    </div>
                </div>
                <div class="input-group">
                    <label for="newPassword">كلمة المرور الجديدة: <i class="fas fa-key"></i></label>
                    <div class="password-input-wrapper">
                        <input type="password" id="newPassword" name="new_password">
                        <span class="password-toggle" onclick="togglePasswordVisibility('newPassword')"><i class="fas fa-eye"></i></span>
                    </div>
                </div>
                <div class="input-group">
                    <label for="confirmNewPassword">تأكيد كلمة المرور الجديدة: <i class="fas fa-key"></i></label>
                    <div class="password-input-wrapper">
                        <input type="password" id="confirmNewPassword" name="new_password_confirmation">
                        <span class="password-toggle" onclick="togglePasswordVisibility('confirmNewPassword')"><i class="fas fa-eye"></i></span>
                    </div>
                </div>
                <button type="submit" class="btn-submit">تغيير كلمة المرور</button>
            </form>
        </div>

        <!-- Church Data Tab -->
        <div id="church" class="tab-pane">
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="input-group">
                    <label for="confessionFather">أسم أب الاعتراف: <i class="fas fa-church"></i></label>
                    <input type="text" id="confessionFather" name="confession_father" value="{{ old('confession_father', auth()->user()->confession_father) }}" placeholder="أبونا أنطون" required>
                    @error('confession_father')
                        <span class="error-message-inline">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="role" class="input-group-label">الدور: <i class="fas fa-user-friends"></i></label>
                    <div class="info-display-box">
                        {{ auth()->user()->role ?? 'مخدوم' }} <i class="fas fa-user-friends"></i>
                    </div>
                </div>
                <div class="input-group">
                    <label for="chapter" class="input-group-label">الفصل: <i class="fas fa-book"></i></label>
                    <div class="info-display-box">
                        {{ auth()->user()->studyClass?->name ?? 'غير محدد' }} <i class="fas fa-book"></i>
                    </div>
                </div>
                <div class="input-group">
                    <label for="type" class="input-group-label">النوع: <i class="fas fa-venus-mars"></i></label>
                    <div class="info-display-box">
                        {{ auth()->user()->gender ?? 'ذكر' }} <i class="fas fa-venus-mars"></i>
                    </div>
                </div>
                <div class="input-group">
                    <label for="birth_date">تاريخ الميلاد: <i class="fas fa-calendar-alt"></i></label>
                    <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', auth()->user()->dob ? \Carbon\Carbon::parse(auth()->user()->dob)->format('Y-m-d') : '') }}">
                    @error('birth_date')
                        <span class="error-message-inline">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group radio-group">
                    <label>هل أنت شماس؟ <i class="fas fa-cross"></i></label>
                    <div class="radio-options">
                        <label class="radio-option">
                            <input type="radio" name="is_deacon" value="1" {{ old('is_deacon', auth()->user()->is_deacon) == 1 ? 'checked' : '' }}>
                            نعم
                        </label>
                        <label class="radio-option">
                            <input type="radio" name="is_deacon" value="0" {{ old('is_deacon', auth()->user()->is_deacon) == 0 ? 'checked' : '' }}>
                            لا
                        </label>
                    </div>
                    @error('is_deacon')
                        <span class="error-message-inline">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="ordination_date">تاريخ الرسامة: <i class="fas fa-calendar-alt"></i></label>
                    <input type="date" id="ordination_date" name="ordination_date" value="{{ old('ordination_date', auth()->user()->ordination_date ? \Carbon\Carbon::parse(auth()->user()->ordination_date)->format('Y-m-d') : '') }}">
                    @error('ordination_date')
                        <span class="error-message-inline">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="promotion_by">بيد أي أسقف: <i class="fas fa-church"></i></label>
                    <input type="text" id="promotion_by" name="promotion_by" value="{{ old('promotion_by', auth()->user()->promotion_by) }}" placeholder="اكتب اسم الأسقف">
                    @error('promotion_by')
                        <span class="error-message-inline">{{ $message }}</span>
                    @enderror
                </div>
                <div class="input-group">
                    <label for="deacon_rank" class="input-group-label">الرتبة الشماسية الحالية: <i class="fas fa-user-tag"></i></label>
                    <div class="info-display-box">
                        {{ auth()->user()->promotion_rank ?? 'إبصالطس' }} <i class="fas fa-user-tag"></i>
                    </div>
                </div>
                <button type="submit" class="btn-submit">حفظ التغييرات الكنسية</button>
            </form>
        </div> 