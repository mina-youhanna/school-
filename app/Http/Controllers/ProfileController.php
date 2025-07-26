<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\DeaconPromotion;

class ProfileController extends Controller
{
    public function show()
    {
        // إعادة تحميل المستخدم لضمان الحصول على أحدث البيانات من قاعدة البيانات
        // وتحميل علاقة studyClass بشكل صريح
        $profile = Auth::user()->fresh()->load('studyClass');
        
        // رسائل Log للتحقق من البيانات قبل تمريرها للعرض
        Log::info('Profile Data in ProfileController@show:', [
            'user_id' => $profile->id,
            'email' => $profile->email,
            'my_class_id_db' => $profile->sunday_class_id, // القيمة المخزنة في العمود
            'my_class_name_from_relationship' => $profile->studyClass ? $profile->studyClass->name : 'غير محدد من العلاقة',
        ]);

        return view('profile.show', compact('profile'));
    }

    public function edit()
    {
        $profile = auth()->user();
        return view('profile.edit', compact('profile'));
    }

    /**
     * Update the user's profile information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $profile = Auth::user();

        // Check old password first if trying to change password
        if ($request->filled('new_password') || $request->filled('new_password_confirmation')) {
            Log::info('Checking current password for user: ' . $profile->id);

            if (!Hash::check($request->current_password, $profile->password)) {
                Log::warning('Current password check failed for user: ' . $profile->id);
                return response()->json([
                    'status' => 'error',
                    'message' => 'كلمة المرور الحالية غير صحيحة',
                    'errors' => ['current_password' => ['كلمة المرور الحالية غير صحيحة']],
                    'field' => 'current_password'
                ], 422);
            }
            Log::info('Current password check passed for user: ' . $profile->id);
        }

        // قواعد التحقق (Validation Rules) لجميع الحقول
        $rules = [
            'full_name' => ['required', 'string', 'max:255', 'regex:/^[\p{Arabic}\s]+$/u', 'regex:/^(?:[\p{Arabic}]+\s){3}[\p{Arabic}]+$/u', Rule::unique('users', 'full_name')->ignore($profile->id)],
            'full_name_en' => 'nullable|string|max:255|regex:/^[A-Za-z\s]+$/',
            'username' => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($profile->id)],
            'national_id' => ['nullable', 'digits:14', 'numeric', Rule::unique('users', 'national_id')->ignore($profile->id)],
            'phone' => 'nullable|string|max:20|regex:/^01[0-9]{9}$/',
            'whatsapp' => 'nullable|string|max:20|regex:/^01[0-9]{9}$/',
            'relative_phone' => 'nullable|string|max:20|regex:/^01[0-9]{9}$/',
            'address' => 'nullable|string|max:255',
            'confession_father' => 'nullable|string|max:255|regex:/^[\p{Arabic}\s]*$/u',
            'promotion_rank' => 'nullable|string|max:255',
            'promotion_date' => 'nullable|date',
            'promotion_by' => 'nullable|string|max:255',
            'last_degree' => 'nullable|string|max:255',
            'job' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'current_password' => 'required_with:new_password,new_password_confirmation',
            'new_password' => 'nullable|required_with:current_password|min:8|confirmed',
            'new_password_confirmation' => 'nullable|required_with:new_password|min:8',
        ];

        // رسائل خطأ مخصصة (Custom Error Messages)
        $messages = [
            'full_name.required' => 'الاسم الرباعي مطلوب.',
            'full_name.regex' => 'يجب ان يكون الاسم رباعي',
            'full_name.unique' => 'الاسم الرباعي موجود بالفعل.',
            'full_name_en.regex' => 'الاسم بالإنجليزي يجب أن يحتوي على حروف إنجليزية ومسافات فقط.',
            'username.required' => 'اسم المستخدم مطلوب.',
            'username.unique' => 'اسم المستخدم موجود بالفعل.',
            'national_id.digits' => 'الرقم القومي يجب أن يتكون من 14 رقم.',
            'national_id.numeric' => 'الرقم القومي يجب أن يكون أرقام فقط.',
            'national_id.unique' => 'الرقم القومي موجود بالفعل.',
            'phone.regex' => 'رقم الهاتف يجب أن يبدأ بـ 01 ويتكون من 11 رقم.',
            'whatsapp.regex' => 'رقم الواتساب يجب أن يبدأ بـ 01 ويتكون من 11 رقم.',
            'relative_phone.regex' => 'رقم هاتف أحد الأقارب يجب أن يبدأ بـ 01 ويتكون من 11 رقم.',
            'profile_image.image' => 'الملف المرفق يجب أن يكون صورة.',
            'profile_image.mimes' => 'صيغ الصور المدعومة هي: jpeg, png, jpg, gif, svg.',
            'profile_image.max' => 'حجم الصورة يجب أن لا يتجاوز 2 ميجابايت.',
            'current_password.required_with' => 'كلمة المرور الحالية مطلوبة لتغيير كلمة المرور.',
            'new_password.required_with' => 'كلمة المرور الجديدة مطلوبة عند إدخال كلمة المرور الحالية.',
            'new_password.min' => 'كلمة المرور الجديدة يجب أن لا تقل عن 8 أحرف.',
            'new_password.confirmed' => 'كلمة المرور الجديدة وتأكيدها غير متطابقين.',
            'new_password_confirmation.required_with' => 'تأكيد كلمة المرور الجديدة مطلوب عند إدخال كلمة مرور جديدة.',
            'new_password_confirmation.min' => 'تأكيد كلمة المرور الجديدة يجب أن لا يقل عن 8 أحرف.',
            'confession_father.regex' => 'اسم أب الاعتراف يجب أن يحتوي على حروف عربية ومسافات فقط.',
        ];

        try {
            $validatedData = $request->validate($rules, $messages);
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'يرجى تصحيح الأخطاء أدناه',
                    'errors' => $e->errors(),
                    'field' => array_key_first($e->errors())
                ], 422);
            }
            throw $e;
        }

        // تحديث بيانات المستخدم في قاعدة البيانات
        $profile->full_name = $request->full_name;
        $profile->full_name_en = $request->full_name_en;
        $profile->username = $request->username;
        $profile->national_id = $request->national_id;
        $profile->phone = $request->phone;
        $profile->whatsapp = $request->whatsapp;
        $profile->relative_phone = $request->relative_phone;
        $profile->address = $request->address;
        $profile->confession_father = $request->confession_father;
        $profile->promotion_rank = $request->promotion_rank;
        $profile->promotion_date = $request->promotion_date;
        $profile->promotion_by = $request->promotion_by;
        $profile->last_degree = $request->last_degree;
        $profile->job = $request->job;
        // حفظ حالة المسؤولية عن الفصل إذا كان خادم
        if ($profile->role === 'خادم') {
            $profile->is_main_servant = $request->has('is_main_servant') ? (bool)$request->is_main_servant : false;
        }

        // معالجة رفع الصورة الشخصية
        if ($request->hasFile('profile_image')) {
            if ($profile->profile_image) {
                Storage::delete('public/profile_images/' . $profile->profile_image);
            }
            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->storeAs('public/profile_images', $imageName);
            $profile->profile_image = $imageName;
        }

        // تحديث كلمة المرور إذا تم تغييرها
        if ($request->filled('new_password')) {
            $profile->password = Hash::make($request->new_password);
        }

        $profile->save();

        // Return success JSON response for AJAX
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'تم تحديث الملف الشخصي بنجاح!'
            ]);
        }

        // Fallback for non-AJAX requests
        return redirect()->route('profile')->with('success', 'تم تحديث الملف الشخصي بنجاح!');
    }

    // The changePassword method seems redundant if profile.update handles password changes.
    // It's good practice to have one place for profile updates.
    // If 'changePassword' route is still used elsewhere, apply the same message change there.
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            // Add custom messages for changePassword method if it's used
            'current_password.required' => 'كلمة المرور الحالية مطلوبة.',
            // Change the message for incorrect current password in this method too
             'current_password' => 'كلمة المرورو المدخلة غير صحيحة',
            'new_password.required' => 'كلمة المرور الجديدة مطلوبة.',
            'new_password.min' => 'كلمة المرور الجديدة يجب أن لا تقل عن 8 أحرف.',
            'new_password.confirmed' => 'كلمة المرور الجديدة وتأكيدها غير متطابقين.',
        ]);

        $profile = auth()->user();

        // Manual check for current password
        // Log: Checking current password in changePassword method
        Log::info('Checking current password in changePassword for user: ' . $profile->id);

        if (!Hash::check($request->current_password, $profile->password)) {
             // Log: Current password check failed in changePassword method
             Log::warning('Current password check failed in changePassword for user: ' . $profile->id);
            return back()->withErrors(['current_password' => 'كلمة المرورو المدخلة غير صحيحة']);
        }

        $profile->password = Hash::make($request->new_password);
        $profile->save();

        // Log: Password changed successfully in changePassword method
        Log::info('Password changed successfully for user: ' . $profile->id);

        return back()->with('success', 'تم تغيير كلمة المرور بنجاح!');
    }
}