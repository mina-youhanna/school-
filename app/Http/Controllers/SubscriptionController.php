<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of subscriptions for admin.
     */
    public function index()
    {
        $subscriptions = Subscription::with('user')->latest()->paginate(20);
        return view('subscriptions.index', compact('subscriptions'));
    }

    /**
     * Show the form for creating a new subscription.
     */
    public function create()
    {
        $users = User::whereIn('role', ['خادم', 'مخدوم'])->get();
        return view('subscriptions.create', compact('users'));
    }

    /**
     * Store a newly created subscription.
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

        return redirect()->route('admin.subscriptions.index')
            ->with('success', 'تم إضافة الاشتراك بنجاح');
    }

    /**
     * Display the specified subscription.
     */
    public function show(Subscription $subscription)
    {
        return view('subscriptions.show', compact('subscription'));
    }

    /**
     * Show the form for editing the specified subscription.
     */
    public function edit(Subscription $subscription)
    {
        $users = User::whereIn('role', ['خادم', 'مخدوم'])->get();
        return view('subscriptions.edit', compact('subscription', 'users'));
    }

    /**
     * Update the specified subscription.
     */
    public function update(Request $request, Subscription $subscription)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'subscription_date' => 'required|date',
            'expiry_date' => 'required|date|after:subscription_date',
            'status' => 'required|in:active,expired,pending',
            'notes' => 'nullable|string'
        ]);

        $subscription->update($request->all());

        return redirect()->route('subscriptions.index')
            ->with('success', 'تم تحديث الاشتراك بنجاح');
    }

    /**
     * Remove the specified subscription.
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return redirect()->route('subscriptions.index')
            ->with('success', 'تم حذف الاشتراك بنجاح');
    }

    /**
     * Check user subscription status.
     */
    public function checkStatus()
    {
        $user = Auth::user();
        $hasActiveSubscription = $user->hasActiveSubscription();
        $activeSubscription = $user->activeSubscription();

        return response()->json([
            'has_active_subscription' => $hasActiveSubscription,
            'subscription' => $activeSubscription,
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
        
        return view('subscriptions.my-subscriptions', compact('subscriptions'));
    }
}
