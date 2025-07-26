<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Check user subscription status.
     */
    public function checkStatus()
    {
        $user = Auth::user();
        $hasActiveSubscription = $user->hasActiveSubscription();
        $activeSubscription = $user->activeSubscription();
        $isExpiringSoon = $user->isSubscriptionExpiringSoon();
        $daysUntilExpiry = $user->getDaysUntilSubscriptionExpires();

        return response()->json([
            'success' => true,
            'has_active_subscription' => $hasActiveSubscription,
            'subscription' => $activeSubscription,
            'is_expiring_soon' => $isExpiringSoon,
            'days_until_expiry' => $daysUntilExpiry,
            'message' => $hasActiveSubscription 
                ? 'لديك اشتراك نشط' 
                : 'برجاء دفع قيمة الاشتراك لخادم الفصل المسؤول لدخول المعرض'
        ]);
    }

    /**
     * Get user's subscription history.
     */
    public function mySubscriptions()
    {
        $user = Auth::user();
        $subscriptions = $user->subscriptions()->latest()->get();
        
        return response()->json([
            'success' => true,
            'subscriptions' => $subscriptions
        ]);
    }

    /**
     * Create a new subscription (for admin or main servant).
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'nullable|numeric|min:0',
            'subscription_date' => 'required|date',
            'notes' => 'nullable|string'
        ]);

        // تحديد تاريخ انتهاء الاشتراك (11/9 من كل عام)
        $expiryDate = Subscription::calculateExpiryDate($request->subscription_date);

        $subscription = Subscription::create([
            'user_id' => $request->user_id,
            'amount' => $request->amount ?? 80.00, // القيمة الافتراضية 80 جنيه
            'subscription_date' => $request->subscription_date,
            'expiry_date' => $expiryDate,
            'status' => 'active',
            'notes' => $request->notes
        ]);

        return response()->json([
            'success' => true,
            'message' => 'تم إضافة الاشتراك بنجاح',
            'subscription' => $subscription->load('user')
        ]);
    }

    /**
     * Get all subscriptions (for admin).
     */
    public function index()
    {
        $subscriptions = Subscription::with('user')->latest()->paginate(20);
        
        return response()->json([
            'success' => true,
            'subscriptions' => $subscriptions
        ]);
    }

    /**
     * Update subscription status.
     */
    public function updateStatus(Request $request, Subscription $subscription)
    {
        $request->validate([
            'status' => 'required|in:active,expired,pending'
        ]);

        $subscription->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث حالة الاشتراك بنجاح',
            'subscription' => $subscription->load('user')
        ]);
    }
}
