<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

// مسارات إعادة تعيين كلمة المرور
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])
    ->name('password.update');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile')->middleware('auth');
Route::post('/profile/update', [App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('profile.update.profile')->middleware('auth');
Route::post('/profile/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
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
