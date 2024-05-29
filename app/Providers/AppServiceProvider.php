<?php

namespace App\Providers;

use App\Models\ClassRoom;
use App\Models\Enrollment;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
       //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)->greeting('Hello ' . $notifiable->firstname . ' ' . $notifiable->lastname . '!')
                ->subject('Verify Email Address')
                ->line('Click the button below to verify your email address.')
                ->action('Verify Email Address', $url);
        });
    
        

        //
        Gate::define('access-admin_panel', function ($user) {
            return $user->role === 'admin';
        });
        Gate::define('edit-enrollment', function (User $user, Enrollment $enrollment) {
            return $user->role === 'teacher' && $enrollment->classroom->teacher_id === $user->userable_id;
        });
        Gate::define('create-enrollment', function (User $user) {
            return $user->role === 'student';
        });
        Gate::define('delete-enrollment', function (User $user, Enrollment $enrollment) {
            return $user->role === 'teacher' && $enrollment->classroom->teacher_id === $user->userable_id;
        });
        Gate::define('read-enrollment', function (User $user, Enrollment $enrollment) {
            return ($user->role === 'teacher'  &&
                $enrollment->classroom->teacher_id === $user->userable_id) ||
                ($user->role === 'student' && $enrollment->student->id === $user->userable_id);
        });
        Gate::define('access-teacher_panel', function (User $user) {
            return $user->role === 'teacher';
        });
        Gate::define('delete-teacher_subscription', function (User $user,) {
            return $user->role === 'teacher';
        });
        Gate::define('create-teacher_subscription', function (User $user, Teacher $teacher) {
            return $user->role === 'teacher' &&  $teacher->is_authorized === 1;
        });
    }
}
