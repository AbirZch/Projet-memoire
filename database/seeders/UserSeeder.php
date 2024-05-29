<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
     


    public function run(): void
    {    
        User::firstOrCreate(
            ['email' => "admin@laravel.com"],
            [
                'firstname' => "admin",
                'lastname' => "admin",
                'password' => Hash::make('12345'),
                'role' => 'admin'
            ]
        );
      $student=  Student::create();
        User::updateOrCreate(
            ['email' => "student2@laravel.com",],
            [
                'firstname' => "student",
                'lastname' => "student",
                'password' => Hash::make('12345'),
                'role' => 'student',
                'userable_id' =>$student->id,
                'userable_type'=>Student::class
            ]
        );
    $teacher= Teacher::create();
    User::updateOrCreate(
        ['email' => "teacher@laravel.com",],
        [
            'firstname' => "teacher",
            'lastname' => "teacher",
            'password' => Hash::make('12345'),
            'role' => 'teacher',
            'userable_id' =>$teacher->id,
            'userable_type'=>Teacher::class
        ]
    );

    }
}
