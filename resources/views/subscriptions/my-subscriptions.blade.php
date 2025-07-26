@extends('layouts.app')

@section('title', 'اشتراكاتي')

@section('content')
<style>
    .my-subscriptions-container {
        max-width: 1000px;
        margin: 80px auto 40px auto;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 30px;
    }
    .subscriptions-header {
        text-align: center;
        margin-bottom: 30px;
        color: #FFD700;
        font-size: 2.5em;
        font-weight: 700;
        text-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    }
    .subscription-card {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        border: 1px solid rgba(255, 215, 0, 0.2);
        transition: all 0.3s ease;
    }
    .subscription-card:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 215, 0, 0.4);
        transform: translateY(-2px);
    }
    .subscription-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    .subscription-title {
        color: #FFD700;
        font-size: 1.3em;
        font-weight: bold;
    }
    .subscription-status {
        padding: 5px 12px;
        border-radius: 15px;
        font-size: 0.9em;
        font-weight: bold;
    }
    .status-active {
        background: #4CAF50;
        color: white;
    }
    .status-expired {
        background: #f44336;
        color: white;
    }
    .status-pending {
        background: #ff9800;
        color: white;
    }
    .subscription-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 15px;
    }
    .detail-item {
        display: flex;
        flex-direction: column;
    }
    .detail-label {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9em;
        margin-bottom: 5px;
    }
    .detail-value {
        color: white;
        font-size: 1.1em;
        font-weight: 500;
    }
    .subscription-notes {
        background: rgba(255, 255, 255, 0.05);
        padding: 10px;
        border-radius: 8px;
        margin-top: 10px;
    }
    .notes-label {
        color: #FFD700;
        font-size: 0.9em;
        margin-bottom: 5px;
    }
    .notes-content {
        color: white;
        font-style: italic;
    }
    .no-subscriptions {
        text-align: center;
        color: white;
        font-size: 1.2em;
        padding: 40px;
    }
    .subscription-info {
        background: linear-gradient(135deg, rgba(255, 215, 0, 0.1), rgba(255, 215, 0, 0.05));
        border: 1px solid rgba(255, 215, 0, 0.3);
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 30px;
        text-align: center;
    }
    .info-title {
        color: #FFD700;
        font-size: 1.3em;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .info-text {
        color: white;
        font-size: 1.1em;
        line-height: 1.6;
    }
</style>

<div class="my-subscriptions-container" dir="rtl">
    <h2 class="subscriptions-header">اشتراكاتي</h2>
    
    <div class="subscription-info">
        <div class="info-title">
            <i class="fas fa-info-circle"></i> معلومات الاشتراك
        </div>
        <div class="info-text">
            قيمة الاشتراك السنوي: <strong>80 جنيه</strong><br>
            تاريخ انتهاء الاشتراك: <strong>11 سبتمبر من كل عام</strong><br>
            للدفع: <strong>برجاء التواصل مع خادم الفصل المسؤول</strong>
        </div>
    </div>

    @if($subscriptions->count() > 0)
        @foreach($subscriptions as $subscription)
            <div class="subscription-card">
                <div class="subscription-header">
                    <div class="subscription-title">
                        اشتراك رقم #{{ $subscription->id }}
                    </div>
                    <div class="subscription-status status-{{ $subscription->status }}">
                        @if($subscription->status === 'active')
                            نشط
                        @elseif($subscription->status === 'expired')
                            منتهي
                        @else
                            في الانتظار
                        @endif
                    </div>
                </div>
                
                <div class="subscription-details">
                    <div class="detail-item">
                        <div class="detail-label">قيمة الاشتراك:</div>
                        <div class="detail-value">{{ $subscription->amount }} جنيه</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">تاريخ الاشتراك:</div>
                        <div class="detail-value">{{ $subscription->formatted_subscription_date }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">تاريخ الانتهاء:</div>
                        <div class="detail-value">{{ $subscription->formatted_expiry_date }}</div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-label">تاريخ الإنشاء:</div>
                        <div class="detail-value">{{ $subscription->created_at->format('Y-m-d H:i') }}</div>
                    </div>
                </div>
                
                @if($subscription->notes)
                    <div class="subscription-notes">
                        <div class="notes-label">ملاحظات:</div>
                        <div class="notes-content">{{ $subscription->notes }}</div>
                    </div>
                @endif
            </div>
        @endforeach
    @else
        <div class="no-subscriptions">
            <i class="fas fa-info-circle" style="color:#FFD700;font-size:3rem;margin-bottom:20px;display:block;"></i>
            <p>لا توجد اشتراكات مسجلة لك حالياً</p>
            <p style="color:#FFD700;margin-top:10px;">برجاء التواصل مع خادم الفصل المسؤول لإتمام عملية الاشتراك</p>
        </div>
    @endif
</div>
@endsection 