<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - مدرسة الشمامسة</title>
    
    <!-- إضافة خط تاجوال للغة العربية -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- إضافة أيقونات فونت أوسم -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Reset and Base Styles */
        body {
            margin: 0;
            padding: 0;
            background-image: url('../images/download.png');
            background-size: 300px;
            background-color: #0A2A4F;
            background-blend-mode: multiply;
            font-family: 'Tajawal', sans-serif;
            text-align: center;
            direction: rtl;
            color: white;
        }

        /* ======== Main Navigation Bar ======== */
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #0A2A4F !important;
            padding: 0 20px;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            height: 60px;
            box-sizing: border-box;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .logo-container {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .logo-container img {
            height: 40px;
            width: auto;
        }

        /* ======== Main Menu ======== */
        .links {
            flex: 1;
            display: flex;
            justify-content: flex-start;
            margin-right: 20px;
        }

        .links ul {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
        }

        .links ul li {
            position: relative;
        }

        .links ul li a {
            display: inline-block;
            padding: 12px 15px;
            border-radius: 8px;
            transition: all 0.3s ease-in-out;
            color: white;
            text-decoration: none;
            font-weight: bold;
            background: transparent !important;
        }

        .links ul li a:hover {
            background: linear-gradient(90deg, #FFD700, #FFC107) !important;
            color: black !important;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.7);
            transform: scale(1.05);
        }

        /* ======== Dropdown Menus ======== */
        .dropdown-menu {
            display: none;
            position: absolute;
            background: #0A2A4F;
            min-width: 220px;
            top: 100%;
            right: 0;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            padding: 5px 0;
            text-align: right;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out, transform 0.3s ease-in-out;
            z-index: 1001;
        }

        .dropdown:hover > .dropdown-menu {
            display: block;
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .dropdown-menu li {
            width: 100%;
        }

        .dropdown-menu li a {
            padding: 10px 15px;
            width: 100%;
            display: block;
            box-sizing: border-box;
        }

        /* Nested dropdowns (pointing left) */
        .dropdown-left .dropdown-menu {
            right: 100%;
            left: auto;
            top: 0;
        }

        .dropdown-left {
            position: relative;
        }

        .dropdown-left:hover > .dropdown-menu {
            display: block;
            opacity: 1;
            visibility: visible;
        }

        /* ======== Auth Buttons ======== */
        .auth-buttons {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .auth-btn {
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: bold;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .login-btn {
            background: transparent;
            border: 2px solid #FFD700;
            color: #FFD700;
        }

        .login-btn:hover {
            background: #FFD700;
            color: #0A2A4F;
        }

        .register-btn {
            background: #FFD700;
            color: #0A2A4F;
        }

        .register-btn:hover {
            background: #FFC107;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 215, 0, 0.3);
        }

        /* ======== User Interface Elements ======== */
        .user-interface {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* Points counter */
        #score {
            font-size: 16px;
            color: white;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: color 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        #score:hover {
            color: #FFD700;
            transform: scale(1.1);
        }

        /* Bell and notifications */
        .notifications {
            position: relative;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        #bell-icon {
            font-size: 24px;
            color: white;
            transition: color 0.3s ease-in-out;
        }

        #bell-icon:hover {
            color: #FFD700;
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0% { transform: rotate(0deg); }
            20% { transform: rotate(-15deg); }
            40% { transform: rotate(15deg); }
            60% { transform: rotate(-10deg); }
            80% { transform: rotate(10deg); }
            100% { transform: rotate(0deg); }
        }

        .notifications-menu {
            position: absolute;
            top: 40px;
            right: -80px;
            background: #0A2A4F;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
            width: 220px;
            text-align: right;
            display: none;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out, transform 0.3s ease-in-out;
            z-index: 1002;
        }

        .notifications-menu li {
            list-style: none;
            padding: 10px;
            color: white;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }

        .notifications-menu li:last-child {
            border-bottom: none;
        }

        /* User profile */
        .user-profile {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid white;
            transition: border-color 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        .user-profile img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .user-profile:hover {
            border-color: #FFD700;
            transform: scale(1.1);
        }

        /* ======== Mobile Navigation ======== */
        .menu-toggle {
            display: none;
            font-size: 28px;
            color: white;
            cursor: pointer;
            transition: color 0.3s ease-in-out;
        }

        .menu-toggle:hover {
            color: #FFD700;
        }

        /* ======== Responsive Styles ======== */
        @media (max-width: 992px) {
            .menu-toggle {
                display: block;
            }
            
            .links {
                position: absolute;
                top: 60px;
                right: 0;
                width: 100%;
                margin: 0;
            }
            
            .links ul {
                flex-direction: column;
                background: #0A2A4F;
                width: 100%;
                max-height: 0;
                overflow: hidden;
                transition: max-height 0.5s ease;
                padding: 0;
                margin: 0;
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
            }
            
            .links.active ul {
                max-height: 500px;
                padding: 10px 0;
            }
            
            .links ul li {
                width: 100%;
                text-align: right;
            }
            
            .links ul li a {
                display: block;
                width: 100%;
                padding: 12px 20px;
                box-sizing: border-box;
            }

            /* Dropdown Adjustments */
            .dropdown-menu {
                position: static;
                background: rgba(10, 42, 79, 0.8);
                box-shadow: none;
                width: 100%;
                max-height: 0;
                padding: 0;
                overflow: hidden;
                opacity: 1;
                visibility: visible;
                transform: none;
                transition: max-height 0.5s ease;
            }
            
            .dropdown.active > .dropdown-menu {
                max-height: 500px;
                padding: 5px 0;
            }
            
            .dropdown-menu li a {
                padding-right: 40px;
            }
            
            .dropdown-menu .dropdown-menu li a {
                padding-right: 60px;
            }
            
            /* Dropdown icons */
            .dropdown > a::after,
            .dropdown-left > a::after {
                content: " ▼";
                color: #FFD700;
                font-size: 12px;
                margin-right: 5px;
            }

            .auth-buttons {
                display: none;
            }
        }

        @media (max-width: 576px) {
            .logo-container span {
                display: none;
            }
            
            .user-interface {
                gap: 10px;
            }
            
            #score {
                font-size: 12px;
            }
            
            #score span {
                display: none;
            }
            
            .user-profile {
                width: 35px;
                height: 35px;
            }
            
            .notifications-menu {
                right: -50px;
                width: 180px;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <nav>
        <div class="nav-left">
            <a href="{{ route('home') }}" class="logo-container">
                <img src="{{ asset('images/logo.png') }}" alt="شعار المدرسة">
            </a>
        </div>

        <div class="links">
            <ul>
                <li><a href="{{ route('home') }}">🏠 الرئيسية</a></li>

                <li class="dropdown">
                    <a href="#">📚 المكتبات</a>
                    <ul class="dropdown-menu">
                        <li><a href="#">📖 مكتبة الكتب</a></li>
                        <li><a href="#">🎵 مكتبة الألحان</a></li>
                        <li><a href="{{ route('photo') }}">🖼️ مكتبة صور</a></li>
                        <li><a href="{{ route('videos') }}">🎬 مكتبة فيديوهات</a></li>
                    </ul>
                </li>

                <li class="dropdown">
                <a href="{{ route('st_stephens_school') }}">🏫 مدرسة الشهيد استفانوس</a>
                <ul class="dropdown-menu">
                        <li class="dropdown-left">
                            <a href="{{ route('classes') }}">📘 الفصول</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('boys_classes') }}">📘 فصول الأولاد</a></li>
                                <li><a href="{{ route('girls_classes') }}">📗 فصول البنات</a></li>
                            </ul>
                        </li>
                        
                        <li class="dropdown-left">
                            <a href="#">🎶 خورس الكنيسة</a>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('chorus') }}">🎤 خورس الأولاد</a></li>
                                <li><a href="{{ route('girls_chorus') }}">🎵 خورس البنات</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('curricula') }}">📚 المناهج</a></li>
                        <li><a href="{{ route('home') }}">📝 الامتحانات</a></li>
                        <li><a href="#">📌 الكورسات</a></li>
                        <li><a href="#">🎮 العاب</a></li> 
                        <li><a href="{{ route('products') }}">🎁 معرض الأوزي</a></li>
                    </ul>
                </li>

                <li><a href="#">📩 تواصل معنا</a></li>
            </ul>
        </div>

        @guest
            <div class="auth-buttons">
                <a href="{{ route('login') }}" class="auth-btn login-btn">تسجيل الدخول</a>
                <a href="{{ route('register') }}" class="auth-btn register-btn">إنشاء حساب</a>
            </div>
        @else
            <div class="user-interface">
                <span id="score"><span>Point</span> 100</span>
                <div class="notifications">
                    <i id="bell-icon" class="fa-solid fa-bell"></i>
                    <ul class="notifications-menu">
                        <li>📢 إشعار 1</li>
                        <li>📢 إشعار 2</li>
                        <li>📢 إشعار 3</li>
                    </ul>
                </div>
                <a href="{{ route('profile') }}" class="user-profile">
                    <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : asset('images/default-avatar.png') }}" alt="الصورة الشخصية" id="user-avatar">
                </a>
            </div>
        @endguest
    </nav>

    <main>
        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add hamburger menu button for mobile
            const nav = document.querySelector('nav');
            const menuToggle = document.createElement('div');
            menuToggle.className = 'menu-toggle';
            menuToggle.innerHTML = '&#9776;'; // Hamburger icon
            nav.prepend(menuToggle);

            // Target links container
            const linksContainer = document.querySelector('.links');
            
            // Toggle menu open/close
            menuToggle.addEventListener('click', function() {
                linksContainer.classList.toggle('active');
                
                // Change button appearance on toggle
                if (linksContainer.classList.contains('active')) {
                    menuToggle.innerHTML = '&times;'; // Close icon
                } else {
                    menuToggle.innerHTML = '&#9776;'; // Hamburger icon
                }
            });

            // Handle dropdown menus on mobile
            const dropdowns = document.querySelectorAll('.dropdown, .dropdown-left');
            
            dropdowns.forEach(dropdown => {
                const link = dropdown.querySelector('a');
                
                link.addEventListener('click', function(e) {
                    // Only intercept clicks on mobile view
                    if (window.innerWidth <= 992) {
                        e.preventDefault();
                        dropdown.classList.toggle('active');
                        
                        // Close other dropdowns
                        dropdowns.forEach(other => {
                            if (other !== dropdown && !dropdown.contains(other)) {
                                other.classList.remove('active');
                            }
                        });
                    }
                });
            });

            // Close menu when clicking outside
            document.addEventListener('click', function(e) {
                if (!nav.contains(e.target)) {
                    linksContainer.classList.remove('active');
                    dropdowns.forEach(dropdown => {
                        dropdown.classList.remove('active');
                    });
                    menuToggle.innerHTML = '&#9776;';
                }
            });

            // Close menu when navigating to other pages
            document.querySelectorAll('.links ul li a').forEach(link => {
                if (!link.parentElement.classList.contains('dropdown') && 
                    !link.parentElement.classList.contains('dropdown-left')) {
                    link.addEventListener('click', function() {
                        linksContainer.classList.remove('active');
                        menuToggle.innerHTML = '&#9776;';
                    });
                }
            });

            // Reset menu state when resizing screen
            window.addEventListener('resize', function() {
                if (window.innerWidth > 992) {
                    linksContainer.classList.remove('active');
                    dropdowns.forEach(dropdown => {
                        dropdown.classList.remove('active');
                    });
                    menuToggle.innerHTML = '&#9776;';
                }
            });

            // Notifications bell behavior
            const bellIcon = document.getElementById('bell-icon');
            const notificationsMenu = document.querySelector('.notifications-menu');
            
            if (bellIcon && notificationsMenu) {
                bellIcon.addEventListener('click', function(e) {
                    e.stopPropagation();
                    
                    // Toggle notifications display
                    if (notificationsMenu.style.display === 'block') {
                        notificationsMenu.style.display = 'none';
                        notificationsMenu.style.opacity = '0';
                        notificationsMenu.style.visibility = 'hidden';
                    } else {
                        notificationsMenu.style.display = 'block';
                        notificationsMenu.style.opacity = '1';
                        notificationsMenu.style.visibility = 'visible';
                    }
                });

                // Close notifications when clicking elsewhere
                document.addEventListener('click', function() {
                    notificationsMenu.style.display = 'none';
                    notificationsMenu.style.opacity = '0';
                    notificationsMenu.style.visibility = 'hidden';
                });

                // Prevent closing when clicking inside the menu
                notificationsMenu.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html> 