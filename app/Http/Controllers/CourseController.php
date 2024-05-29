<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\Course;
use App\Models\CourseSession;
use App\Models\CourseType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $courses = new Course;

        if ($request->has('search') && $request->search) {
            $courses = $courses->where('name', 'LIKE', "%{$request->search}%");
        }

        $request->flash();

        // dd($courses);

        $courses = $courses->paginate(20);

        return view('admin.formation.index', [
            'courses' => $courses,
        ]);
    }

    public function showCoursesType()
    {

        return view('courses');
    }
    public function showOnlineCourses()
    {
        $courses = Course::all();

        return view('online_courses', ['courses' => $courses]);
    }
    public function showPresenceCourses()
    {
        $courses = Course::whereHas('sessions')->get();
        return view('presence_courses', ['courses' => $courses]);
    }
    public function show(string $id)
    {
        $classrooms = ClassRoom::where('course_id', $id)->get();
        return view('course_details', ['classrooms' => $classrooms]);
    }
    public function create()
    {
        return view('admin.formation.create');
    }

    public function store(Request $request)
    {
        $sessionsStartAt = $request->sessions_start_at;
        $sessionsEndAt = $request->sessions_end_at;
        Log::info($sessionsStartAt);
        Log::info($sessionsEndAt);

        $numberOfStudents = $request->number_of_students;
        $courseTypeNames = $request->course_type_names;
        $courseTypePrices = $request->course_type_prices;
        $courseTypeDurations = $request->course_type_durations;
        $courseTypes = [];
        for ($i = 0; $i < count($courseTypeDurations); $i++) {
            $end_at = new Carbon();
            $end_at = $end_at->addDays((int) $courseTypeDurations[$i]);
            $courseTypes[] = [
                'name' => $courseTypeNames[$i],
                'price' => $courseTypePrices[$i],
                'start_at' => now(),
                'end_at' => $end_at,
            ];
        };
        Log::info($courseTypes);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',


        ]);
        /*       $imageName = time().'.'.$request->image->extension();
        $path=  $request->image->move(public_path('images'), $imageName); */
        $path = $request->file('image')->store('public/images',);

        $url = Storage::url($path);

        $course = Course::create([
            'number_of_students' => $numberOfStudents,
            'name' => $request->name,
            'description' => $request->description,
            'image' => $url,
        ]);
        $createdCourseTypes=   CourseType::insert($courseTypes);
        Log::info($createdCourseTypes);
        for ($i = 0; $i < count($sessionsStartAt); $i++) {
            $courseType =  CourseType::where('name', $courseTypeNames[$i])->where('price', $courseTypePrices[$i])->latest()->first();
            CourseSession::create(['course_type_id' => $courseType->id, 'start_at' => new Carbon($sessionsStartAt[$i]), 'end_at' => new Carbon($sessionsEndAt[$i]) , 'course_id' => $course->id]);
        };
        if (!$course) {
           return back()->withErrors(['error' => 'Une erreur est survenue']);
        }

        return redirect()->route('admin.courses.index');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);

        return view('admin.formation.edit', [
            'formation' => $course,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:255',
            'image' => 'image|mimes:png,jpg,jpeg,webp|max:2048|nullable',
            'description' => 'string|max:255'
        ]);

        $course = Course::findOrFail($id);

        if ($request->has('name') && $request->name) {
            $course->name = $request->name;
        }

        if ($request->has('image') && $request->image) {
            $path = $request->file('image')->store('public/images');
            $url = url($path);
            $course->image = $url;
        }

        if ($request->has('description') && $request->description) {
            $course->description = $request->description;
        }



        if ($course->save()) {
            return redirect()->route('formation.index');
        }

        return back();
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        if (!$course->delete()) {
            dd('erreur suppression');
        }

        return back();
    }
}
