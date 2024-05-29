<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Auth\Events\Registered;

class SignUpController extends Controller
{
    /**
     * Handle the registration request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:student,teacher',

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $userable = [];
        if ($request->role === "student") {
            $student = Student::create();
            $userable = [
                'id' => $student->id,
                'type' => Student::class
            ];
        } else {
            $teacher = Teacher::create();
            $userable = [
                'id' => $teacher->id,
                'type' => Teacher::class
            ];
        }
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'userable_type' => $userable['type'],
            'userable_id' => $userable['id']
        ]);
        event(new Registered($user));

     /*    dispatch(function () {
            event(new Registered($user));

        })->afterResponse(); */
        // Optionally, log the user in and redirect them to a dashboard or home page
        // Auth::login($user);
        // return redirect('/home');

        return redirect('/')->with('success', 'Registration successful. Please log in.');
    }
}
