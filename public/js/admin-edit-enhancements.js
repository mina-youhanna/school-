// ===== تحسينات JavaScript لصفحة تعديل المستخدم =====

document.addEventListener('DOMContentLoaded', function() {

    // ===== تحسين القوائم المنسدلة =====
    const selectElements = document.querySelectorAll('.form-select');

    selectElements.forEach(select => {
        // إضافة تأثير بصري عند التحديد
        select.addEventListener('change', function() {
            if (this.value) {
                this.classList.add('success');
                this.style.borderColor = '#4CAF50';
                this.style.boxShadow = '0 0 0 0.2rem rgba(76, 175, 80, 0.25)';

                // إزالة التأثير بعد ثانيتين
                setTimeout(() => {
                    this.classList.remove('success');
                }, 2000);
            } else {
                this.style.borderColor = 'rgba(255, 255, 255, 0.3)';
                this.style.boxShadow = 'none';
            }
        });

        // تحسين التفاعل مع الخيارات
        select.addEventListener('focus', function() {
            this.style.transform = 'scale(1.02)';
            this.style.zIndex = '1000';
        });

        select.addEventListener('blur', function() {
            this.style.transform = 'scale(1)';
            this.style.zIndex = 'auto';
        });
    });

    // ===== تحسين حقول الإدخال =====
    const inputElements = document.querySelectorAll('.form-control');

    inputElements.forEach(input => {
        // إضافة تأثير عند الكتابة
        input.addEventListener('input', function() {
            if (this.value.length > 0) {
                this.classList.add('success');
                this.style.borderColor = '#4CAF50';
                this.style.boxShadow = '0 0 0 0.2rem rgba(76, 175, 80, 0.25)';

                // إزالة التأثير بعد ثانيتين
                setTimeout(() => {
                    this.classList.remove('success');
                }, 2000);
            } else {
                this.style.borderColor = 'rgba(255, 255, 255, 0.3)';
                this.style.boxShadow = 'none';
            }
        });

        // تحسين التفاعل مع التركيز
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'translateY(-2px)';
            this.style.transform = 'scale(1.02)';
        });

        input.addEventListener('blur', function() {
            this.parentElement.style.transform = 'translateY(0)';
            this.style.transform = 'scale(1)';
        });
    });

    // ===== تحسين حقول التاريخ =====
    const dateInputs = document.querySelectorAll('input[type="date"]');

    dateInputs.forEach(input => {
        input.addEventListener('change', function() {
            if (this.value) {
                this.classList.add('success');
                this.style.borderColor = '#4CAF50';
                this.style.boxShadow = '0 0 0 0.2rem rgba(76, 175, 80, 0.25)';

                // إزالة التأثير بعد ثانيتين
                setTimeout(() => {
                    this.classList.remove('success');
                }, 2000);
            }
        });
    });

    // ===== تحسين حقول الاختيار =====
    const checkboxInputs = document.querySelectorAll('.form-check-input');

    checkboxInputs.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const parentGroup = this.closest('.form-group');

            if (this.checked) {
                parentGroup.style.transform = 'translateX(5px)';
                parentGroup.style.background = 'rgba(76, 175, 80, 0.1)';
                parentGroup.style.borderRadius = '8px';
                parentGroup.style.padding = '10px';

                // إزالة التأثير بعد ثانية
                setTimeout(() => {
                    parentGroup.style.transform = 'translateX(0)';
                    parentGroup.style.background = 'transparent';
                    parentGroup.style.borderRadius = '0';
                    parentGroup.style.padding = '0';
                }, 1000);
            }
        });
    });

    // ===== تحسين أزرار النموذج =====
    const formButtons = document.querySelectorAll('.save-btn, .cancel-btn');

    formButtons.forEach(button => {
        // تأثير عند الضغط
        button.addEventListener('mousedown', function() {
            this.style.transform = 'translateY(2px) scale(0.98)';
        });

        button.addEventListener('mouseup', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });

        // تأثير عند التمرير
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
        });

        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // ===== تحسين أقسام النموذج =====
    const formSections = document.querySelectorAll('.form-section');

    formSections.forEach(section => {
        // تأثير عند التمرير
        section.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
            this.style.boxShadow = '0 8px 25px rgba(0, 0, 0, 0.15)';
        });

        section.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });

    // ===== تحسين حقول كلمة المرور =====
    const passwordToggleBtn = document.querySelector('.toggle-password-btn');
    const passwordField = document.getElementById('password');
    const confirmPasswordField = document.getElementById('password_confirmation');

    if (passwordToggleBtn && passwordField) {
        passwordToggleBtn.addEventListener('click', function() {
            // تأثير بصري عند الضغط
            this.style.transform = 'scale(0.95)';

            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    }

    // ===== تحسين التحقق من كلمة المرور =====
    if (passwordField && confirmPasswordField) {
        // إظهار/إخفاء حقل التأكيد
        function toggleConfirmPassword() {
            if (passwordField.value.length > 0) {
                confirmPasswordField.required = true;
                confirmPasswordField.parentElement.style.display = 'block';
                confirmPasswordField.parentElement.style.animation = 'slideIn 0.3s ease';
            } else {
                confirmPasswordField.required = false;
                confirmPasswordField.value = '';
                confirmPasswordField.parentElement.style.display = 'none';
            }
        }

        // التحقق من تطابق كلمة المرور
        function validatePasswordMatch() {
            if (passwordField.value && confirmPasswordField.value) {
                if (passwordField.value === confirmPasswordField.value) {
                    confirmPasswordField.classList.add('success');
                    confirmPasswordField.style.borderColor = '#4CAF50';
                    confirmPasswordField.style.boxShadow = '0 0 0 0.2rem rgba(76, 175, 80, 0.25)';
                } else {
                    confirmPasswordField.classList.add('is-invalid');
                    confirmPasswordField.style.borderColor = '#F44336';
                    confirmPasswordField.style.boxShadow = '0 0 0 0.2rem rgba(244, 67, 54, 0.25)';
                }
            }
        }

        passwordField.addEventListener('input', toggleConfirmPassword);
        confirmPasswordField.addEventListener('input', validatePasswordMatch);

        // تشغيل التحقق عند تحميل الصفحة
        toggleConfirmPassword();
    }

    // ===== تحسين حقول الشماسية =====
    const isDeaconCheckbox = document.getElementById('is_deacon');
    const deaconFields = document.querySelectorAll('.deacon-field');

    if (isDeaconCheckbox) {
        isDeaconCheckbox.addEventListener('change', function() {
            const isChecked = this.checked;

            deaconFields.forEach(field => {
                if (isChecked) {
                    field.style.display = 'block';
                    field.style.animation = 'slideIn 0.5s ease';
                } else {
                    field.style.display = 'none';
                }
            });
        });
    }

    // ===== تحسين النموذج عند الإرسال =====
    const editForm = document.getElementById('editUserForm');

    if (editForm) {
        editForm.addEventListener('submit', function(e) {
            const saveBtn = document.querySelector('.save-btn');
            const originalText = saveBtn.innerHTML;

            // تغيير نص الزر أثناء الإرسال
            saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>جاري الحفظ...</span>';
            saveBtn.disabled = true;
            saveBtn.style.opacity = '0.7';

            // إضافة تأثير التحميل
            const formSections = document.querySelectorAll('.form-section');
            formSections.forEach(section => {
                section.classList.add('loading');
            });

            // إعادة النص الأصلي بعد ثانيتين (في حالة عدم وجود استجابة)
            setTimeout(() => {
                saveBtn.innerHTML = originalText;
                saveBtn.disabled = false;
                saveBtn.style.opacity = '1';

                formSections.forEach(section => {
                    section.classList.remove('loading');
                });
            }, 2000);
        });
    }

    // ===== تحسين التفاعل مع الجداول =====
    const tableRows = document.querySelectorAll('.exam-results-table tr, .records-table tr');

    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.01)';
            this.style.background = 'rgba(255, 255, 255, 0.08)';
        });

        row.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
            this.style.background = 'transparent';
        });
    });

    // ===== تحسين شارات النقاط والتقييم =====
    const scoreBadges = document.querySelectorAll('.score-badge, .evaluation-badge');

    scoreBadges.forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
            this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.3)';
        });

        badge.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
            this.style.boxShadow = '0 2px 8px rgba(0, 0, 0, 0.2)';
        });
    });

    // ===== تحسين أشرطة النسبة المئوية =====
    const percentageBars = document.querySelectorAll('.percentage-bar');

    percentageBars.forEach(bar => {
        const fill = bar.querySelector('.percentage-fill');
        if (fill) {
            // تحريك شريط النسبة المئوية عند التمرير
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const width = fill.style.width;
                        fill.style.width = '0%';
                        setTimeout(() => {
                            fill.style.width = width;
                        }, 100);
                    }
                });
            });

            observer.observe(bar);
        }
    });

    // ===== تحسين التصميم المتجاوب =====
    function handleResponsiveDesign() {
        const isMobile = window.innerWidth <= 768;
        const isTablet = window.innerWidth <= 1024;

        // تعديل حجم الخط للشاشات الصغيرة
        if (isMobile) {
            document.body.style.fontSize = '14px';
        } else if (isTablet) {
            document.body.style.fontSize = '15px';
        } else {
            document.body.style.fontSize = '16px';
        }

        // تعديل تخطيط النموذج
        const formGrid = document.querySelector('.form-grid');
        if (formGrid) {
            if (isMobile) {
                formGrid.style.gridTemplateColumns = '1fr';
                formGrid.style.gap = '20px';
            } else if (isTablet) {
                formGrid.style.gridTemplateColumns = 'repeat(auto-fit, minmax(300px, 1fr))';
                formGrid.style.gap = '25px';
            } else {
                formGrid.style.gridTemplateColumns = 'repeat(auto-fit, minmax(400px, 1fr))';
                formGrid.style.gap = '30px';
            }
        }
    }

    // تشغيل التحسين عند تحميل الصفحة وتغيير حجم النافذة
    handleResponsiveDesign();
    window.addEventListener('resize', handleResponsiveDesign);

    // ===== تحسين الأداء =====
    // إضافة تأخير للبحث في النموذج
    let searchTimeout;
    const searchInputs = document.querySelectorAll('input[type="text"], input[type="email"]');

    searchInputs.forEach(input => {
        input.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                // يمكن إضافة منطق البحث هنا
                console.log('Searching for:', this.value);
            }, 300);
        });
    });

    // ===== تحسين إمكانية الوصول =====
    // إضافة دعم لوحة المفاتيح
    document.addEventListener('keydown', function(e) {
        // حفظ النموذج بـ Ctrl+S
        if (e.ctrlKey && e.key === 's') {
            e.preventDefault();
            const saveBtn = document.querySelector('.save-btn');
            if (saveBtn) {
                saveBtn.click();
            }
        }

        // إلغاء بـ Escape
        if (e.key === 'Escape') {
            const cancelBtn = document.querySelector('.cancel-btn');
            if (cancelBtn) {
                cancelBtn.click();
            }
        }
    });

    // ===== تحسين تجربة المستخدم =====
    // إضافة رسائل تأكيد
    const formInputs = document.querySelectorAll('input, select, textarea');

    formInputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (this.value && this.checkValidity()) {
                // إضافة تأثير النجاح
                this.style.borderColor = '#4CAF50';
                this.style.boxShadow = '0 0 0 0.2rem rgba(76, 175, 80, 0.25)';

                setTimeout(() => {
                    this.style.borderColor = 'rgba(255, 255, 255, 0.3)';
                    this.style.boxShadow = 'none';
                }, 2000);
            }
        });
    });

    console.log('✅ تم تحميل تحسينات صفحة تعديل المستخدم بنجاح!');
});

// ===== دوال مساعدة =====

// دالة للتحكم في حقول الشماسية
function toggleDeaconFields() {
    const isDeacon = document.getElementById('is_deacon').checked;
    const deaconFields = document.querySelectorAll('.deacon-field');

    deaconFields.forEach(field => {
        if (isDeacon) {
            field.style.display = 'block';
            field.style.animation = 'slideIn 0.5s ease';
        } else {
            field.style.display = 'none';
        }
    });
}

// دالة لتبديل عرض كلمة المرور
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

// دالة لنسخ كلمة المرور
function copyPassword() {
    const passwordField = document.getElementById('passwordField');
    if (passwordField) {
        passwordField.select();
        document.execCommand('copy');

        // إظهار رسالة نجاح
        showNotification('تم نسخ كلمة المرور بنجاح!', 'success');
    }
}

// دالة لإظهار الإشعارات
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;

    // إضافة الأنماط
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        z-index: 10000;
        animation: slideInRight 0.3s ease;
        max-width: 300px;
    `;

    // تحديد اللون حسب النوع
    if (type === 'success') {
        notification.style.background = 'linear-gradient(135deg, #4CAF50, #45a049)';
    } else if (type === 'error') {
        notification.style.background = 'linear-gradient(135deg, #F44336, #D32F2F)';
    } else {
        notification.style.background = 'linear-gradient(135deg, #2196F3, #1976D2)';
    }

    document.body.appendChild(notification);

    // إزالة الإشعار بعد 3 ثوان
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}

// إضافة أنماط CSS للرسوم المتحركة
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }

    .notification {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
    }
`;
document.head.appendChild(style);
