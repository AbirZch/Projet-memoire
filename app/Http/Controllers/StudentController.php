<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $students = new Student();

        if ($request->has('search') && $request->search) {
            $students = $students->user-> where('firstname', 'LIKE', "%{$request->search}%");
        }

        $request->flash();

        // dd($courses);
       $students = $students->paginate(20);

       return view('admin.students.index',['students'=>$students]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        if ($request->has('is_blocked'))
        {
            $student->is_blocked = 1;
        }
        else {
            $student->is_blocked = 0;
        }
        $student->save();
        return redirect()->route('students.index')->with(['success' => 'student updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {    User::where('userable_id', $student->id)->delete();
        $student->delete();

        return back()->with('success', 'student deleted successfully');
    }
}
