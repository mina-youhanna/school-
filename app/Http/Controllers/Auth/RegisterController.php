<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    protected $fixedCodes = [
        'خادم-ذكر'   => '9999',
        'خادم-أنثى'  => '8888',
        'مخدوم-ذكر'  => '7777',
        'مخدوم-أنثى' => '6666',
    ];

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        try {
            $maleClasses = \App\Models\StudyClass::where('gender', 'male')->get();
            $femaleClasses = \App\Models\StudyClass::where('gender', 'female')->get();
            
            \Log::info('Classes loaded successfully', [
                'male_count' => $maleClasses->count(),
                'female_count' => $femaleClasses->count()
            ]);
            
            return view('auth.register', compact('maleClasses', 'femaleClasses'));
        } catch (\Exception $e) {
            \Log::error('Error loading classes: ' . $e->getMessage());
            return view('auth.register', [
                'maleClasses' => collect([]),
                'femaleClasses' => collect([])
            ]);
        }
    }

    public function checkCode(Request $request)
    {
        $code = $request->input('code');
        $role = $request->input('role');
        $gender = $request->input('gender');
        
        $key = $role . '-' . $gender;
        $validCode = $this->fixedCodes[$key] ?? null;

        if ($code === $validCode) {
            return response()->json(['success' => true]);
        }

        return response()->json([
            'success' => false,
            'message' => 'الكود غير صحيح'
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['nullable', 'string', 'size:11'],
            'whatsapp' => ['required', 'string', 'size:11'],
            'relative_phone' => ['required', 'string', 'size:11'],
            'address' => ['required', 'string', 'max:255'],
            'confession_father' => ['required', 'string', 'max:255'],
            'dob' => ['required', 'date'],
            'gender' => ['required', 'string', 'in:ذكر,أنثى'],
            'role' => ['required', 'string', 'in:خادم,مخدوم'],
            'my_class_id' => ['required', 'exists:study_classes,id'],
            'is_deacon' => ['required', 'string', 'in:نعم,لا'],
            'code' => ['required', 'string'],
            'profile_image' => ['required', 'image', 'max:2048'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Handle profile image upload
        $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');

        $user = User::create([
            'full_name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'whatsapp' => $request->whatsapp,
            'relative_phone' => $request->relative_phone,
            'address' => $request->address,
            'confession_father' => $request->confession_father,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'role' => $request->role,
            'my_class_id' => $request->my_class_id,
            'is_deacon' => $request->is_deacon === 'نعم' ? 1 : 0,
            'profile_image' => $profileImagePath,
            'code' => $request->code,
        ]);

        // Handle serving classes if user is a servant
        if ($request->role === 'خادم' && $request->has('serving_classes')) {
            $user->servingClasses()->attach($request->serving_classes);
        }

        // Handle deacon fields if user is a deacon
        if ($request->is_deacon === 'نعم') {
            $user->update([
                'ordination_date' => $request->ordination_date,
                'ordination_bishop' => $request->ordination_bishop,
                'deacon_rank' => $request->deacon_rank,
            ]);
        }

        event(new Registered($user));

        return response()->json([
            'success' => true,
            'message' => 'تم إنشاء حسابك بنجاح! يمكنك الآن تسجيل الدخول.',
            'redirect' => route('login')
        ]);
    }
}