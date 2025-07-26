@extends('layouts.app')

@section('title', 'إضافة اشتراك جديد')

@section('content')
<style>
    .subscription-form-container {
        max-width: 800px;
        margin: 80px auto 40px auto;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 30px;
    }
    .form-header {
        text-align: center;
        margin-bottom: 30px;
        color: #FFD700;
        font-size: 2.5em;
        font-weight: 700;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        color: white;
        margin-bottom: 8px;
        font-weight: 500;
        font-size: 1.1em;
    }
    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 12px 15px;
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 1em;
        transition: all 0.3s ease;
    }
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: #FFD700;
        background: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
        outline: none;
    }
    .form-group textarea {
        resize: vertical;
        min-height: 100px;
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
        margin: 30px auto 0 auto;
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
    }
    .btn-submit:hover {
        background: linear-gradient(135deg, #FFC107, #FFB300);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 215, 0, 0.5);
    }
    .btn-back {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.2);
        padding: 10px 20px;
        border-radius: 20px;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    .btn-back:hover {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        text-decoration: none;
    }
    .error-message {
        color: #f44336;
        font-size: 0.9em;
        margin-top: 5px;
    }
</style>

<div class="subscription-form-container" dir="rtl">
    <a href="{{ route('admin.subscriptions.index') }}" class="btn-back">
        <i class="fas fa-arrow-right"></i> العودة للقائمة
    </a>
    
    <h2 class="form-header">إضافة اشتراك جديد</h2>

    <div style="background: linear-gradient(135deg, rgba(255, 215, 0, 0.1), rgba(255, 215, 0, 0.05)); border: 1px solid rgba(255, 215, 0, 0.3); border-radius: 10px; padding: 20px; margin-bottom: 30px; text-align: center;">
        <div style="color: #FFD700; font-size: 1.2em; font-weight: bold; margin-bottom: 10px;">
            <i class="fas fa-info-circle"></i> معلومات مهمة
        </div>
        <div style="color: white; font-size: 1.1em; line-height: 1.6;">
            • تاريخ انتهاء الاشتراك ثابت: <strong>11 سبتمبر من كل عام</strong><br>
            • قيمة الاشتراك الافتراضية: <strong>80 جنيه</strong><br>
            • إذا كان تاريخ الاشتراك بعد 11/9، فتاريخ الانتهاء سيكون 11/9 من السنة التالية
        </div>
    </div>

    <form method="POST" action="{{ route('admin.subscriptions.store') }}">
        @csrf
        
        <div class="form-group">
            <label for="user_id">المستخدم:</label>
            <select name="user_id" id="user_id" required>
                <option value="">اختر المستخدم</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->full_name }} ({{ $user->role }})
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="amount">قيمة الاشتراك (جنيه): <small style="color: #FFD700;">(اختياري - الافتراضي: 80 جنيه)</small></label>
            <input type="number" name="amount" id="amount" value="{{ old('amount', 80) }}" min="0" step="0.01" placeholder="80">
            @error('amount')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="subscription_date">تاريخ الاشتراك:</label>
            <input type="date" name="subscription_date" id="subscription_date" value="{{ old('subscription_date', date('Y-m-d')) }}" required>
            @error('subscription_date')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="notes">ملاحظات (اختياري):</label>
            <textarea name="notes" id="notes" placeholder="أي ملاحظات إضافية...">{{ old('notes') }}</textarea>
            @error('notes')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-submit">
            <i class="fas fa-save"></i> حفظ الاشتراك
        </button>
    </form>
</div>
@endsection 