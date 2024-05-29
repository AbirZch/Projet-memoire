<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{

    public function index(Request $request)
    {

        $teachers = new Teacher();

        Log::info($teachers);
        if ($request->has('search') && $request->search) {
            $teachers = $teachers->user->where('firstname', 'LIKE', "%{$request->search}%");
        }

        $request->flash();

        // dd($courses);


        $teachers = $teachers->paginate(3);
        Log::info($teachers);
     
        return view('admin.teachers.index', ['teachers' => $teachers]);
    }


    public function store(Request $request)
    {
        //
    }

    public function show(Teacher $teacher)
    {
        //
    }

    public function edit(Teacher $teacher)
    {
        # return  view('admin.teachers.edit', compact('teacher'));
    }
public function upload(Request $request)  {
 
  $request->validate([
        'profile_img' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
    ]);
     
    $fileName = time() . '.' . $request->profile_img->extension();
  $path=  $request->profile_img->storeAs('public/images/profile/', $fileName);
  Log::info($path);
    $url = Storage::url($path);
    $user = $request->user();
    $user->img_url = $url;
    $user->save();

    return redirect()->back()->with('success', 'Image uploaded successfully!');
}
 
    public function update(Request $request, string $id)
    {
        if (Gate::denies('access-admin_panel')) {
            abort(403);
        }
        $teacher = Teacher::find($id);
        $is_authorized = 0;

        if ($request->has('is_auth')) {


            $is_authorized = 1;
        }
        $teacher->is_authorized = $is_authorized;

        $teacher->save();
        return back()->with('success', 'Teacher updated successfully');
    }

    public function accept(Request $request, string $id)
    {

        return back();
    }
    public function profile()
    {

        return view('teacher.profile');
    }



    public function destroy(string $id)
    {
        if (Gate::denies('access-admin_panel')) {
            abort(403);
        }

        Teacher::destroy($id);
        return back();
    }
    public function students()
    {
        $user = Auth::user();
        if (Gate::denies('access-teacher_panel')) {
            abort(403);
        }
        $enrollments = Enrollment::whereHas("classroom", function ($query) use ($user) {
            return $query->where("teacher_id", $user->userable_id);
        })->where("status", "accepted")->get();
        return view('teacher.students', ['enrollements' => $enrollments]);
    }
    public function editInscription(Request $request, string $id)
    {
        $user = Auth::user();
        $teacher = Teacher::find($user->userable_id);


        if ($request->has('is_subscribed')) {
            if (Gate::denies('create-teacher_subscription', $teacher)) {
                abort(403);
            }
            $classroom = ClassRoom::firstOrCreate(['teacher_id' => $teacher->id, 'course_id' => $id]);
            return back()->with('success', 'Inscription added successfully');
        } else {
 
            if (Gate::denies('delete-teacher_subscription')) {
                abort(403);
            }
            ClassRoom::where('teacher_id', $teacher->id)->where('course_id', $id)->delete();
            return back()->with('success', 'Inscription deleted successfully');
        }
    }
    public function inscriptions()
    {
        $user = Auth::user();
        if (Gate::denies('access-teacher_panel')) {
            abort(403);
        }
        $teacher = Teacher::find($user->userable_id);

        $teacherClassRooms = $teacher->classrooms;
        $courses = Course::all();
        return view('teacher.inscriptions', ['classrooms' => $teacherClassRooms, 'courses' => $courses]);
    }
}
