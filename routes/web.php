<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

Route::get('/test',function (){
    return view('test');
});
Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/courses', [CourseController::class, 'showCoursesType'])->name('courses.showCourses');
Route::get('/courses/online', [CourseController::class, 'showOnlineCourses'])->name('courses.online');
Route::get('/courses/presence', [CourseController::class, 'showPresenceCourses'])->name('courses.presence');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/store', function () {
    return view('store');
})->name(('store'));

///////////////////////////////////////////////////////AUTHENTICATION ROUTES/////////////////////////////////////////////////// 

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/')->with('success', 'Your email has been verified!');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', [ResetPasswordController::class, "sendResetLink"])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('home')->with('success', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

Route::group(['namespace' => 'Auth'], function () {
    Route::post('/login', [LoginController::class, "authenticate"])->name('login');
    Route::post('/logout', [LogoutController::class, "logout"])->name('logout');
    Route::post('/signup', [SignUpController::class, "register"])->name('signup');
});

/////////////////////////////////////////////////////STUDENT ROUTES///////////////////////////////////////////////////

Route::get('/me', [ProfileController::class, 'index'])->name(('me'))->middleware('auth');
Route::get('/me/enrollments', [EnrollmentController::class, 'index'])->name(('me.enrollments'))->middleware('auth');


/////////////////////////////////////////////////////ADMIN ROUTES///////////////////////////////////////////////////

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('courses')->name('courses.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('/create', [CourseController::class, 'create'])->name('create');
        Route::post('/store', [CourseController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CourseController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [CourseController::class, 'update'])->name('update');
        Route::post('/destroy/{id}', [CourseController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('teachers')->name('teachers.')->group(function () {

        Route::get('/', [TeacherController::class, 'index'])->name('index');
        Route::delete('/{id}', [TeacherController::class, 'destroy'])->name('destroy');
        Route::post('/{id}', [TeacherController::class, 'update'])->name('update');
    });
    Route::get('/presence', [EnrollmentController::class, 'showPresenceEnrollments'])->name('presence');
    Route::prefix('students')->name('students.')->group(function () {

        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::patch('/{student}', [StudentController::class, 'update'])->name('update');
        Route::delete('/{student}', [StudentController::class, 'destroy'])->name('destroy');
    });
});
/////////////////////////////////////////////////////// TEACHER CONTROL PANEL ///////////////////////////////////////////
Route::prefix('teachers')->name('teachers.')->middleware('auth')->group(function () {
    Route::get('/me', [TeacherController::class, 'profile'])->name(('profile'));
    Route::post('/me/upload', [TeacherController::class, 'upload'])->name(('me.upload'));

    Route::get('/me/requests', [EnrollmentController::class, 'index'])->name(('requests'));
    Route::patch('/me/requests/{id}', [TeacherController::class, 'accept'])->name(('accept'));
    Route::get('/me/students', [TeacherController::class, 'students'])->name(('students'));
    Route::get('/me/meetings/{id}', [MeetingController::class, 'show'])->name(('meeting'));

    Route::get('/me/inscriptions', [TeacherController::class, 'inscriptions'])->name(('inscriptions'));
    Route::post('me/inscriptions/{id}', [TeacherController::class, "editinscription"])->name(('edit'));
});


/////////////////////////////////////////////////// ENROLLMENTS ROUTES ///////////////////////////////////////////////
Route::post('/enrollments', [EnrollmentController::class, 'store'])->name('enrollment.store')->middleware('auth');
Route::patch('/enrollments/{id}', [EnrollmentController::class, 'update'])->name('enrollment.update')->middleware('auth');








