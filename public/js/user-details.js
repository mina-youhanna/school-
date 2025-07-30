// انتظار تحميل jQuery
if (typeof jQuery === 'undefined') {
    console.error('jQuery is not loaded!');
} else {
    console.log('jQuery is loaded successfully');
}

$(document).ready(function() {
    console.log('=== User Details JS Loaded ===');

    // تفعيل عرض/إخفاء كلمة المرور
    window.togglePassword = function() {
        const passwordField = document.getElementById('passwordField');
        const passwordIcon = document.getElementById('passwordIcon');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            passwordIcon.className = 'fas fa-eye-slash';
            passwordIcon.style.color = '#4CAF50';
        } else {
            passwordField.type = 'password';
            passwordIcon.className = 'fas fa-eye';
            passwordIcon.style.color = 'white';
        }
    };

    // تفعيل نسخ كلمة المرور
    window.copyPassword = function() {
        const passwordField = document.getElementById('passwordField');
        passwordField.select();
        passwordField.setSelectionRange(0, 99999);

        try {
            document.execCommand('copy');

            // إظهار رسالة نجاح
            Swal.fire({
                icon: 'success',
                title: 'تم النسخ بنجاح',
                text: 'تم نسخ كلمة المرور إلى الحافظة',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#4CAF50',
                color: 'white'
            });
        } catch (err) {
            console.error('فشل في نسخ النص: ', err);

            Swal.fire({
                icon: 'error',
                title: 'خطأ في النسخ',
                text: 'فشل في نسخ كلمة المرور',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#F44336',
                color: 'white'
            });
        }
    };

    // إضافة تأثيرات hover للبطاقات
    $('.info-card, .stats-card, .records-card').hover(
        function() {
            $(this).addClass('card-hover-effect');
        },
        function() {
            $(this).removeClass('card-hover-effect');
        }
    );

    // إضافة تأثيرات hover للأزرار
    $('.btn').hover(
        function() {
            $(this).addClass('btn-hover-effect');
        },
        function() {
            $(this).removeClass('btn-hover-effect');
        }
    );

    // إضافة تأثيرات focus للحقول
    $('.form-control, .form-select').focus(function() {
        $(this).addClass('field-focus-effect');
    }).blur(function() {
        $(this).removeClass('field-focus-effect');
    });

    // تحسين عرض التنبيهات
    $('.alert').each(function() {
        const $alert = $(this);

        // إضافة أيقونة للتنبيه
        if ($alert.hasClass('alert-success')) {
            $alert.prepend('<i class="fas fa-check-circle me-2"></i>');
        } else if ($alert.hasClass('alert-danger')) {
            $alert.prepend('<i class="fas fa-exclamation-circle me-2"></i>');
        } else if ($alert.hasClass('alert-warning')) {
            $alert.prepend('<i class="fas fa-exclamation-triangle me-2"></i>');
        } else if ($alert.hasClass('alert-info')) {
            $alert.prepend('<i class="fas fa-info-circle me-2"></i>');
        }

        // إضافة زر إغلاق
        if (!$alert.find('.btn-close').length) {
            $alert.append('<button type="button" class="btn-close" data-bs-dismiss="alert"></button>');
        }

        // إضافة تأثير ظهور
        $alert.hide().fadeIn(500);
    });

    // تحسين عرض الإحصائيات مع عداد متحرك
    function animateStats() {
        $('.stat-number').each(function() {
            const $this = $(this);
            const finalNumber = parseInt($this.text());
            const duration = 2000;
            const step = finalNumber / (duration / 16);
            let currentNumber = 0;

            const timer = setInterval(function() {
                currentNumber += step;
                if (currentNumber >= finalNumber) {
                    currentNumber = finalNumber;
                    clearInterval(timer);
                }
                $this.text(Math.floor(currentNumber));
            }, 16);
        });
    }

    // تشغيل عداد الإحصائيات عند ظهورها
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                animateStats();
                observer.unobserve(entry.target);
            }
        });
    });

    $('.stats-section').each(function() {
        observer.observe(this);
    });

    // تحسين عرض الجداول
    function optimizeTables() {
        $('.table-container').each(function() {
            const $container = $(this);
            const $table = $container.find('table');

            // إضافة scroll أفقي للجداول الكبيرة
            if ($table.width() > $container.width()) {
                $container.addClass('table-scrollable');
            }

            // إضافة تأثيرات للصفوف
            $table.find('tr').hover(
                function() {
                    $(this).addClass('row-hover-effect');
                },
                function() {
                    $(this).removeClass('row-hover-effect');
                }
            );
        });
    }

    optimizeTables();

    // تحسين عرض البطاقات على الموبايل
    function optimizeMobileCards() {
        if ($(window).width() <= 768) {
            $('.info-grid').addClass('mobile-grid');
            $('.stats-grid').addClass('mobile-stats-grid');
        } else {
            $('.info-grid').removeClass('mobile-grid');
            $('.stats-grid').removeClass('mobile-stats-grid');
        }
    }

    optimizeMobileCards();
    $(window).resize(optimizeMobileCards);

    // إضافة تأثيرات للشعارات (Badges)
    $('.badge').hover(
        function() {
            $(this).addClass('badge-hover-effect');
        },
        function() {
            $(this).removeClass('badge-hover-effect');
        }
    );

    // تحسين عرض شريط النسبة المئوية
    $('.percentage-bar').each(function() {
        const $bar = $(this);
        const $fill = $bar.find('.percentage-fill');
        const percentage = parseInt($fill.css('width'));

        // إضافة تأثير تحميل تدريجي
        $fill.css('width', '0%').animate({
            width: percentage + '%'
        }, 1500, 'easeOutQuart');
    });

    // إضافة تأثيرات للصور
    $('.user-avatar-large').hover(
        function() {
            $(this).addClass('avatar-hover-effect');
        },
        function() {
            $(this).removeClass('avatar-hover-effect');
        }
    );

    // تحسين عرض النماذج
    $('.form-control, .form-select').on('input change', function() {
        const $field = $(this);
        const $group = $field.closest('.form-group');

        if ($field.val()) {
            $group.addClass('has-value');
        } else {
            $group.removeClass('has-value');
        }
    });

    // إضافة تأثيرات للقوائم
    $('.info-item').hover(
        function() {
            $(this).addClass('info-item-hover');
        },
        function() {
            $(this).removeClass('info-item-hover');
        }
    );

    // تحسين عرض الأزرار على الموبايل
    function optimizeMobileButtons() {
        if ($(window).width() <= 768) {
            $('.header-actions').addClass('mobile-actions');
            $('.btn').addClass('mobile-btn');
        } else {
            $('.header-actions').removeClass('mobile-actions');
            $('.btn').removeClass('mobile-btn');
        }
    }

    optimizeMobileButtons();
    $(window).resize(optimizeMobileButtons);

    // إضافة تأثيرات للصفحة عند التحميل
    $('.user-details-page').addClass('page-loaded');

    // تحسين عرض التنبيهات
    function enhanceAlerts() {
        $('.alert').each(function() {
            const $alert = $(this);

            // إضافة تأثير ظهور
            $alert.hide().slideDown(500);

            // إضافة تأثير إغلاق
            $alert.find('.btn-close').click(function() {
                $alert.slideUp(300, function() {
                    $(this).remove();
                });
            });
        });
    }

    enhanceAlerts();

    console.log('=== User Details JS Initialization Complete ===');
});

// إضافة تأثيرات CSS إضافية
const userDetailsStyles = `
    .card-hover-effect {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
    }

    .btn-hover-effect {
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }

    .field-focus-effect {
        transform: scale(1.02);
        box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.3);
    }

    .row-hover-effect {
        background: rgba(255, 255, 255, 0.1) !important;
        transform: scale(1.01);
        transition: all 0.3s ease;
    }

    .badge-hover-effect {
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .avatar-hover-effect {
        transform: scale(1.1) rotate(5deg);
        box-shadow: 0 8px 25px rgba(76, 175, 80, 0.4);
    }

    .info-item-hover {
        background: rgba(255, 255, 255, 0.05);
        transform: translateX(5px);
        border-radius: 8px;
        padding-left: 15px;
    }

    .page-loaded {
        animation: pageLoad 1s ease-out;
    }

    @keyframes pageLoad {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .mobile-grid {
        grid-template-columns: 1fr !important;
        gap: 15px !important;
    }

    .mobile-stats-grid {
        grid-template-columns: 1fr !important;
        gap: 15px !important;
    }

    .mobile-actions {
        flex-direction: column !important;
        gap: 10px !important;
    }

    .mobile-btn {
        width: 100% !important;
        justify-content: center !important;
    }

    .table-scrollable {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .has-value .form-label {
        color: #4CAF50;
        transform: translateY(-5px) scale(0.9);
    }

    .form-group {
        position: relative;
        transition: all 0.3s ease;
    }

    .form-group.has-value {
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .info-card,
        .stats-card,
        .records-card {
            margin-bottom: 15px;
        }

        .card-content {
            padding: 20px;
        }

        .info-item {
            flex-direction: column;
            align-items: flex-start;
            gap: 5px;
        }

        .password-container {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .table-container {
            font-size: 12px;
        }

        .badge {
            font-size: 10px;
            padding: 4px 8px;
        }

        .stat-number {
            font-size: 20px;
        }

        .stat-label {
            font-size: 11px;
        }
    }

    @media (max-width: 480px) {
        .page-header {
            padding: 20px;
        }

        .title-icon {
            width: 50px;
            height: 50px;
            font-size: 20px;
        }

        .title-text h1 {
            font-size: 24px;
        }

        .card-header {
            padding: 15px 20px;
        }

        .card-header h3 {
            font-size: 16px;
        }

        .card-content {
            padding: 15px;
        }

        .info-item {
            padding: 8px 0;
        }

        .form-control,
        .form-select {
            font-size: 14px;
            padding: 10px 12px;
        }

        .btn {
            padding: 10px 15px;
            font-size: 14px;
        }

        .exam-results-table,
        .records-table {
            font-size: 11px;
        }

        .exam-results-table th,
        .records-table th {
            padding: 10px 6px;
            font-size: 12px;
        }

        .exam-results-table td,
        .records-table td {
            padding: 8px 6px;
            font-size: 11px;
        }
    }

    @media (max-width: 360px) {
        .page-header {
            padding: 15px;
        }

        .title-text h1 {
            font-size: 20px;
        }

        .title-text p {
            font-size: 14px;
        }

        .card-header {
            padding: 12px 15px;
        }

        .card-header h3 {
            font-size: 14px;
        }

        .card-content {
            padding: 12px;
        }

        .info-item {
            padding: 6px 0;
        }

        .form-control,
        .form-select {
            font-size: 13px;
            padding: 8px 10px;
        }

        .btn {
            padding: 8px 12px;
            font-size: 13px;
        }

        .exam-results-table,
        .records-table {
            font-size: 10px;
        }

        .exam-results-table th,
        .records-table th {
            padding: 8px 4px;
            font-size: 11px;
        }

        .exam-results-table td,
        .records-table td {
            padding: 6px 4px;
            font-size: 10px;
        }
    }
`;

// إضافة الأنماط للصفحة
if (!document.getElementById('user-details-additional-styles')) {
    const styleSheet = document.createElement('style');
    styleSheet.id = 'user-details-additional-styles';
    styleSheet.textContent = userDetailsStyles;
    document.head.appendChild(styleSheet);
    console.log('User details additional styles added');
}
