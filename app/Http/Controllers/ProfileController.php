<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = Auth::user();
        $role = $user->role ?? null;
        $profile = null;

        if ($role === 'خادم') {
            $profile = DB::table('servants')->where('email', $user->email)->first();
        } elseif ($role === 'مخدوم') {
            $profile = DB::table('served')->where('email', $user->email)->first();
        }

        if (!$profile) {
            $profile = $user;
        }

        return view('profile', [
            'profile' => $profile,
            'role' => $role,
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $role = $user->role ?? null;
        $profile = null;

        // Get profile data based on role
        if ($role === 'خادم') {
            $profile = DB::table('servants')->where('email', $user->email)->first();
        } elseif ($role === 'مخدوم') {
            $profile = DB::table('served')->where('email', $user->email)->first();
        }

        if (!$profile) {
            $profile = $user;
        }

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'relative_phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'confession_father' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|max:2048'
        ]);

        // Update user email
        $user->email = $validated['email'];
        $user->save();

        // Update profile data based on role
        if ($role === 'خادم') {
            DB::table('servants')
                ->where('email', $user->email)
                ->update([
                    'full_name' => $validated['full_name'],
                    'phone' => $validated['phone'],
                    'whatsapp' => $validated['whatsapp'],
                    'relative_phone' => $validated['relative_phone'],
                    'address' => $validated['address'],
                    'confession_father' => $validated['confession_father'],
                ]);
        } elseif ($role === 'مخدوم') {
            DB::table('served')
                ->where('email', $user->email)
                ->update([
                    'full_name' => $validated['full_name'],
                    'phone' => $validated['phone'],
                    'whatsapp' => $validated['whatsapp'],
                    'relative_phone' => $validated['relative_phone'],
                    'address' => $validated['address'],
                    'confession_father' => $validated['confession_father'],
                ]);
        } else {
            // Update user data directly if no specific role
            $user->full_name = $validated['full_name'];
            $user->phone = $validated['phone'];
            $user->whatsapp = $validated['whatsapp'];
            $user->relative_phone = $validated['relative_phone'];
            $user->address = $validated['address'];
            $user->confession_father = $validated['confession_father'];
            $user->save();
        }

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $table = $role === 'خادم' ? 'servants' : ($role === 'مخدوم' ? 'served' : 'users');
            $currentImage = DB::table($table)->where('email', $user->email)->value('profile_image');
            
            if ($currentImage) {
                Storage::delete('public/' . $currentImage);
            }
            
            $path = $request->file('profile_image')->store('profile-images', 'public');
            DB::table($table)->where('email', $user->email)->update(['profile_image' => $path]);
        }

        return redirect()->back()->with('success', 'تم تحديث البيانات بنجاح');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'كلمة المرور الحالية غير صحيحة']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'تم تغيير كلمة المرور بنجاح');
    }
}
