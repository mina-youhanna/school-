@extends('layouts.app')

@section('title', 'تسجيل الدخول')

@section('content')
<div class="header-image">
    <img src="{{ asset('images/login.png') }}" alt="صورة مقدسة">
</div>

<div class="login-container">
    <h2>تسجيل الدخول</h2>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="input-group">
            <label for="email">
                <i class="fas fa-envelope"></i> البريد الإلكتروني
            </label>
            <input type="email" id="email" name="email" required autocomplete="email">
        </div>

        <div class="input-group password-group" style="position: relative;">
            <label for="password">
                <i class="fas fa-lock"></i> كلمة المرور
            </label>
            <input type="password" id="password" name="password" required autocomplete="current-password">
            <button type="button" class="toggle-password" aria-label="اظهار كلمة المرور"
                style="position: absolute; top: 50%; transform: translateY(-50%); right: 16px; background: none; border: none; color: #999; cursor: pointer; font-size: 20px;">
                <i class="fas fa-eye"></i>
            </button>
        </div>

        <div class="login-options">
            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">تذكرني</label>
            </div>
            <div class="forgot-password">
                <a href="{{ route('password.request') }}">هل نسيت كلمة المرور؟</a>
            </div>
        </div>

        <button type="submit" class="login-btn">
            <i class="fas fa-sign-in-alt"></i> تسجيل الدخول
        </button>

        <p class="register-link">ليس لديك حساب؟ <a href="{{ route('register') }}">إنشاء حساب</a></p>
    </form>
</div>
@endsection

@section('styles')
<style>
    body {
        font-family: 'Tajawal', sans-serif;
        background-size: 300px;
        background-repeat: repeat;
        background-blend-mode: multiply;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        min-height: 100vh;
        margin: 0;
        padding: 0;
        direction: rtl;
        position: relative;
    }

    .header-image {
        width: 100%;
        display: flex;
        justify-content: center;
        padding: 0;
        position: relative;
        z-index: 1;
        margin-top: 60px;
        margin-bottom: 0;
    }

    .header-image img {
        width: 600px; 
        max-width: 100%;
        display: block;
        position: relative;
        z-index: 1;
        margin-bottom: 0;
        pointer-events: none;
        -webkit-user-drag: none;
        box-shadow: none;
    }

    .login-container {
        width: 450px;
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0px 5px 25px rgba(0, 0, 0, 0.15);
        text-align: center;
        color: #333;
        position: relative;
        z-index: 2;
        margin: 0 auto;
        margin-top: -420px;
        transition: all 0.3s ease;
    }

    h2 {
        text-align: center;
        color: #0056b3;
        margin-bottom: 25px;
        font-size: 28px;
    }

    .input-group {
        text-align: right;
        margin-bottom: 20px;
        position: relative;
    }

    label {
        display: block;
        font-weight: bold;
        color: #0A2A4F;
        margin-bottom: 8px;
        font-size: 16px;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        background-color: #f9f9f9;
        color: #333;
        transition: all 0.3s ease;
        box-sizing: border-box;
        text-align: right;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.4);
        background-color: #fff;
        outline: none;
    }

    .input-group.password-group {
        position: relative;
    }
    .input-group.password-group input[type="password"] {
        width: 100%;
        padding-left: 44px; /* مساحة لزر العين */
        border-radius: 8px;
    }
    .input-group.password-group .toggle-password {
        position: absolute;
        top: 50%;
        left: 16px;
        right: auto;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #999;
        cursor: pointer;
        font-size: 20px;
        padding: 0;
        height: 32px;
        width: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .input-group.password-group .toggle-password:hover {
        color: #007bff;
    }

    .login-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .remember-me {
        display: flex;
        align-items: center;
    }

    .remember-me input[type="checkbox"] {
        width: 18px;
        height: 18px;
        margin-left: 8px;
        cursor: pointer;
        accent-color: #007bff;
    }

    .remember-me label {
        margin-bottom: 0;
        cursor: pointer;
        color: #555;
        font-weight: normal;
    }

    .forgot-password a {
        color: #007bff;
        text-decoration: none;
        transition: color 0.3s;
    }

    .forgot-password a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    .login-btn {
        width: 100%;
        padding: 14px;
        background: linear-gradient(to right, #007bff, #0069d9);
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 18px;
        font-weight: bold;
        transition: all 0.3s ease;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }

    .login-btn:hover {
        background: linear-gradient(to right, #0056b3, #004aa6);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .login-btn:active {
        transform: translateY(0);
    }

    .login-btn i {
        font-size: 20px;
    }

    .register-link {
        margin-top: 20px;
        text-align: center;
        color: #555;
        font-size: 16px;
    }

    .register-link a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
    }

    .register-link a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .header-image {
            margin-top: 100px;
        }
        
        .header-image img {
            width: 350px;
            margin-bottom: -80px;
        }
        
        .login-container {
            width: 90%;
            max-width: 450px;
            padding: 25px;
        }
    }

    @media (max-width: 480px) {
        .header-image {
            margin-top: 80px;
        }
        
        .header-image img {
            width: 280px;
            margin-bottom: -70px;
        }
        
        .login-container {
            width: 90%;
            padding: 20px;
        }
        
        h2 {
            font-size: 24px;
        }
        
        .login-options {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        
        .forgot-password {
            align-self: flex-end;
        }
    }

    @media (max-height: 700px) {
        .header-image {
            margin-top: 60px;
        }
        
        .header-image img {
            width: 250px;
            margin-bottom: -50px;
        }
    }

    [dir="rtl"] .input-group.password-group .toggle-password {
        left: 16px;
        right: auto;
    }
    [dir="ltr"] .input-group.password-group .toggle-password {
        right: 16px;
        left: auto;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.querySelector('.toggle-password');
        const passwordInput = document.querySelector('#password');
        
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
        
        const loginForm = document.querySelector('form');
        const loginBtn = document.querySelector('.login-btn');
        
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const originalText = loginBtn.innerHTML;
            loginBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري التسجيل...';
            loginBtn.disabled = true;
            
            this.submit();
        });
    });
</script>
@endsection 
