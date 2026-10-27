<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Student;

Route::get('/', function () {
    $user = auth()->user();
    if (!$user) return redirect()->route('login');
    return redirect()->route($user->role === 'admin' ? 'admin.dashboard' : 'student.profile');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('classes', Admin\ClassController::class);
    Route::resource('students', Admin\StudentController::class);
    Route::resource('subjects', Admin\SubjectController::class);
    Route::resource('scores', Admin\ScoreController::class);
});

Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/profile', [Student\ProfileController::class, 'index'])->name('profile');
    Route::get('/class', [Student\ClassController::class, 'index'])->name('class');
    Route::get('/scores', [Student\ScoreController::class, 'index'])->name('scores');
});
