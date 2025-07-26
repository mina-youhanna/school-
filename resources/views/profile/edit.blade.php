@extends('layouts.app')

@section('title', 'تعديل الملف الشخصي')

@section('content')
<style>
    .profile-container {
        max-width: 900px;
        margin: 80px auto 40px auto; /* Adjust top margin for fixed navbar */
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 30px;
    }
    .profile-header {
        text-align: right;
        margin-bottom: 30px;
        color: #FFD700;
        font-size: 2.5em;
        font-weight: 700;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }
    .profile-tabs {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 30px;
        border-bottom: 2px solid rgba(255, 215, 0, 0.2);
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
        padding: 20px 0;
    }
    .tab-pane {
        display: none;
        animation: fadeIn 0.5s ease-out;
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
        justify-content: flex-end;
        flex-direction: row-reverse;
        color: white;
        margin-bottom: 8px;
        font-weight: 500;
        font-size: 1.1em;
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
        background: rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 1em;
        transition: all 0.3s ease;
        text-align: right;
        /* Remove custom arrow for select and date inputs */
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }
    .input-group input[type="date"]::-webkit-calendar-picker-indicator {
        /* Remove default calendar picker icon style if unwanted */
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
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.3); /* Blue glow on focus */
        outline: none;
    }
    .input-group i {
        margin-right: 10px; /* Space between icon and text, placing icon to the right */
        color: #FFD700;
    }
    .form-section-title {
        color: #FFD700;
        font-size: 1.8em;
        font-weight: 600;
        margin-top: 40px;
        margin-bottom: 25px;
        text-align: right;
        border-bottom: 1px solid rgba(255, 215, 0, 0.2);
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
        margin: 30px 0 0 auto;
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
        justify-content: flex-end; /* Align radio options to the right */
    }
    .radio-option {
        display: flex;
        align-items: center;
        gap: 5px;
        color: white;
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
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">تعديل الملف الشخصي</div>

                <div class="card-body">
                    <form id="profile-form" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="profile-container" dir="rtl">
                            <h2 class="profile-header text-center">تعديل الملف الشخصي</h2>

                            <div class="profile-tabs">
                                <button class="tab-button active" onclick="showTab('personal')">البيانات الشخصية</button>
                                <button class="tab-button" onclick="showTab('church')">البيانات الكنسية والتعليمية</button>
                                <button class="tab-button" onclick="showTab('password')">تغيير كلمة المرور</button>
                            </div>

                            <div class="tab-content">
                                <!-- Personal Data Tab -->
                                <div id="personal" class="tab-pane active">
                                    <h3 class="form-section-title">البيانات الشخصية</h3>

                                    <!-- Profile Image -->
                                    <div class="form-group text-center mb-4">
                                        <div class="custom-file-upload" style="flex-direction:column;align-items:center;gap:6px;">
                                            <label id="profileImageLabel" style="background:#ffd700;color:#0a234f;padding:8px 18px;border-radius:12px;cursor:pointer;font-weight:bold;display:flex;align-items:center;gap:10px;border:2px solid #ffd700;transition:background 0.2s, color 0.2s;">
                                                <span id="profileImageText">اختر صورة</span>
                                                <img id="profileImagePreview" src="{{ $profile->profile_image ? asset('storage/profile_images/' . $profile->profile_image) : asset('images/default-avatar.png') }}" style="width:40px;height:40px;border-radius:8px;object-fit:cover;border:2px solid #ffd700;box-shadow:0 2px 8px #ffd70033;{{ $profile->profile_image ? 'display:inline-block;' : 'display:none;' }}" />
                                                <input type="file" name="profile_image" id="profile_image" class="d-none" accept="image/*">
                                            </label>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <label for="full_name"><i class="fas fa-user"></i> الاسم الرباعي:</label>
                                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name" name="full_name" value="{{ old('full_name', $profile->full_name) }}" required>
                                        <span id="full_name-error" class="invalid-feedback text-right"></span>
                                    </div>

                                    <div class="input-group">
                                        <label for="full_name_en"><i class="fas fa-user"></i> الاسم بالإنجليزية:</label>
                                        <input type="text" class="form-control @error('full_name_en') is-invalid @enderror" id="full_name_en" name="full_name_en" value="{{ old('full_name_en', $profile->full_name_en) }}">
                                        <span id="full_name_en-error" class="invalid-feedback text-right"></span>
                                    </div>

                                    <div class="input-group">
                                        <label for="username"><i class="fas fa-user-circle"></i> اسم المستخدم:</label>
                                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $profile->username) }}" required>
                                        <span id="username-error" class="invalid-feedback text-right"></span>
                                    </div>

                                    <div class="input-group">
                                        <label for="national_id"><i class="fas fa-id-card"></i> الرقم القومي:</label>
                                        <input type="text" class="form-control @error('national_id') is-invalid @enderror" id="national_id" name="national_id" value="{{ old('national_id', $profile->national_id) }}">
                                        <span id="national_id-error" class="invalid-feedback text-right"></span>
                                    </div>

                                    <div class="input-group">
                                        <label for="phone"><i class="fas fa-phone"></i> رقم الهاتف:</label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $profile->phone) }}">
                                        <span id="phone-error" class="invalid-feedback text-right"></span>
                                    </div>

                                    <div class="input-group">
                                        <label for="whatsapp"><i class="fab fa-whatsapp"></i> رقم الواتساب:</label>
                                        <input type="text" class="form-control @error('whatsapp') is-invalid @enderror" id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $profile->whatsapp) }}">
                                        <span id="whatsapp-error" class="invalid-feedback text-right"></span>
                                    </div>

                                    <div class="input-group">
                                        <label for="relative_phone"><i class="fas fa-phone-alt"></i> رقم هاتف أحد الأقارب:</label>
                                        <input type="text" class="form-control @error('relative_phone') is-invalid @enderror" id="relative_phone" name="relative_phone" value="{{ old('relative_phone', $profile->relative_phone) }}">
                                        <span id="relative_phone-error" class="invalid-feedback text-right"></span>
                                    </div>

                                    <div class="input-group">
                                        <label for="address"><i class="fas fa-map-marker-alt"></i> العنوان:</label>
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $profile->address) }}">
                                        <span id="address-error" class="invalid-feedback text-right"></span>
                                    </div>

                                    <div class="input-group">
                                        <label for="confession_father"><i class="fas fa-church"></i> أب الاعتراف:</label>
                                        <input type="text" class="form-control @error('confession_father') is-invalid @enderror" id="confession_father" name="confession_father" value="{{ old('confession_father', $profile->confession_father) }}">
                                        <span id="confession_father-error" class="invalid-feedback text-right"></span>
                                    </div>
                                    @if($profile->role === 'خادم')
                                    <div class="input-group">
                                        <label for="is_main_servant"><i class="fas fa-user-shield"></i> هل أنت الخادم المسؤول عن الفصل؟</label>
                                        <div class="radio-options" style="gap: 30px;">
                                            <div class="radio-option">
                                                <input type="radio" id="main_servant_yes" name="is_main_servant" value="1" {{ old('is_main_servant', $profile->is_main_servant) ? 'checked' : '' }}>
                                                <label for="main_servant_yes">نعم (مسؤول رئيسي)</label>
                                            </div>
                                            <div class="radio-option">
                                                <input type="radio" id="main_servant_no" name="is_main_servant" value="0" {{ !old('is_main_servant', $profile->is_main_servant) ? 'checked' : '' }}>
                                                <label for="main_servant_no">لا (مساعد فقط)</label>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <!-- Church and Educational Data Tab -->
                                <div id="church" class="tab-pane">
                                    <h3 class="form-section-title">البيانات الكنسية والتعليمية والوظيفية</h3>
                                    <div class="input-group">
                                        <label for="promotion_rank"><i class="fas fa-cross"></i> الرتبة الكنسية:</label>
                                        <input type="text" class="form-control @error('promotion_rank') is-invalid @enderror" id="promotion_rank" name="promotion_rank" value="{{ old('promotion_rank', $profile->promotion_rank) }}">
                                        <span id="promotion_rank-error" class="invalid-feedback text-right"></span>
                                    </div>
                                    <div class="input-group">
                                        <label for="promotion_date"><i class="fas fa-calendar-alt"></i> تاريخ الترقية:</label>
                                        <input type="date" class="form-control @error('promotion_date') is-invalid @enderror" id="promotion_date" name="promotion_date" value="{{ old('promotion_date', $profile->promotion_date ? Carbon\Carbon::parse($profile->promotion_date)->format('Y-m-d') : '') }}">
                                        <span id="promotion_date-error" class="invalid-feedback text-right"></span>
                                    </div>
                                    <div class="input-group">
                                        <label for="promotion_by"><i class="fas fa-user-tie"></i> الترقية بواسطة:</label>
                                        <input type="text" class="form-control @error('promotion_by') is-invalid @enderror" id="promotion_by" name="promotion_by" value="{{ old('promotion_by', $profile->promotion_by) }}">
                                        <span id="promotion_by-error" class="invalid-feedback text-right"></span>
                                    </div>
                                    <div class="input-group">
                                        <label for="last_degree"><i class="fas fa-graduation-cap"></i> آخر شهادة علمية:</label>
                                        <input type="text" class="form-control @error('last_degree') is-invalid @enderror" id="last_degree" name="last_degree" value="{{ old('last_degree', $profile->last_degree) }}">
                                        <span id="last_degree-error" class="invalid-feedback text-right"></span>
                                    </div>
                                    <div class="input-group">
                                        <label for="job"><i class="fas fa-briefcase"></i> الوظيفة:</label>
                                        <input type="text" class="form-control @error('job') is-invalid @enderror" id="job" name="job" value="{{ old('job', $profile->job) }}">
                                        <span id="job-error" class="invalid-feedback text-right"></span>
                                    </div>
                                </div>

                                <!-- Password Change Tab -->
                                <div id="password" class="tab-pane">
                                    <h3 class="form-section-title">تغيير كلمة المرور</h3>
                                    <div class="input-group">
                                        <label for="current_password"><i class="fas fa-lock"></i> كلمة المرور الحالية:</label>
                                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                                        <span id="current_password-error" class="invalid-feedback text-right"></span>
                                    </div>
                                    <div class="input-group">
                                        <label for="new_password"><i class="fas fa-key"></i> كلمة المرور الجديدة:</label>
                                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password">
                                        <span id="new_password-error" class="invalid-feedback text-right"></span>
                                    </div>
                                    <div class="input-group">
                                        <label for="new_password_confirmation"><i class="fas fa-key"></i> تأكيد كلمة المرور الجديدة:</label>
                                        <input type="password" class="form-control @error('new_password_confirmation') is-invalid @enderror" id="new_password_confirmation" name="new_password_confirmation">
                                        <span id="new_password_confirmation-error" class="invalid-feedback text-right"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    حفظ التغييرات
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
    <script src="{{ asset('js/profile-validation.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#profile-form').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            var submitButton = $(form).find('button[type="submit"]');
            var originalText = submitButton.text();
            submitButton.prop('disabled', true).text('جاري الحفظ...');

            var formData = new FormData(form);
            console.log('سيتم إرسال البيانات التالية:', formData);
            for (var pair of formData.entries()) {
                console.log(pair[0]+ ':', pair[1]);
            }

            $.ajax({
                url: $(form).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log('تم الحفظ بنجاح:', response);
                    if (response.status === 'error') {
                        // عرض الأخطاء
                        $('.error-message').remove();
                        $('.is-invalid').removeClass('is-invalid');
                        $.each(response.errors, function(field, messages) {
                            var input = $('[name="' + field + '"]');
                            input.addClass('is-invalid');
                            input.after('<div class="error-message text-danger mt-1">' + messages[0] + '</div>');
                        });
                        if (response.field) {
                            $('html, body').animate({
                                scrollTop: $('[name="' + response.field + '"]').offset().top - 100
                            }, 500);
                        }
                    } else {
                        alert(response.message);
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500);
                    }
                },
                error: function(xhr) {
                    var response = xhr.responseJSON;
                    console.error('خطأ أثناء الحفظ:', xhr, response);
                    if (response && response.errors) {
                        $('.error-message').remove();
                        $('.is-invalid').removeClass('is-invalid');
                        $.each(response.errors, function(field, messages) {
                            var input = $('[name="' + field + '"]');
                            input.addClass('is-invalid');
                            input.after('<div class="error-message text-danger mt-1">' + messages[0] + '</div>');
                        });
                    } else {
                        alert('حدث خطأ أثناء حفظ البيانات');
                    }
                },
                complete: function() {
                    console.log('انتهى إرسال الطلب (complete)');
                    submitButton.prop('disabled', false).text(originalText);
                }
            });
        });
    });
    </script>
@endsection

<script>
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

    // Client-side validation logic for the edit form
    $(document).ready(function() {
        // Custom validation messages in Arabic
        const messages = {
            full_name: {
                required: 'الاسم الرباعي مطلوب.',
                regex: 'يجب ان يكون الاسم رباعي',
                unique: 'الاسم الرباعي موجود بالفعل.'
            },
            full_name_en: {
                regex: 'الاسم بالإنجليزي يجب أن يحتوي على حروف إنجليزية ومسافات فقط.'
            },
            username: {
                required: 'اسم المستخدم مطلوب.',
                unique: 'اسم المستخدم موجود بالفعل.'
            },
            national_id: {
                digits: 'الرقم القومي يجب أن يتكون من 14 رقم.',
                numeric: 'الرقم القومي يجب أن يكون أرقام فقط.',
                unique: 'الرقم القومي موجود بالفعل.'
            },
            phone: {
                regex: 'رقم الهاتف يجب أن يبدأ بـ 01 ويتكون من 11 رقم.'
            },
            whatsapp: {
                regex: 'رقم الواتساب يجب أن يبدأ بـ 01 ويتكون من 11 رقم.'
            },
            relative_phone: {
                regex: 'رقم هاتف أحد الأقارب يجب أن يبدأ بـ 01 ويتكون من 11 رقم.'
            },
            confession_father: {
                regex: 'اسم أب الاعتراف يجب أن يحتوي على حروف عربية ومسافات فقط.'
            },
            current_password: {
                required: 'كلمة المرور الحالية مطلوبة.',
                incorrect: 'كلمة المرور المدخلة غير صحيحة'
            },
            new_password: {
                required: 'كلمة المرور الجديدة مطلوبة.',
                min: 'كلمة المرور الجديدة يجب أن لا تقل عن 8 أحرف.',
                confirmed: 'كلمة المرور الجديدة وتأكيدها غير متطابقين.'
            },
            new_password_confirmation: {
                required: 'تأكيد كلمة المرور الجديدة مطلوب.',
                min: 'تأكيد كلمة المرور الجديدة يجب أن لا يقل عن 8 أحرف.'
            }
        };

        // Validation rules
        const rules = {
            full_name: {
                required: true,
                regex: /^[\u0600-\u06FF\s]+$/,
                fourNames: true // Custom rule for four Arabic names
            },
            full_name_en: {
                regex: /^[A-Za-z\s]+$/
            },
            username: {
                required: true,
                minlength: 3
            },
            national_id: {
                digits: 14,
                numeric: true
            },
            phone: {
                regex: /^01[0-9]{9}$/
            },
            whatsapp: {
                regex: /^01[0-9]{9}$/
            },
            relative_phone: {
                regex: /^01[0-9]{9}$/
            },
            confession_father: {
                regex: /^[\u0600-\u06FF\s]*$/
            },
            current_password: {
                required: function() {
                    return $('#new_password').val().length > 0 || $('#new_password_confirmation').val().length > 0;
                }
            },
            new_password: {
                minlength: 8,
                required: function() {
                    return $('#current_password').val().length > 0;
                }
            },
            new_password_confirmation: {
                equalTo: '#new_password',
                minlength: 8,
                required: function() {
                    return $('#new_password').val().length > 0;
                }
            },
            profile_image: {
                extension: "jpeg|png|jpg|gif|svg",
                maxsize: 2048 * 1024 // 2MB
            }
        };

        // Custom validation methods
        $.validator.addMethod('fourNames', function(value) {
            return value.split(/\s+/).length === 4;
        }, messages.full_name.regex);

        $.validator.addMethod('maxsize', function(value, element, param) {
            return this.optional(element) || (element.files[0].size <= param);
        }, 'حجم الملف يجب أن لا يتجاوز {0} بايت.');

        // Initialize form validation
        $('#profile-form').validate({
            rules: rules,
            messages: messages,
            errorElement: 'span',
            errorClass: 'text-danger',
            errorPlacement: function(error, element) {
                if (element.attr("name") == "profile_image") {
                    error.insertAfter(element.closest('.input-group'));
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            },
            submitHandler: function(form) {
                // Show loading state
                $('#submit-btn').prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> جاري الحفظ...');
                
                // Submit form via AJAX
                $.ajax({
                    url: $(form).attr('action'),
                    type: 'POST',
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            title: 'تم!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'حسناً'
                        }).then(() => {
                            location.reload(); // Reload page to reflect changes
                        });
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors;
                            Object.keys(errors).forEach(field => {
                                $(`#${field}`).addClass('is-invalid');
                                $(`#${field}-error`).text(errors[field][0]);
                            });
                            Swal.fire({
                                title: 'خطأ في التحقق!',
                                text: 'الرجاء مراجعة الحقول المدخلة.',
                                icon: 'error',
                                confirmButtonText: 'حسناً'
                            });
                        } else {
                            Swal.fire({
                                title: 'خطأ!',
                                text: 'حدث خطأ أثناء تحديث الملف الشخصي.',
                                icon: 'error',
                                confirmButtonText: 'حسناً'
                            });
                        }
                    },
                    complete: function() {
                        $('#submit-btn').prop('disabled', false).html('حفظ التغييرات');
                    }
                });
            }
        });

        // Real-time validation for password fields
        $('#new_password, #new_password_confirmation').on('input', function() {
            $('#profile-form').validate().element('#current_password');
            $('#profile-form').validate().element('#new_password');
            $('#profile-form').validate().element('#new_password_confirmation');
        });

        // Handle file input change for preview and size/type validation
        $('#profile_image').on('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#profile-image-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
            // Trigger validation for the file input
            $('#profile-form').validate().element(this);
        });

        // Initial tab activation based on server-side validation errors
        @if($errors->any())
            @if($errors->has('current_password') || $errors->has('new_password') || $errors->has('new_password_confirmation'))
                showTab('password');
            @elseif($errors->has('promotion_rank') || $errors->has('promotion_date') || $errors->has('promotion_by') || $errors->has('last_degree') || $errors->has('job'))
                showTab('church');
            @else
                showTab('personal');
            @endif
        @endif
    });
</script> 