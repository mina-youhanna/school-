<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GiftRequest;
use App\Models\Gift;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class GiftRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->is_admin) {
            // الأدمن: كل الطلبات
            $requests = GiftRequest::with(['user', 'gift'])->latest()->get();
        } elseif ($user->is_server) {
            // الخادم: طلبات فصله فقط (يفترض أن class_id موجود في user)
            $requests = GiftRequest::with(['user', 'gift'])
                ->where('class_id', $user->class_id)
                ->latest()->get();
        } else {
            // الطالب: طلباته فقط
            $requests = GiftRequest::with(['user', 'gift'])
                ->where('user_id', $user->id)
                ->latest()->get();
        }
        return response()->json($requests);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'gift_id' => 'required|exists:gifts,id',
            'quantity' => 'required|integer|min:1',
        ]);
        $gift = Gift::findOrFail($data['gift_id']);
        $quantity = $data['quantity'];
        // تحقق من الكمية
        if ($gift->quantity < $quantity) {
            return response()->json(['message' => 'الكمية المطلوبة غير متوفرة'], 400);
        }
        // تحقق من النقاط
        $totalPoints = $gift->points * $quantity;
        if ($user->score < $totalPoints) {
            return response()->json(['message' => 'ليس لديك نقاط كافية'], 400);
        }
        // تحقق من وجود طلب معلق لنفس الهدية
        $exists = GiftRequest::where('user_id', $user->id)
            ->where('gift_id', $gift->id)
            ->where('status', 'pending')->exists();
        if ($exists) {
            return response()->json(['message' => 'لديك طلب معلق لهذه الهدية بالفعل'], 400);
        }
        // خصم النقاط والكمية من المخزون
        $user->score -= $totalPoints;
        $user->save();
        $gift->quantity -= $quantity;
        $gift->save();
        $giftRequest = GiftRequest::create([
            'user_id' => $user->id,
            'gift_id' => $gift->id,
            'quantity' => $quantity,
            'status' => 'pending',
            'class_id' => $user->class_id ?? null,
        ]);
        return response()->json(['message' => 'تم إرسال طلبك للخادم', 'request' => $giftRequest], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $giftRequest = GiftRequest::findOrFail($id);
        $action = $request->input('action'); // 'accept' or 'reject'
        if (!$user->is_admin && $giftRequest->class_id != $user->class_id) {
            return response()->json(['message' => 'غير مصرح'], 403);
        }
        if ($giftRequest->status != 'pending') {
            return response()->json(['message' => 'تم معالجة الطلب بالفعل'], 400);
        }
        if ($action == 'accept') {
            $gift = $giftRequest->gift;
            $student = $giftRequest->user;
            if ($student->score < $gift->points) {
                return response()->json(['message' => 'النقاط غير كافية عند الطالب حالياً'], 400);
            }
            if ($gift->quantity < 1) {
                return response()->json(['message' => 'لقد نفدت هذه الهدية'], 400);
            }
            // خصم النقاط وتحديث الكمية
            $student->score -= $gift->points;
            $student->save();
            $gift->quantity -= 1;
            $gift->save();
            $giftRequest->status = 'accepted';
            $giftRequest->handled_by = $user->id;
            $giftRequest->handled_at = now();
            $giftRequest->save();
            // إرسال إشعار (يمكن تطويره)
            // Notification::send($student, ...)
            return response()->json(['message' => 'تم قبول الطلب', 'request' => $giftRequest]);
        } elseif ($action == 'reject') {
            $giftRequest->status = 'rejected';
            $giftRequest->handled_by = $user->id;
            $giftRequest->handled_at = now();
            $giftRequest->save();
            // إرسال إشعار بالرفض (يمكن تطويره)
            return response()->json(['message' => 'تم رفض الطلب', 'request' => $giftRequest]);
        } else {
            return response()->json(['message' => 'إجراء غير معروف'], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * عرض طلبات الهدايا لفصل الخادم
     */
    public function classRequests()
    {
        $user = Auth::user();
        
        if (!$user->is_server) {
            return response()->json(['message' => 'غير مصرح'], 403);
        }

        $requests = GiftRequest::with(['user', 'gift'])
            ->where('class_id', $user->class_id)
            ->where('status', 'pending')
            ->latest()
            ->get()
            ->map(function ($request) {
                return [
                    'id' => $request->id,
                    'student_name' => $request->user->name,
                    'gift_name' => $request->gift->name,
                    'gift_image' => $request->gift->image,
                    'gift_points' => $request->gift->points,
                    'quantity' => $request->quantity,
                    'requested_at' => $request->created_at->format('Y-m-d H:i:s')
                ];
            });

        return response()->json([
            'requests' => $requests,
            'class_name' => $user->class->name ?? 'غير محدد'
        ]);
    }
}
