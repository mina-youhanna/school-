@extends('layouts.app')

@section('title', 'إدارة الاشتراكات')

@section('content')
<style>
    .subscriptions-container {
        max-width: 1200px;
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
    .subscriptions-table {
        width: 100%;
        border-collapse: collapse;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }
    .subscriptions-table th {
        background: #FFD700;
        color: #0A2A4F;
        padding: 15px;
        text-align: right;
        font-weight: bold;
        font-size: 1.1em;
    }
    .subscriptions-table td {
        padding: 12px 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
    }
    .subscriptions-table tr:hover {
        background: rgba(255, 215, 0, 0.1);
    }
    .status-active {
        background: #4CAF50;
        color: white;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.9em;
    }
    .status-expired {
        background: #f44336;
        color: white;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.9em;
    }
    .status-pending {
        background: #ff9800;
        color: white;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.9em;
    }
    .btn-add {
        background: linear-gradient(135deg, #FFD700, #FFC107);
        color: #0A2A4F;
        border: none;
        padding: 12px 25px;
        border-radius: 25px;
        font-size: 1.1em;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 20px;
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.4);
    }
    .btn-add:hover {
        background: linear-gradient(135deg, #FFC107, #FFB300);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 215, 0, 0.5);
        text-decoration: none;
        color: #0A2A4F;
    }
    .btn-edit, .btn-delete {
        padding: 6px 12px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 0.9em;
        margin: 0 2px;
        transition: all 0.3s ease;
    }
    .btn-edit {
        background: #FFD700;
        color: #0A2A4F;
    }
    .btn-edit:hover {
        background: #FFC107;
        transform: translateY(-1px);
    }
    .btn-delete {
        background: #f44336;
        color: white;
    }
    .btn-delete:hover {
        background: #d32f2f;
        transform: translateY(-1px);
    }
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    .pagination a, .pagination span {
        color: white;
        padding: 8px 16px;
        text-decoration: none;
        border: 1px solid rgba(255, 255, 255, 0.2);
        margin: 0 4px;
        border-radius: 5px;
        transition: all 0.3s ease;
    }
    .pagination a:hover {
        background: #FFD700;
        color: #0A2A4F;
    }
    .pagination .active {
        background: #FFD700;
        color: #0A2A4F;
    }
</style>

<div class="subscriptions-container" dir="rtl">
    <h2 class="subscriptions-header">إدارة الاشتراكات</h2>
    
    <div style="text-align: left;">
        <a href="{{ route('admin.subscriptions.create') }}" class="btn-add">
            <i class="fas fa-plus"></i> إضافة اشتراك جديد
        </a>
    </div>

    <div style="overflow-x: auto;">
        <table class="subscriptions-table">
            <thead>
                <tr>
                    <th>المستخدم</th>
                    <th>قيمة الاشتراك</th>
                    <th>تاريخ الاشتراك</th>
                    <th>تاريخ الانتهاء</th>
                    <th>الحالة</th>
                    <th>ملاحظات</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subscriptions as $subscription)
                    <tr>
                        <td>{{ $subscription->user->full_name }}</td>
                        <td>{{ $subscription->amount }} جنيه</td>
                        <td>{{ $subscription->formatted_subscription_date }}</td>
                        <td>{{ $subscription->formatted_expiry_date }}</td>
                        <td>
                            @if($subscription->status === 'active')
                                <span class="status-active">نشط</span>
                            @elseif($subscription->status === 'expired')
                                <span class="status-expired">منتهي</span>
                            @else
                                <span class="status-pending">في الانتظار</span>
                            @endif
                        </td>
                        <td>{{ $subscription->notes ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.subscriptions.edit', $subscription) }}" class="btn-edit">
                                <i class="fas fa-edit"></i> تعديل
                            </a>
                            <form action="{{ route('admin.subscriptions.destroy', $subscription) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('هل أنت متأكد من حذف هذا الاشتراك؟')">
                                    <i class="fas fa-trash"></i> حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 30px;">
                            لا توجد اشتراكات مسجلة
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($subscriptions->hasPages())
        <div class="pagination">
            {{ $subscriptions->links() }}
        </div>
    @endif
</div>
@endsection 