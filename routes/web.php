<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DeaconPromotionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\ExamController as AdminExamController;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController;
use App\Http\Controllers\Admin\ReportController;

use Illuminate\Support\Facades\Http;
use App\Models\DailyReading;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/photo', function () {
    return view('photo');
})->name('photo');

Route::get('/videos', function () {
    return view('videos');
})->name('videos');

Route::get('/classes', function () {
    return view('classes');
})->name('classes');

Route::get('/boys-classes', function () {
    return view('boys-classes');
})->name('boys_classes');

Route::get('/girls-classes', function () {
    return view('girls-classes');
})->name('girls_classes');

Route::get('/chorus', function () {
    return view('chorus');
})->name('chorus');

Route::get('/girls-chorus', function () {
    return view('girls-chorus');
})->name('girls_chorus');

Route::get('/curricula', function () {
    return view('curricula');
})->name('curricula');

Route::get('/products', function () {
    return view('products');
})->name('products');

Route::get('/st-stephens-school', [App\Http\Controllers\PageController::class, 'stStephensSchool'])->name('st_stephens_school');

Route::get('/saints/st-thomas', function () {
    return view('saints.st-thomas');
})->name('saints.thomas');

Route::get('/saints/st-demiana', function () {
    return view('saints.st-demiana');
})->name('saints.demiana');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});

// مسارات إعادة تعيين كلمة المرور
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::get('/webtest', function () {
    return 'Web is working';
});

Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])
    ->name('password.update');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

    // Deacon Promotion Routes
    Route::post('/users/{user}/promote', [DeaconPromotionController::class, 'promote'])->name('deacon.promote');
    Route::get('/users/{user}/promotions', [DeaconPromotionController::class, 'getPromotionHistory'])->name('deacon.promotions');

    // User Profile Routes
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');
    Route::get('/exams', [ExamController::class, 'index'])->name('exams');
    Route::get('/exams/{exam}', [ExamController::class, 'take'])->name('exams.take');
    Route::post('/exams/{exam}/submit', [ExamController::class, 'submit'])->name('exams.submit');

    // Gifts route
    Route::get('/gifts', function () {
        return view('gifts');
    })->name('gifts');
});

Route::post('/check-code', [RegisterController::class, 'checkCode'])->name('check.code');

$fixedCodes = [
    'خادم-ذكر'   => '9999',
    'خادم-أنثى'  => '8888',
    'مخدوم-ذكر'  => '7777',
    'مخدوم-أنثى' => '6666',
];

Route::get('/saint-stephen', function () {
    return view('saint-stephen');
})->name('saint.stephen');

Route::get('/daily-readings', [\App\Http\Controllers\DailyReadingController::class, 'index'])->name('daily_readings');

Route::get('/readings', function () {
    $date = request('date', date('Y-m-d'));
    $readings = DailyReading::where('reading_date', $date)->get();
    return view('readings', ['readings' => $readings, 'date' => $date]);
});

Route::get('/hymns-library', [App\Http\Controllers\HymnController::class, 'index'])->name('hymns.library');
Route::get('/hymns/{id}', [App\Http\Controllers\HymnController::class, 'show'])->name('hymns.show');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{id}/role', [UserController::class, 'updateRole'])->name('users.update-role');
    Route::put('/users/{id}/class', [UserController::class, 'updateClass'])->name('users.update-class');
    Route::post('/users/bulk-update', [UserController::class, 'bulkUpdate'])->name('users.bulk-update');
    Route::get('/users/search', [UserController::class, 'search'])->name('users.search');

    // Classes Routes
    Route::get('/classes', [ClassController::class, 'index'])->name('classes.index');
    Route::get('/classes/create', [ClassController::class, 'create'])->name('classes.create');
    Route::post('/classes', [ClassController::class, 'store'])->name('classes.store');
    Route::get('/classes/{id}', [ClassController::class, 'show'])->name('classes.show');
    Route::get('/classes/{id}/edit', [ClassController::class, 'edit'])->name('classes.edit');
    Route::put('/classes/{id}', [ClassController::class, 'update'])->name('classes.update');
    Route::delete('/classes/{id}', [ClassController::class, 'destroy'])->name('classes.destroy');
    Route::get('/classes/{id}/students', [ClassController::class, 'students'])->name('classes.students');
    Route::get('/classes/{id}/servants', [ClassController::class, 'servants'])->name('classes.servants');
    Route::post('/classes/{id}/students', [ClassController::class, 'addStudent'])->name('classes.add-student');
    Route::delete('/classes/{id}/students/{studentId}', [ClassController::class, 'removeStudent'])->name('classes.remove-student');
    Route::get('/classes/list', [ClassController::class, 'list'])->name('classes.list');

    // Exams Routes
    Route::get('/exams', [AdminExamController::class, 'index'])->name('exams.index');
    Route::get('/exams/create', [AdminExamController::class, 'create'])->name('exams.create');
    Route::post('/exams', [AdminExamController::class, 'store'])->name('exams.store');
    Route::get('/exams/{exam}', [AdminExamController::class, 'show'])->name('exams.show');
    Route::get('/exams/{exam}/edit', [AdminExamController::class, 'edit'])->name('exams.edit');
    Route::put('/exams/{exam}', [AdminExamController::class, 'update'])->name('exams.update');
    Route::delete('/exams/{exam}', [AdminExamController::class, 'destroy'])->name('exams.destroy');
    Route::get('/exams/{exam}/setup-questions', [AdminExamController::class, 'setupQuestions'])->name('exams.setup-questions');
    Route::post('/exams/{exam}/setup-questions', [AdminExamController::class, 'storeQuestions'])->name('exams.store-questions');
    Route::get('/exams/{exam}/edit-questions', [AdminExamController::class, 'editQuestions'])->name('exams.edit-questions');
    Route::put('/exams/{exam}/update-questions', [AdminExamController::class, 'updateQuestions'])->name('exams.update-questions');
    Route::get('/exams/{exam}/create-questions', [App\Http\Controllers\Admin\ExamController::class, 'createQuestionsForm'])->name('admin.exams.create-questions');
    Route::post('/exams/{exam}/save-questions', [App\Http\Controllers\Admin\ExamController::class, 'saveQuestions'])->name('admin.exams.save-questions');

    // Attendance Routes
    Route::get('/attendance', [AdminAttendanceController::class, 'index'])->name('attendance');
    Route::get('/attendance/{classId}', [AdminAttendanceController::class, 'show'])->name('attendance.show');
    Route::get('/attendance/{classId}/load', [AdminAttendanceController::class, 'loadAttendance'])->name('attendance.load');
    Route::post('/attendance', [AdminAttendanceController::class, 'store'])->name('attendance.store');
    Route::put('/attendance/{id}', [AdminAttendanceController::class, 'update'])->name('attendance.update');
    Route::delete('/attendance/{id}', [AdminAttendanceController::class, 'destroy'])->name('attendance.destroy');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports');

    // Enhanced Attendance Routes
    Route::resource('enhanced-attendance', \App\Http\Controllers\Admin\EnhancedAttendanceController::class);
    Route::get('/enhanced-attendance/user/{userId}', [\App\Http\Controllers\Admin\EnhancedAttendanceController::class, 'userAttendance'])->name('enhanced-attendance.user');

    // Enhanced Exams Routes
    Route::resource('enhanced-exams', \App\Http\Controllers\Admin\EnhancedExamController::class);
    Route::get('/enhanced-exams/user/{userId}', [\App\Http\Controllers\Admin\EnhancedExamController::class, 'userExams'])->name('enhanced-exams.user');

    // Subscription routes for admin
    Route::resource('subscriptions', \App\Http\Controllers\SubscriptionController::class);
});

// Route للاختبار بدون authentication
Route::get('/classes/list-test', [ClassController::class, 'list'])->name('classes.list.test');

// API Routes for AJAX (بدون authentication)
Route::get('/admin/classes/list-api', [\App\Http\Controllers\Admin\ClassController::class, 'list'])->name('classes.list.api');
Route::get('/api/study-classes', [\App\Http\Controllers\Api\StudyClassController::class, 'index']);
Route::get('/api/classes', [\App\Http\Controllers\Api\ClassController::class, 'index']);

// Subscription routes for authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/subscriptions/my', [\App\Http\Controllers\SubscriptionController::class, 'mySubscriptions'])->name('subscriptions.my');
    Route::get('/subscriptions/check-status', [\App\Http\Controllers\SubscriptionController::class, 'checkStatus'])->name('subscriptions.check-status');
});

Route::get('/test-readings', function () {
    $url = 'https://katamars.avabishoy.com/api/Katamars/GetReadings?year=2025&month=7&day=11&katamarsSourceId=1&synaxariumSourceId=0';

    $payload = [
        ["fontSection" => 2, "fontName" => "Arial", "fontSize" => 14, "isBold" => false, "color" => "#000000", "isRtl" => true, "isSelected" => true, "language" => 3],
        ["fontSection" => 1, "fontName" => "Arial", "fontSize" => 14, "isBold" => false, "color" => "#000000", "isRtl" => true, "isSelected" => false, "language" => 2],
        // ... كمل باقي الـ payload زي ما هو
    ];

    $headers = [
        'Referer' => 'https://katamars.avabishoy.com/Katamars',
        'Origin' => 'https://katamars.avabishoy.com',
        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36 Edg/138.0.0.0',
        'Content-Type' => 'application/json; charset=utf-8',
        'Accept' => '*/*'
    ];

    $response = Http::withHeaders($headers)->post($url, $payload);

    $data = $response->json();

    return view('test-readings', ['readings' => $data, 'date' => '2025-07-11']);
});

Route::get('/bible', [App\Http\Controllers\BibleController::class, 'index'])->name('bible.index');
Route::get('/bible/{book_number}', [App\Http\Controllers\BibleController::class, 'chapters'])->name('bible.chapters');
Route::get('/bible/{book_number}/{chapter_number}', [App\Http\Controllers\BibleController::class, 'show'])->name('bible.show');

Route::get('/old-testament', [App\Http\Controllers\BibleController::class, 'oldTestament'])->name('bible.old');
Route::get('/old-testament/{book_number}', [App\Http\Controllers\BibleController::class, 'oldChapters'])->name('bible.old.chapters');
Route::get('/old-testament/{book_number}/{chapter_number}', [App\Http\Controllers\BibleController::class, 'oldShow'])->name('bible.old.show');

use App\Http\Controllers\NewBibleChapterController;

Route::get('/new-testament', [NewBibleChapterController::class, 'index'])->name('bible.new');
Route::get('/new-testament/{book_number}', [NewBibleChapterController::class, 'index'])->name('bible.new.chapters');
Route::get('/new-testament/{book_number}/{chapter}', [NewBibleChapterController::class, 'show'])->name('bible.new.show');

// Photo Gallery Routes
Route::get('/photo-gallery', [App\Http\Controllers\PhotoGalleryController::class, 'index'])->name('photo-gallery.index');
Route::get('/photo-gallery/{id}', [App\Http\Controllers\PhotoGalleryController::class, 'show'])->name('photo-gallery.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/photo-gallery/create', [App\Http\Controllers\PhotoGalleryController::class, 'create'])->name('photo-gallery.create');
    Route::post('/photo-gallery', [App\Http\Controllers\PhotoGalleryController::class, 'store'])->name('photo-gallery.store');
    Route::get('/photo-gallery/{id}/edit', [App\Http\Controllers\PhotoGalleryController::class, 'edit'])->name('photo-gallery.edit');
    Route::put('/photo-gallery/{id}', [App\Http\Controllers\PhotoGalleryController::class, 'update'])->name('photo-gallery.update');
    Route::delete('/photo-gallery/{id}', [App\Http\Controllers\PhotoGalleryController::class, 'destroy'])->name('photo-gallery.destroy');

    // Photo management routes
    Route::post('/photo-gallery/{id}/upload-photos', [App\Http\Controllers\PhotoGalleryController::class, 'uploadPhotos'])->name('photo-gallery.upload-photos');
    Route::get('/photo-gallery/{galleryId}/photos/{photoId}/delete', [App\Http\Controllers\PhotoGalleryController::class, 'deletePhoto'])->name('photo-gallery.delete-photo');
    Route::get('/photo-gallery/{galleryId}/photos/{photoId}/download', [App\Http\Controllers\PhotoGalleryController::class, 'downloadPhoto'])->name('photo-gallery.download');

    // Admin routes for photo gallery
    Route::middleware(['auth'])->group(function () {
        Route::get('/photo-gallery/manage', [App\Http\Controllers\PhotoGalleryController::class, 'manage'])->name('photo-gallery.manage');
        Route::get('/photo-gallery/stats', [App\Http\Controllers\PhotoGalleryController::class, 'stats'])->name('photo-gallery.stats');
        Route::get('/photo-gallery/{id}/add-photos', [App\Http\Controllers\PhotoGalleryController::class, 'addPhotos'])->name('photo-gallery.add-photos');
        Route::patch('/photo-gallery/{id}/toggle-status', [App\Http\Controllers\PhotoGalleryController::class, 'toggleStatus'])->name('photo-gallery.toggle-status');
    });
});
