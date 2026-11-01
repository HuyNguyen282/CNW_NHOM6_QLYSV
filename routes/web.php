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

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Thêm route thống kê bảng điểm tổng hợp theo lớp
    Route::get('/statistics/class/{id}', [Admin\ScoreStatisticsController::class, 'byClass'])->name('statistics.by_class');

    // Route phụ trợ tra cứu điểm sinh viên
    Route::get('scores/student-lookup', [Admin\ScoreController::class, 'lookupStudent'])->name('scores.student-lookup');

    // Các resource quản lý trong Admin
    Route::resource('classes', Admin\ClassController::class);
    Route::resource('students', Admin\StudentController::class);
    Route::resource('subjects', Admin\SubjectController::class);
    Route::resource('scores', Admin\ScoreController::class);
    Route::resource('faculties', Admin\FacultyController::class);
    Route::resource('majors', Admin\MajorController::class);

});

Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/profile', [Student\ProfileController::class, 'index'])->name('profile');
    Route::get('/class', [Student\ClassController::class, 'index'])->name('class');
    Route::get('/scores', [Student\ScoreController::class, 'index'])->name('scores');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');