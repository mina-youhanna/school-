@extends('layouts.app')

@section('title', 'نسيت كلمة المرور')

@section('content')
<div class="header-image">
    <img src="{{ asset('images/632480d916e24e1f8f1c886042cc3aa5.png') }}" alt="صورة مقدسة">
</div>

<div class="login-container">
    <h2>نسيت كلمة المرور</h2>
    <p class="description">أدخل بريدك الإلكتروني وسنرسل لك رابطاً لإعادة تعيين كلمة المرور</p>
    
    <form action="{{ route('password.email') }}" method="POST">
        @csrf
        <div class="input-group">
            <label for="email">
                <i class="fas fa-envelope"></i> البريد الإلكتروني
            </label>
            <input type="email" id="email" name="email" required autocomplete="email">
        </div>

        <button type="submit" class="login-btn">
            <i class="fas fa-paper-plane"></i> إرسال رابط إعادة التعيين
        </button>

        <p class="register-link">
            <a href="{{ route('login') }}">
                <i class="fas fa-arrow-right"></i> العودة لتسجيل الدخول
            </a>
        </p>
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
        margin-top: 130px;
    }

    .header-image img {
        width: 450px; 
        max-width: 100%;
        display: block;
        position: relative;
        z-index: 1;
        margin-bottom: -100px;
        pointer-events: none;
        -webkit-user-drag: none;
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
        transition: all 0.3s ease;
    }

    h2 {
        text-align: center;
        color: #0056b3;
        margin-bottom: 15px;
        font-size: 28px;
    }

    .description {
        color: #666;
        margin-bottom: 25px;
        font-size: 16px;
        line-height: 1.5;
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

    input[type="email"] {
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

    input[type="email"]:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.4);
        background-color: #fff;
        outline: none;
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
    }

    .register-link a {
        color: #007bff;
        text-decoration: none;
        font-weight: bold;
        display: inline-flex;
        align-items: center;
        gap: 5px;
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
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitBtn = document.querySelector('.login-btn');
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري الإرسال...';
            submitBtn.disabled = true;
            
            this.submit();
        });
    });

    function isValidEmail(email) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
</script>
@endsection 