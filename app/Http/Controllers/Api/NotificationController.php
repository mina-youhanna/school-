<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function getNotifications(Request $request)
    {
        $user = $request->user();
        
        // Get unread notifications from the last 7 days
        $notifications = Notification::where('user_id', $user->id)
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->where('read_at', null)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($notification) {
                return [
                    'message' => $notification->message,
                    'icon' => $this->getNotificationIcon($notification->type),
                    'created_at' => $notification->created_at->diffForHumans()
                ];
            });
        
        return response()->json([
            'notifications' => $notifications
        ]);
    }
    
    private function getNotificationIcon($type)
    {
        $icons = [
            'exam' => 'fa-file-alt',
            'attendance' => 'fa-calendar-check',
            'course' => 'fa-book',
            'serving' => 'fa-hands-helping',
            'announcement' => 'fa-bullhorn',
            'default' => 'fa-bell'
        ];
        
        return $icons[$type] ?? $icons['default'];
    }
} 