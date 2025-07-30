<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - مدرسة الشمامسة</title>

    <!-- إضافة خط تاجوال للغة العربية -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- إضافة أيقونات فونت أوسم -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- إضافة Bootstrap RTL CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet" />

    <!-- إضافة ملف CSS المحسن -->
    <link rel="stylesheet" href="{{ asset('css/enhanced-buttons.css') }}">

    <!-- jQuery -->
    <!-- jQuery Validation Plugin -->

    @stack('styles')

    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            overflow-x: hidden;
        }

        body {
            background-image: url('../images/download.png');
            /* Using existing asset */
            background-size: 300px;
            /* Using existing asset */
            background-color: #0A2A4F;
            /* Using existing asset */
            background-blend-mode: multiply;
            /* Using existing asset */
            font-family: 'Tajawal', sans-serif;
            direction: rtl;
            color: white;
            min-height: 100vh;
            margin: 0 !important;
            padding: 0 !important;
            width: 100%;
            overflow-x: hidden;
        }

        /* ======== Navigation Bar ======== */
        .navbar {
            z-index: 9999 !important;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100vw;
            height: 70px;
            background: rgba(10, 42, 79, 0.95);
            backdrop-filter: blur(15px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            margin: 0;
            box-sizing: border-box;
        }

        /* إضافة مساحة للمحتوى تحت الناف بار */
        main {
            padding-top: 70px;
            margin: 0;
            width: 100%;
        }

        /* ======== Logo Section ======== */
        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .logo-container {
            display: flex;
            align-items: center;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .logo-container:hover {
            transform: scale(1.05);
        }

        .logo-container img {
            height: 45px;
            width: 45px;
            border-radius: 50%;
            border: 2px solid rgba(255, 215, 0, 0.3);
            transition: border-color 0.3s ease;
        }

        .logo-container:hover img {
            border-color: #FFD700;
        }

        .logo-text {
            color: white;
            font-size: 1.1em;
            font-weight: 700;
            margin-right: 10px;
            white-space: nowrap;
        }

        /* ======== Main Navigation Menu ======== */
        .nav-menu {
            display: flex;
            align-items: center;
            flex: 1;
            justify-content: center;
            margin: 0 20px;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 5px;
            margin: 0;
            padding: 0;
        }

        .nav-links>li {
            position: relative;
        }

        .nav-links>li>a {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: white;
            text-decoration: none;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
            white-space: nowrap;
            font-size: 0.95em;
            position: relative;
        }

        .nav-links>li>a:hover {
            background: linear-gradient(135deg, #FFD700, #FFC107);
            color: #0A2A4F;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 215, 0, 0.4);
        }

        /* ======== Dropdown Menus ======== */
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: rgba(10, 42, 79, 0.98);
            backdrop-filter: blur(20px);
            min-width: 220px;
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 215, 0, 0.2);
            z-index: 1001;
            margin-top: 0 !important;
        }

        /* Desktop hover behavior */
        @media (min-width: 769px) {
            .dropdown:hover .dropdown-menu {
                display: block;
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
        }

        /* Desktop click behavior */
        .dropdown.active .dropdown-menu {
            display: block;
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu li {
            list-style: none;
        }

        .dropdown-menu a {
            display: block;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 5px;
        }

        .dropdown-menu a:hover {
            background: rgba(255, 215, 0, 0.1);
            color: #FFD700;
            transform: translateX(-5px);
        }

        /* Sub-dropdown */
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu .dropdown-menu {
            top: 0;
            right: 100%;
            margin-right: 10px;
        }

        /* Desktop hover behavior for sub-dropdowns */
        @media (min-width: 769px) {
            .dropdown-submenu:hover>.dropdown-menu {
                display: block;
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }
        }

        /* Desktop click behavior for sub-dropdowns */
        .dropdown-submenu.active>.dropdown-menu {
            display: block;
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* ======== User Section ======== */
        .user-section {
            display: flex;
            align-items: center;
            gap: 15px;
            flex-shrink: 0;
        }

        /* Points Display */
        .points-display {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 215, 0, 0.1);
            border: 1px solid rgba(255, 215, 0, 0.3);
            padding: 8px 15px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .points-display:hover {
            background: rgba(255, 215, 0, 0.2);
            transform: scale(1.05);
        }

        .points-display i {
            color: #FFD700;
            font-size: 16px;
        }

        .points-display span {
            font-weight: 600;
            font-size: 14px;
        }

        /* Notifications */
        .notifications {
            position: relative;
            cursor: pointer;
        }

        .notification-icon {
            font-size: 20px;
            color: white;
            transition: all 0.3s ease;
            padding: 10px;
            border-radius: 50%;
        }

        .notification-icon:hover {
            color: #FFD700;
            background: rgba(255, 215, 0, 0.1);
            animation: bell-shake 0.6s ease-in-out;
        }

        @keyframes bell-shake {

            0%,
            100% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(-10deg);
            }

            75% {
                transform: rotate(10deg);
            }
        }

        .notification-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            width: 280px;
            background: rgba(10, 42, 79, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 215, 0, 0.2);
            z-index: 1002;
        }

        .notifications:hover .notification-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .notification-header {
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            font-weight: 600;
            color: #FFD700;
        }

        .notification-item {
            padding: 15px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: background 0.3s ease;
        }

        .notification-item:hover {
            background: rgba(255, 215, 0, 0.05);
        }

        .notification-item:last-child {
            border-bottom: none;
        }

        /* User Profile */
        .user-profile {
            position: relative;
            cursor: pointer;
        }

        .profile-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: 2px solid rgba(255, 215, 0, 0.3);
            transition: all 0.3s ease;
            object-fit: cover;
        }

        .user-profile:hover .profile-avatar {
            border-color: #FFD700;
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(255, 215, 0, 0.4);
        }

        .profile-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            width: 200px;
            background: rgba(10, 42, 79, 0.98);
            backdrop-filter: blur(20px);
            border-radius: 10px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 215, 0, 0.2);
            z-index: 1002;
        }

        .user-profile:hover .profile-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .profile-dropdown a,
        .profile-dropdown button {
            display: block;
            width: 100%;
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            background: none;
            border: none;
            text-align: right;
            font-family: inherit;
            font-size: inherit;
            cursor: pointer;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 3px;
        }

        .profile-dropdown a:hover,
        .profile-dropdown button:hover {
            background: rgba(255, 215, 0, 0.1);
            color: #FFD700;
            transform: translateX(-5px);
        }

        /* Auth Buttons */
        .auth-buttons {
            display: flex;
            gap: 10px;
        }

        .auth-btn {
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .login-btn {
            background: transparent;
            border: 2px solid #FFD700;
            color: #FFD700;
        }

        .login-btn:hover {
            background: #FFD700;
            color: #0A2A4F;
            transform: translateY(-2px);
        }

        .register-btn {
            background: linear-gradient(135deg, #FFD700, #FFC107);
            color: #0A2A4F;
            border: 2px solid transparent;
        }

        .register-btn:hover {
            background: linear-gradient(135deg, #FFC107, #FFB300);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 215, 0, 0.4);
        }

        /* Mobile Menu Toggle */
        .mobile-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            padding: 5px;
            border-radius: 5px;
            transition: background 0.3s ease;
            /* New order for mobile */
            order: 2;
            /* Logo section will be order 1, this will be order 2 for right side */
        }

        .mobile-toggle:hover {
            background: rgba(255, 215, 0, 0.1);
        }

        .mobile-toggle span {
            width: 25px;
            height: 3px;
            background: white;
            margin: 3px 0;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .mobile-toggle.active span:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .mobile-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .mobile-toggle.active span:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }

        /* ======== Mobile Responsive ======== */
        @media (max-width: 768px) {
            .navbar {
                padding: 0 15px;
                justify-content: space-between;
                /* Ensure items are spaced */
            }

            .logo-section {
                order: 2;
                /* Move logo to the right */
            }

            .mobile-toggle {
                display: flex;
                order: 3;
                /* Move toggle to the far right */
                margin-right: 0;
                /* Adjust margin */
                margin-left: 15px;
                /* Space from right edge */
            }

            .user-section,
            .auth-buttons {
                order: 1;
                /* Move user/auth section to the far left */
                margin-left: auto;
                /* Push to left */
                margin-right: 0;
                /* Reset margin */
            }

            .nav-menu {
                position: fixed;
                top: 70px;
                right: -100%;
                width: 300px;
                height: calc(100vh - 70px);
                background: rgba(10, 42, 79, 0.98);
                backdrop-filter: blur(20px);
                transition: right 0.3s ease;
                padding: 20px 0;
                box-shadow: -5px 0 15px rgba(0, 0, 0, 0.3);
                overflow-y: auto;
            }

            .nav-menu.active {
                right: 0;
            }

            .nav-links {
                flex-direction: column;
                width: 100%;
                gap: 0;
            }

            .nav-links>li {
                width: 100%;
            }

            .nav-links>li>a {
                justify-content: flex-end;
                padding: 15px 25px;
                border-radius: 0;
                width: 100%;
            }

            .dropdown-menu {
                position: static;
                width: 100%;
                opacity: 1;
                visibility: visible;
                transform: none;
                background: rgba(10, 42, 79, 0.5);
                box-shadow: none;
                border: none;
                border-radius: 0;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.3s ease;
            }

            .dropdown.active .dropdown-menu {
                max-height: 500px;
            }

            .dropdown>a::after {
                content: "▼";
                margin-right: 10px;
                transition: transform 0.3s ease;
                font-size: 12px;
            }

            .dropdown.active>a::after {
                transform: rotate(180deg);
            }

            .dropdown-submenu>a::after {
                content: "◀";
                margin-right: 10px;
                transition: transform 0.3s ease;
                font-size: 12px;
            }

            .dropdown-submenu.active>a::after {
                transform: rotate(180deg);
            }

            .dropdown-menu a {
                padding-right: 45px;
            }

            .dropdown-submenu .dropdown-menu {
                right: 0;
                margin-right: 0;
            }

            .dropdown-submenu .dropdown-menu a {
                padding-right: 65px;
            }

            .logo-text {
                display: none;
            }

            .user-section {
                gap: 10px;
            }

            .points-display {
                padding: 6px 10px;
            }

            .points-display span {
                font-size: 12px;
            }

            .profile-avatar {
                width: 40px;
                height: 40px;
            }

            .notification-dropdown,
            .profile-dropdown {
                width: 250px;
                right: 0;
            }

            .profile-dropdown {
                left: auto;
                right: 0;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 0 10px;
            }

            .nav-menu {
                width: 100%;
                right: -100%;
            }

            .points-display {
                padding: 4px 8px;
            }

            .points-display span:not(.points-number) {
                display: none;
            }

            .auth-buttons {
                flex-direction: column;
                gap: 5px;
            }

            .auth-btn {
                padding: 8px 15px;
                font-size: 12px;
            }
        }

        @media (min-width: 769px) {

            .dropdown .dropdown-menu,
            .dropdown-submenu .dropdown-menu {
                display: none;
                opacity: 0;
                visibility: hidden;
                pointer-events: none;
                position: absolute;
                z-index: 2000;
                min-width: 220px;
                background: rgba(10, 42, 79, 0.98);
                border-radius: 10px;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
                transition: opacity 0.2s, visibility 0.2s;
            }

            .dropdown:hover>.dropdown-menu,
            .dropdown-submenu:hover>.dropdown-menu {
                display: block !important;
                opacity: 1 !important;
                visibility: visible !important;
                pointer-events: auto !important;
            }

            .dropdown-submenu .dropdown-menu {
                display: none;
                opacity: 0;
                visibility: hidden;
                pointer-events: none;
                position: absolute;
                right: 100%;
                top: 0;
                min-width: 200px;
                z-index: 2001;
                transition: opacity 0.2s, visibility 0.2s;
            }

            .dropdown-submenu:hover>.dropdown-menu {
                display: block !important;
                opacity: 1 !important;
                visibility: visible !important;
                pointer-events: auto !important;
            }

            .dropdown-submenu>.dropdown-menu {
                pointer-events: none;
            }

            .dropdown-submenu:hover>.dropdown-menu {
                pointer-events: auto;
            }
        }

        pre,
        .bible-chapter-text {
            color: #222 !important;
            background: #f9f9f9 !important;
        }
    </style>
    @yield('styles')
</head>

<body>
    <nav class="navbar">
        <!-- Logo Section -->
        <div class="logo-section">
            <a href="{{ route('st_stephens_school') }}" class="logo-container">
                <img src="{{ asset('images/logo.png') }}" alt="شعار المدرسة">
                <span class="logo-text">مدرسة الشمامسة</span>
            </a>
        </div>

        <!-- Mobile Menu Toggle -->
        <div class="mobile-toggle" onclick="toggleMobileMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>

        <!-- Main Navigation -->
        <div class="nav-menu">
            <ul class="nav-links">
                <li class="dropdown">
                    <a href="#" onclick="toggleDropdown(event, this)"> الكتاب المقدس</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('bible.old') }}">العهد القديم</a></li>
                        <li><a href="{{ route('bible.new') }}">العهد الجديد</a></li>
                        <li><a href="{{ route('daily_readings') }}">القراءات اليومية</a></li>
                    </ul>
                </li>
                @auth
                <li class="dropdown">
                    <a href="{{ route('st_stephens_school') }}" onclick="toggleDropdown(event, this)">🏫 مدرسة الشهيد إسطفانوس</a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-submenu">
                            <a href="{{ route('classes') }}" onclick="toggleDropdown(event, this)">📘 الفصول</a>
                        </li>
                        <li class="dropdown-submenu">
                            <a href="#" onclick="toggleDropdown(event, this)">🎶 خورس الكنيسة</a>
                        </li>
                        <li><a href="{{ route('curricula') }}">📚 المناهج</a></li>
                        <li><a href="#">📌 الكورسات</a></li>
                        <li><a href="#">🎮 العاب</a></li>
                        <li><a href="{{ route('gifts') }}">🎁 معرض الهدايا</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" onclick="toggleDropdown(event, this)">📚 المكتبات</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">📖 مكتبة الكتب</a></li>
                        <li><a href="{{ route('hymns.library') }}">مكتبة الألحان</a></li>
                        <li><a href="{{ route('photo-gallery.index') }}">🖼️ مكتبة صور</a></li>
                        <li><a href="{{ route('videos') }}">🎬 مكتبة فيديوهات</a></li>
                    </ul>
                </li>
                @if(auth()->user()->is_admin)
                <li class="dropdown">
                    <a href="#" onclick="toggleDropdown(event, this)">👨‍💼 لوحة التحكم</a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('admin.dashboard') }}">📊 لوحة القيادة</a></li>
                        <li><a href="{{ route('admin.users') }}">👥 إدارة المستخدمين</a></li>
                        <li><a href="{{ route('admin.classes.index') }}">📚 إدارة الفصول</a></li>
                        <li><a href="{{ route('admin.exams.index') }}">📝 إدارة الامتحانات</a></li>
                        <li><a href="{{ route('admin.attendance') }}">📊 إدارة الحضور والغياب</a></li>
                        <li><a href="{{ route('admin.enhanced-attendance.index') }}">📋 سجل الحضور المحسن</a></li>
                        <li><a href="{{ route('admin.enhanced-exams.index') }}">📝 سجل الامتحانات</a></li>
                        <li><a href="{{ route('admin.subscriptions.index') }}">💳 إدارة الاشتراكات</a></li>
                        <li><a href="{{ route('admin.reports') }}">📈 التقارير والإحصائيات</a></li>
                        <li><a href="#">📰 إدارة الأخبار</a></li>
                    </ul>
                </li>
                @endif
                @endauth
                <li><a href="#">📩 تواصل معنا</a></li>
                <li><a href="{{ route('home') }}">⛪ عن الكنيسة</a></li>
            </ul>
        </div>

        @auth
        <!-- User Section -->
        <div class="user-section">
            <!-- Points Display -->
            <div class="points-display">
                <i class="fas fa-star"></i>
                <span>النقاط:</span>
                <span class="points-number">{{ auth()->user()->score ?? 0 }}</span>
            </div>

            <!-- Notifications -->
            <div class="notifications">
                <i class="fas fa-bell notification-icon"></i>
                <div class="notification-dropdown">
                    <div class="notification-header">
                        الإشعارات
                    </div>
                    <div class="notification-item">
                        <strong>إشعار جديد</strong><br>
                        <small>تم إضافة درس جديد في المنهج</small>
                    </div>
                    <div class="notification-item">
                        <strong>تذكير</strong><br>
                        <small>امتحان غداً في الساعة 10 صباحاً</small>
                    </div>
                    <div class="notification-item">
                        <strong>تهنئة</strong><br>
                        <small>حصلت على 50 نقطة جديدة</small>
                    </div>
                </div>
            </div>

            <!-- User Profile -->
            <div class="user-profile">
                <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('images/default-avatar.png') }}" alt="الصورة الشخصية" class="profile-avatar">
                <div class="profile-dropdown">
                    <a href="{{ route('profile') }}">👤 بياناتي الشخصية</a>
                    <a href="{{ route('attendance') }}">📊 غيابي وحضوري</a>
                    <a href="{{ route('exams') }}">📝 درجات الامتحانات</a>
                    <a href="{{ route('subscriptions.my') }}">💳 اشتراكاتي</a>
                    @if(auth()->user()->is_admin)
                    <a href="{{ route('admin.dashboard') }}">👨‍💼 لوحة التحكم</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">🚪 تسجيل الخروج</button>
                    </form>
                </div>
            </div>
        </div>
        @else
        <!-- Auth Buttons (for non-logged users) -->
        <div class="auth-buttons">
            <a href="{{ route('login') }}" class="auth-btn login-btn">تسجيل الدخول</a>
            <a href="{{ route('register') }}" class="auth-btn register-btn">إنشاء حساب</a>
        </div>
        @endauth
    </nav>

    <!-- Main Content -->
    <main class="content">
        @yield('content')
    </main>

    <script>
        // Toggle Mobile Menu
        function toggleMobileMenu() {
            const toggle = document.querySelector('.mobile-toggle');
            const menu = document.querySelector('.nav-menu');

            toggle.classList.toggle('active');
            menu.classList.toggle('active');
            // Prevent body scroll when mobile menu is active
            if (menu.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
            // Close other main dropdowns if open
            const notifications = document.querySelector('.notifications');
            const userProfile = document.querySelector('.user-profile');
            if (notifications) notifications.classList.remove('active');
            if (userProfile) userProfile.classList.remove('active');
        }

        // Toggle Dropdown (للموبايل فقط)
        function toggleDropdown(event, element) {
            if (window.innerWidth <= 768) {
                event.preventDefault();
                const dropdown = element.closest('.dropdown, .dropdown-submenu');
                // أغلق كل القوائم الأخرى في نفس المستوى
                document.querySelectorAll('.dropdown, .dropdown-submenu').forEach(dd => {
                    if (dd !== dropdown) dd.classList.remove('active');
                });
                // بدّل حالة القائمة الحالية
                dropdown.classList.toggle('active');
                // تحكم في maxHeight
                const dropdownMenu = dropdown.querySelector('.dropdown-menu');
                if (dropdown.classList.contains('active')) {
                    dropdownMenu.style.maxHeight = dropdownMenu.scrollHeight + 'px';
                } else {
                    dropdownMenu.style.maxHeight = '0';
                }
            }
        }

        // Close mobile menu and other main dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const navbar = document.querySelector('.navbar');
            const mobileMenu = document.querySelector('.nav-menu');
            const toggle = document.querySelector('.mobile-toggle');
            const notifications = document.querySelector('.notifications');
            const userProfile = document.querySelector('.user-profile');

            if (!navbar.contains(event.target)) {
                if (mobileMenu) {
                    mobileMenu.classList.remove('active');
                    if (toggle) toggle.classList.remove('active');
                    document.body.style.overflow = ''; // Re-enable body scroll
                }
                if (notifications) notifications.classList.remove('active');
                if (userProfile) userProfile.classList.remove('active');

                // Close all nested dropdowns within the mobile menu
                document.querySelectorAll('.nav-menu .dropdown, .nav-menu .dropdown-submenu').forEach(dd => {
                    dd.classList.remove('active');
                    dd.querySelectorAll('.dropdown-menu').forEach(nestedMenu => {
                        if (window.innerWidth <= 768) {
                            nestedMenu.style.maxHeight = '0';
                        }
                    });
                });

                // Close all dropdowns in desktop mode
                if (window.innerWidth > 768) {
                    document.querySelectorAll('.dropdown, .dropdown-submenu').forEach(dd => {
                        dd.classList.remove('active');
                    });
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                const mobileMenu = document.querySelector('.nav-menu');
                const toggle = document.querySelector('.mobile-toggle');

                if (mobileMenu) mobileMenu.classList.remove('active');
                if (toggle) toggle.classList.remove('active');
                document.body.style.overflow = ''; // Re-enable body scroll

                // Reset all dropdowns
                document.querySelectorAll('.dropdown, .dropdown-submenu').forEach(dropdown => {
                    dropdown.classList.remove('active');
                    dropdown.querySelectorAll('.dropdown-menu').forEach(nestedMenu => {
                        nestedMenu.style.maxHeight = ''; // Remove inline style for desktop
                    });
                });
            } else {
                // Reset dropdowns for mobile
                document.querySelectorAll('.dropdown, .dropdown-submenu').forEach(dropdown => {
                    dropdown.classList.remove('active');
                    dropdown.querySelectorAll('.dropdown-menu').forEach(nestedMenu => {
                        nestedMenu.style.maxHeight = '0';
                    });
                });
            }
        });

        // Close mobile menu when navigating to other pages (only for non-dropdown links)
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', function(e) {
                // If it's a real link (not just a dropdown toggle) and not a # link that toggles a dropdown
                if (this.getAttribute('href') !== '#' || !this.closest('.dropdown')) {
                    const mobileMenu = document.querySelector('.nav-menu');
                    const toggle = document.querySelector('.mobile-toggle');
                    if (mobileMenu) mobileMenu.classList.remove('active');
                    if (toggle) toggle.classList.remove('active');
                    document.body.style.overflow = '';
                    // Close all active dropdowns in the side menu
                    document.querySelectorAll('.nav-menu .dropdown, .nav-menu .dropdown-submenu').forEach(dd => {
                        dd.classList.remove('active');
                        dd.querySelectorAll('.dropdown-menu').forEach(nestedMenu => {
                            if (window.innerWidth <= 768) {
                                nestedMenu.style.maxHeight = '0';
                            }
                        });
                    });

                    // Close all dropdowns in desktop mode
                    if (window.innerWidth > 768) {
                        document.querySelectorAll('.dropdown, .dropdown-submenu').forEach(dd => {
                            dd.classList.remove('active');
                        });
                    }
                }
            });
        });

        // Notifications and User Profile dropdown behavior for clicks (mobile and desktop)
        const notificationsContainer = document.querySelector('.notifications');
        const userProfileContainer = document.querySelector('.user-profile');

        if (notificationsContainer) {
            notificationsContainer.addEventListener('click', function(e) {
                e.stopPropagation();
                this.classList.toggle('active'); // Toggle active class on notifications
                if (userProfileContainer) userProfileContainer.classList.remove('active'); // Close user profile if open
                document.querySelector('.nav-menu').classList.remove('active'); // Close mobile menu if open
                document.querySelector('.mobile-toggle').classList.remove('active');
                document.body.style.overflow = '';
            });
        }

        if (userProfileContainer) {
            userProfileContainer.addEventListener('click', function(e) {
                e.stopPropagation();
                this.classList.toggle('active'); // Toggle active class on user profile
                if (notificationsContainer) notificationsContainer.classList.remove('active'); // Close notifications if open
                document.querySelector('.nav-menu').classList.remove('active'); // Close mobile menu if open
                document.querySelector('.mobile-toggle').classList.remove('active');
                document.body.style.overflow = '';
            });
        }

        // Close notification/profile dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (notificationsContainer && !notificationsContainer.contains(e.target)) {
                notificationsContainer.classList.remove('active');
            }
            if (userProfileContainer && !userProfileContainer.contains(e.target)) {
                userProfileContainer.classList.remove('active');
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
