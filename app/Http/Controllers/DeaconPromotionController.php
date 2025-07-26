<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DeaconPromotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DeaconPromotionController extends Controller
{
    // الرتب الشماسية بالترتيب الصحيح من الأقل للأعلى
    private $validRanks = [
        'إبصالتس',      // الرتبة الأولى
        'أغنسطس',       // الرتبة الثانية
        'إيبوذياكون',   // الرتبة الثالثة
        'دياكون',       // الرتبة الرابعة
        'أرشيدياكون'    // الرتبة الخامسة والأخيرة
    ];

    /**
     * ترقية شماس لرتبة جديدة
     */
    public function promote(Request $request, User $user)
    {
        // التأكد إن المستخدم شماس
        if (!$user->is_deacon) {
            return response()->json([
                'success' => false,
                'message' => 'هذا المستخدم ليس شماساً'
            ], 422);
        }

        $validator = Validator::make($request->all(), [
            'promotion_rank' => ['required', 'string', 'in:' . implode(',', $this->validRanks)],
            'promotion_date' => ['required', 'date', 'before_or_equal:today'],
            'promotion_by' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:1000']
        ], [
            'promotion_rank.required' => 'يجب اختيار الرتبة الجديدة',
            'promotion_rank.in' => 'الرتبة المختارة غير صحيحة',
            'promotion_date.required' => 'يجب إدخال تاريخ الترقية',
            'promotion_date.date' => 'تاريخ الترقية غير صحيح',
            'promotion_date.before_or_equal' => 'تاريخ الترقية لا يمكن أن يكون في المستقبل',
            'promotion_by.required' => 'يجب إدخال اسم من قام بالترقية',
            'promotion_by.max' => 'اسم من قام بالترقية طويل جداً',
            'notes.max' => 'الملاحظات طويلة جداً'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $currentRank = $user->deacon_rank;
        $newRank = $request->promotion_rank;

        // التحقق من صحة الترقية
        $validationResult = $this->validatePromotionLogic($currentRank, $newRank);
        if (!$validationResult['valid']) {
            return response()->json([
                'success' => false,
                'message' => $validationResult['message']
            ], 422);
        }

        // التحقق من عدم وجود ترقية في نفس التاريخ
        $existingPromotion = DeaconPromotion::where('user_id', $user->id)
            ->where('promotion_date', $request->promotion_date)
            ->first();

        if ($existingPromotion) {
            return response()->json([
                'success' => false,
                'message' => 'يوجد ترقية أخرى في هذا التاريخ'
            ], 422);
        }

        try {
            DB::beginTransaction();

            // إنشاء سجل الترقية الجديد
            $promotion = DeaconPromotion::create([
                'user_id' => $user->id,
                'from_rank' => $currentRank,
                'to_rank' => $newRank,
                'promotion_date' => $request->promotion_date,
                'promoted_by' => $request->promotion_by,
                'notes' => $request->notes
            ]);

            // تحديث الرتبة الحالية للمستخدم
            $user->update([
                'deacon_rank' => $newRank
            ]);

            DB::commit();

            // رسالة تأكيد مع معلومات الرتبة السابقة
            $previousRankMessage = '';
            if ($currentRank) {
                $previousRankMessage = "حصل على رتبة {$currentRank} من قبل. ";
            }

            return response()->json([
                'success' => true,
                'message' => $previousRankMessage . "تمت الترقية بنجاح إلى رتبة {$newRank}",
                'promotion' => $promotion,
                'user' => $user->fresh(),
                'previous_rank_info' => $currentRank ? [
                    'rank' => $currentRank,
                    'message' => "حصل على رتبة {$currentRank} في تاريخ سابق"
                ] : null
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حفظ الترقية'
            ], 500);
        }
    }

    /**
     * جلب تاريخ الترقيات للمستخدم
     */
    public function getPromotionHistory(User $user)
    {
        if (!$user->is_deacon) {
            return response()->json([
                'success' => false,
                'message' => 'هذا المستخدم ليس شماساً'
            ], 422);
        }

        $promotions = $user->deaconPromotions()
            ->orderBy('promotion_date', 'desc')
            ->get()
            ->map(function ($promotion) {
                return [
                    'id' => $promotion->id,
                    'from_rank' => $promotion->from_rank ?? 'لا يوجد',
                    'to_rank' => $promotion->to_rank,
                    'promotion_date' => $promotion->promotion_date,
                    'promoted_by' => $promotion->promoted_by,
                    'notes' => $promotion->notes,
                    'formatted_date' => \Carbon\Carbon::parse($promotion->promotion_date)->format('Y-m-d'),
                    'history_text' => "حصل على رتبة {$promotion->to_rank} في تاريخ " .
                                    \Carbon\Carbon::parse($promotion->promotion_date)->format('Y-m-d') .
                                    " بيد {$promotion->promoted_by}"
                ];
            });

        return response()->json([
            'success' => true,
            'promotions' => $promotions,
            'current_rank' => $user->deacon_rank ?? 'لا يوجد',
            'total_promotions' => $promotions->count()
        ]);
    }

    /**
     * جلب الرتب المتاحة للترقية
     */
    public function getAvailableRanks(User $user)
    {
        if (!$user->is_deacon) {
            return response()->json([
                'success' => false,
                'message' => 'هذا المستخدم ليس شماساً'
            ], 422);
        }

        $currentRank = $user->deacon_rank;
        $availableRanks = [];

        if (!$currentRank) {
            // لو مفيش رتبة حالية، يقدر يحصل على أول رتبة بس
            $availableRanks = [$this->validRanks[0]];
        } else {
            $currentIndex = array_search($currentRank, $this->validRanks);
            if ($currentIndex !== false && $currentIndex < count($this->validRanks) - 1) {
                // يقدر يحصل على الرتبة اللي بعدها بس
                $availableRanks = [$this->validRanks[$currentIndex + 1]];
            }
        }

        return response()->json([
            'success' => true,
            'available_ranks' => $availableRanks,
            'current_rank' => $currentRank ?? 'لا يوجد',
            'current_rank_index' => $currentRank ? array_search($currentRank, $this->validRanks) + 1 : 0,
            'total_ranks' => count($this->validRanks),
            'can_be_promoted' => !empty($availableRanks)
        ]);
    }

    /**
     * حذف ترقية (للإدارة فقط)
     */
    public function deletePromotion(Request $request, DeaconPromotion $promotion)
    {
        // ممكن تضيف هنا logic للتأكد من صلاحيات المستخدم
        
        try {
            DB::beginTransaction();

            $user = $promotion->user;
            
            // جلب الترقية السابقة
            $previousPromotion = DeaconPromotion::where('user_id', $user->id)
                ->where('promotion_date', '<', $promotion->promotion_date)
                ->orderBy('promotion_date', 'desc')
                ->first();

            // تحديث رتبة المستخدم للرتبة السابقة أو null
            $user->update([
                'deacon_rank' => $previousPromotion ? $previousPromotion->to_rank : null
            ]);

            // حذف الترقية
            $promotion->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'تم حذف الترقية بنجاح',
                'new_current_rank' => $previousPromotion ? $previousPromotion->to_rank : 'لا يوجد'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ أثناء حذف الترقية'
            ], 500);
        }
    }

    /**
     * التحقق من صحة منطق الترقية
     */
    private function validatePromotionLogic($currentRank, $newRank)
    {
        // لو مفيش رتبة حالية، لازم يبدأ بأول رتبة (إبصالتس)
        if (!$currentRank) {
            if ($newRank !== $this->validRanks[0]) {
                return [
                    'valid' => false,
                    'message' => 'يجب أن تكون الرتبة الأولى ' . $this->validRanks[0]
                ];
            }
            return ['valid' => true];
        }

        $currentRankIndex = array_search($currentRank, $this->validRanks);
        $newRankIndex = array_search($newRank, $this->validRanks);

        // التأكد إن الرتب موجودة في القائمة
        if ($currentRankIndex === false || $newRankIndex === false) {
            return [
                'valid' => false,
                'message' => 'رتبة غير صحيحة'
            ];
        }

        // لو اختار نفس الرتبة اللي عنده
        if ($newRankIndex == $currentRankIndex) {
            return [
                'valid' => false,
                'message' => 'لقد حصل على هذه الرتبة من قبل'
            ];
        }

        // لو اختار رتبة أقل من اللي عنده
        if ($newRankIndex < $currentRankIndex) {
            return [
                'valid' => false,
                'message' => 'لقد حصل على رتبة ' . $newRank . ' من قبل'
            ];
        }

        // لو مش الرتبة اللي بعدها في الترتيب
        if ($newRankIndex != $currentRankIndex + 1) {
            // بناء رسالة بكل الرتب المطلوبة
            $missingRanks = [];
            for ($i = $currentRankIndex + 1; $i < $newRankIndex; $i++) {
                $missingRanks[] = $this->validRanks[$i];
            }
            
            if (count($missingRanks) == 1) {
                return [
                    'valid' => false,
                    'message' => 'يجب الحصول على رتبة ' . $missingRanks[0] . ' أولاً'
                ];
            } else {
                $ranksText = implode(' و ', $missingRanks);
                return [
                    'valid' => false,
                    'message' => 'يجب الحصول على رتب ' . $ranksText . ' أولاً'
                ];
            }
        }

        return ['valid' => true];
    }

 
    public function getAllRanks()
    {
        return response()->json([
            'success' => true,
            'ranks' => $this->validRanks
        ]);
    }
} 