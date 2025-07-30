<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\StudyClass;
use Illuminate\Support\Facades\DB;

class ClassController extends Controller
{
    public function index(Request $request)
    {
        $classes = StudyClass::withCount(['students'])
            ->orderBy('name')
            ->get();

        // حساب العدد الصحيح للخدام (الخادم الأساسي + الخدام المساعدين)
        foreach ($classes as $class) {
            // حساب عدد الخدام الأساسي
            $mainServantCount = 0;
            if (!empty($class->main_servant_email) && $class->main_servant_email !== null && $class->main_servant_email !== '') {
                $mainServantCount = 1;
            }

            // عدد الخدام المساعدين (من جدول العلاقة)
            $assistantServantsCount = $class->servants()->count();

            // المجموع الكلي
            $class->servants_count = $mainServantCount + $assistantServantsCount;
        }

        return view('admin.classes.index', compact('classes'));
    }

    public function show($id)
    {
        $class = StudyClass::with(['students', 'servants'])->findOrFail($id);
        $students = $class->students()->orderBy('full_name')->get();

        // جلب الخدام المساعدين من جدول العلاقة
        $assistantServants = $class->servants()->orderBy('full_name')->get();

        // جلب الخادم الأساسي من جدول المستخدمين
        $mainServant = null;
        if ($class->main_servant_email) {
            $mainServant = User::where('email', $class->main_servant_email)->first();
        }

        // دمج الخادم الأساسي مع الخدام المساعدين
        $allServants = collect();
        if ($mainServant) {
            $allServants->push($mainServant);
        }
        $allServants = $allServants->merge($assistantServants);

        // إحصائيات الحضور
        $attendanceStats = (object) [
            'total_records' => 0,
            'present_count' => 0,
            'absent_count' => 0
        ];

        $attendancePercentage = 0;
        $absencePercentage = 0;
        $weeklyAttendanceCount = 0;

        $tasbehaPercentage = 0;
        $massPercentage = 0;
        $classPercentage = 0;
        $educationPercentage = 0;

        try {
            $tableExists = DB::select("SHOW TABLES LIKE 'attendance'");
            if (!empty($tableExists)) {
                // إحصائيات عامة
                $stats = DB::table('attendance')
                ->where('class_id', $id)
                ->selectRaw('
                    COUNT(*) as total_records,
                    SUM(CASE WHEN is_present = 1 THEN 1 ELSE 0 END) as present_count,
                    SUM(CASE WHEN is_present = 0 THEN 1 ELSE 0 END) as absent_count
                ')
                ->first();

                if ($stats) {
                    $attendanceStats = $stats;
                    $totalRecords = $stats->total_records;

                    if ($totalRecords > 0) {
                        $attendancePercentage = round(($stats->present_count / $totalRecords) * 100);
                        $absencePercentage = round(($stats->absent_count / $totalRecords) * 100);
                    }
                }

                // حساب الحضور لهذا الأسبوع لكل نشاط
                $startOfWeek = now()->startOfWeek();
                $endOfWeek = now()->endOfWeek();

                $weeklyTasbeha = DB::table('attendance')
                    ->where('class_id', $id)
                    ->whereBetween('date', [$startOfWeek, $endOfWeek])
                    ->where('tasbeha', 1)
                    ->count();

                $weeklyMass = DB::table('attendance')
                    ->where('class_id', $id)
                    ->whereBetween('date', [$startOfWeek, $endOfWeek])
                    ->where('mass', 1)
                    ->count();

                $weeklyClass = DB::table('attendance')
                    ->where('class_id', $id)
                    ->whereBetween('date', [$startOfWeek, $endOfWeek])
                    ->where('class_attendance', 1)
                    ->count();

                $weeklyEducation = DB::table('attendance')
                    ->where('class_id', $id)
                    ->whereBetween('date', [$startOfWeek, $endOfWeek])
                    ->where('church_education', 1)
                    ->count();

                // حساب عدد الطلاب الفريدين الذين حضروا أي نشاط هذا الأسبوع
                $weeklyAttendanceUnique = DB::table('attendance')
                    ->where('class_id', $id)
                    ->whereBetween('date', [$startOfWeek, $endOfWeek])
                    ->where(function($query) {
                        $query->where('tasbeha', 1)
                              ->orWhere('mass', 1)
                              ->orWhere('class_attendance', 1)
                              ->orWhere('church_education', 1);
                    })
                    ->distinct('student_id')
                    ->count('student_id');

                $weeklyAttendanceCount = $weeklyAttendanceUnique;

                // حساب نسب أنواع الحضور
                if ($totalRecords > 0) {
                    $tasbehaStats = DB::table('attendance')
                        ->where('class_id', $id)
                        ->where('tasbeha', 1)
                        ->count();
                    $tasbehaPercentage = round(($tasbehaStats / $totalRecords) * 100);

                    $massStats = DB::table('attendance')
                        ->where('class_id', $id)
                        ->where('mass', 1)
                        ->count();
                    $massPercentage = round(($massStats / $totalRecords) * 100);

                    $classStats = DB::table('attendance')
                        ->where('class_id', $id)
                        ->where('class_attendance', 1)
                        ->count();
                    $classPercentage = round(($classStats / $totalRecords) * 100);

                    $educationStats = DB::table('attendance')
                        ->where('class_id', $id)
                        ->where('church_education', 1)
                        ->count();
                    $educationPercentage = round(($educationStats / $totalRecords) * 100);
                }
            }
        } catch (\Exception $e) {
            // تجاهل الأخطاء إذا لم يكن الجدول موجوداً
        }

        return view('admin.classes.show', compact(
            'class',
            'students',
            'allServants',
            'attendanceStats',
            'attendancePercentage',
            'absencePercentage',
            'weeklyAttendanceCount',
            'weeklyAttendanceUnique',
            'weeklyTasbeha',
            'weeklyMass',
            'weeklyClass',
            'weeklyEducation',
            'tasbehaPercentage',
            'massPercentage',
            'classPercentage',
            'educationPercentage'
        ));
    }

    public function create()
    {
        $servants = User::where('role', 'servant')
                        ->orWhere('role', 'خادم')
                        ->orWhere('is_main_servant', true)
                        ->orWhere('is_admin', true)
                        ->orderBy('full_name')
                        ->get();
        return view('admin.classes.create', compact('servants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stage' => 'required|string|max:50',
            'schedule' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'main_servant_email' => 'required|email|exists:users,email',
            'assistant_servants_emails' => 'nullable|string',
            'saint_image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'saint_image_url' => 'nullable|url|max:500',
            'gender' => 'required|in:ذكر,أنثى,مختلط'
        ]);

        // التحقق من وجود صورة
        if (!$request->hasFile('saint_image_file') && !$request->saint_image_url) {
            return back()->withErrors(['saint_image_file' => 'يجب إدخال صورة القديس إما برفع ملف أو إدخال رابط']);
        }

        if ($request->hasFile('saint_image_file') && $request->saint_image_url) {
            return back()->withErrors(['saint_image_file' => 'يجب اختيار إما رفع ملف أو إدخال رابط، وليس كلاهما']);
        }

        $data = $request->except(['assistant_servants_emails', 'saint_image_file', 'saint_image_url']);

        // معالجة الصورة
        if ($request->hasFile('saint_image_file')) {
            $file = $request->file('saint_image_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/classes'), $filename);
            $data['saint_image'] = 'images/classes/' . $filename;
        } elseif ($request->saint_image_url) {
            $data['saint_image'] = $request->saint_image_url;
        }

        $class = StudyClass::create($data);

        // ربط الخدام المساعدين (استبعاد الخادم الرئيسي)
        if ($request->assistant_servants_emails) {
            $assistantEmails = [];

            // معالجة البيانات الجديدة (JSON) أو القديمة (array)
            if (is_string($request->assistant_servants_emails)) {
                $servantsData = json_decode($request->assistant_servants_emails, true);
                if ($servantsData) {
                    $assistantEmails = array_column($servantsData, 'email');
                }
            } else {
                $assistantEmails = $request->assistant_servants_emails;
            }

            if (!empty($assistantEmails)) {
                $assistantServants = User::whereIn('email', $assistantEmails)
                                        ->where('email', '!=', $request->main_servant_email)
                                        ->get();
            $class->servants()->attach($assistantServants);
            }
        }

        return redirect()->route('admin.classes.index')->with('success', 'تم إنشاء الفصل بنجاح');
    }

    public function edit($id)
    {
        $class = StudyClass::with('servants')->findOrFail($id);
        $servants = User::where('role', 'servant')
                        ->orWhere('role', 'خادم')
                        ->orWhere('is_main_servant', true)
                        ->orWhere('is_admin', true)
                        ->orderBy('full_name')
                        ->get();

        // إضافة معلومات عن الخادم الأساسي للفصل
        $mainServant = null;
        if ($class->main_servant_email) {
            $mainServant = User::where('email', $class->main_servant_email)->first();
        }

        return view('admin.classes.edit', compact('class', 'servants', 'mainServant'));
    }

    public function update(Request $request, $id)
    {
        $class = StudyClass::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'stage' => 'required|string|max:50',
            'schedule' => 'required|string|max:255',
            'place' => 'required|string|max:255',
            'main_servant_email' => 'required|email|exists:users,email',
            'assistant_servants_emails' => 'nullable|string',
            'saint_image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'saint_image_url' => 'nullable|url|max:500',
            'gender' => 'required|in:ذكر,أنثى,مختلط',
            'delete_saint_image' => 'nullable|boolean'
        ]);

        // التحقق من وجود صورة (إلا إذا كانت موجودة مسبقاً أو تم تحديد حذفها)
        if (!$request->hasFile('saint_image_file') && !$request->saint_image_url && !$class->saint_image && !$request->delete_saint_image) {
            return back()->withErrors(['saint_image_file' => 'يجب إدخال صورة القديس إما برفع ملف أو إدخال رابط']);
        }

        if ($request->hasFile('saint_image_file') && $request->saint_image_url) {
            return back()->withErrors(['saint_image_file' => 'يجب اختيار إما رفع ملف أو إدخال رابط، وليس كلاهما']);
        }

        $data = $request->except(['assistant_servants_emails', 'saint_image_file', 'saint_image_url', 'delete_saint_image']);

        // معالجة الصورة
        if ($request->delete_saint_image) {
            // حذف الصورة القديمة إذا كانت ملف محلي
            if ($class->saint_image && !filter_var($class->saint_image, FILTER_VALIDATE_URL) && file_exists(public_path($class->saint_image))) {
                unlink(public_path($class->saint_image));
            }
            $data['saint_image'] = null;
        } elseif ($request->hasFile('saint_image_file')) {
            // حذف الصورة القديمة إذا كانت ملف محلي
            if ($class->saint_image && !filter_var($class->saint_image, FILTER_VALIDATE_URL) && file_exists(public_path($class->saint_image))) {
                unlink(public_path($class->saint_image));
            }

            $file = $request->file('saint_image_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/classes'), $filename);
            $data['saint_image'] = 'images/classes/' . $filename;
        } elseif ($request->saint_image_url) {
            $data['saint_image'] = $request->saint_image_url;
        }

        $class->update($data);

        // تحديث الخدام المساعدين (استبعاد الخادم الرئيسي)
        $class->servants()->detach();
        if ($request->assistant_servants_emails) {
            $assistantEmails = [];

            // معالجة البيانات الجديدة (JSON) أو القديمة (array)
            if (is_string($request->assistant_servants_emails)) {
                $servantsData = json_decode($request->assistant_servants_emails, true);
                if ($servantsData) {
                    $assistantEmails = array_column($servantsData, 'email');
                }
            } else {
                $assistantEmails = $request->assistant_servants_emails;
            }

            if (!empty($assistantEmails)) {
                $assistantServants = User::whereIn('email', $assistantEmails)
                                        ->where('email', '!=', $request->main_servant_email)
                                        ->get();
            $class->servants()->attach($assistantServants);
            }
        }

        return redirect()->route('admin.classes.index')->with('success', 'تم تحديث الفصل بنجاح');
    }

    public function destroy($id)
    {
        $class = StudyClass::findOrFail($id);

        // التحقق من عدم وجود طلاب في الفصل
        if ($class->students()->count() > 0) {
            return redirect()->back()->with('error', 'لا يمكن حذف الفصل لوجود طلاب مسجلين فيه');
        }

        $class->delete();
        return redirect()->route('admin.classes.index')->with('success', 'تم حذف الفصل بنجاح');
    }

    public function students($classId)
    {
        $class = StudyClass::findOrFail($classId);
        $students = User::where('my_class_id', $classId)->get();

        // إحصائيات الحضور لكل طالب
        $attendanceStats = collect();

        try {
            $tableExists = DB::select("SHOW TABLES LIKE 'attendance'");
            if (!empty($tableExists)) {
                $attendanceStats = DB::table('attendance')
                    ->where('class_id', $classId)
                    ->selectRaw('
                        student_id,
                        COUNT(*) as total_records,
                        SUM(CASE WHEN tasbeha = 1 THEN 1 ELSE 0 END) as tasbeha_count,
                        SUM(CASE WHEN mass = 1 THEN 1 ELSE 0 END) as mass_count,
                        SUM(CASE WHEN class_attendance = 1 THEN 1 ELSE 0 END) as class_count,
                        SUM(CASE WHEN church_education = 1 THEN 1 ELSE 0 END) as education_count
                    ')
                    ->groupBy('student_id')
                    ->get();
            }
        } catch (\Exception $e) {
            // تجاهل الأخطاء إذا لم يكن الجدول موجوداً
        }

        return view('admin.classes.students', compact('class', 'students', 'attendanceStats'));
    }

    public function servants($classId)
    {
        $class = StudyClass::findOrFail($classId);

        // جلب الخدام المساعدين من جدول العلاقة
        $assistantServants = $class->servants()->orderBy('full_name')->get();

        // جلب الخادم الأساسي من جدول المستخدمين
        $mainServant = null;
        if ($class->main_servant_email) {
            $mainServant = User::where('email', $class->main_servant_email)->first();
        }

        // دمج الخادم الأساسي مع الخدام المساعدين
        $allServants = collect();
        if ($mainServant) {
            $allServants->push($mainServant);
        }
        $allServants = $allServants->merge($assistantServants);

        // إحصائيات الحضور لكل خادم
        $servantsWithAttendance = [];

        foreach ($allServants as $servant) {
            $totalRecords = 0;
            $presentCount = 0;
            $absentCount = 0;

            // التحقق من وجود جدول attendance
            try {
                $tableExists = DB::select("SHOW TABLES LIKE 'attendance'");
                if (!empty($tableExists)) {
                    $attendanceStats = DB::table('attendance')
                        ->where('student_id', $servant->id)
                        ->where('class_id', $classId)
                        ->selectRaw('
                            COUNT(*) as total_records,
                            SUM(CASE WHEN is_present = 1 THEN 1 ELSE 0 END) as present_count,
                            SUM(CASE WHEN is_present = 0 THEN 1 ELSE 0 END) as absent_count
                        ')
                        ->first();

                    $totalRecords = $attendanceStats->total_records ?? 0;
                    $presentCount = $attendanceStats->present_count ?? 0;
                    $absentCount = $attendanceStats->absent_count ?? 0;
                }
            } catch (\Exception $e) {
                // تجاهل الأخطاء إذا لم يكن الجدول موجوداً
            }

            $attendancePercentage = $totalRecords > 0 ? ($presentCount / $totalRecords) * 100 : 0;

            // تحديد نوع الخادم (رئيسي أو مساعد)
            $isMainServant = $mainServant && $servant->id === $mainServant->id;

            $servantsWithAttendance[] = [
                'servant' => $servant,
                'is_main_servant' => $isMainServant,
                'total_records' => $totalRecords,
                'present_count' => $presentCount,
                'absent_count' => $absentCount,
                'attendance_percentage' => $attendancePercentage,
                'status_color' => $attendancePercentage < 40 ? 'danger' : ($attendancePercentage < 70 ? 'warning' : 'success')
            ];
        }

        return view('admin.classes.servants', compact('class', 'servantsWithAttendance'));
    }

    public function addStudent(Request $request, $classId)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id'
        ]);

        $student = User::findOrFail($request->student_id);
        $student->update(['my_class_id' => $classId]);

        return redirect()->back()->with('success', 'تم إضافة الطالب للفصل بنجاح');
    }

    public function removeStudent($classId, $studentId)
    {
        $student = User::findOrFail($studentId);
        $student->update(['my_class_id' => null]);

        return redirect()->back()->with('success', 'تم إزالة الطالب من الفصل بنجاح');
    }

    public function list()
    {
        $classes = StudyClass::select('id', 'name', 'stage')
            ->orderBy('name')
            ->get();

        return response()->json($classes);
    }
}
