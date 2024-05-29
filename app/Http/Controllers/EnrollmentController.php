<?php

namespace App\Http\Controllers;

use App\Jobs\processEmailReminder;
use App\Mail\MeetingReminder;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Meeting;
use App\Models\Reminder;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $enrollments = new Enrollment();
        if ($user->role === "teacher") {
            $enrollments = $enrollments->whereHas("classroom", function ($query) use ($user) {
                return $query->where("teacher_id", $user->userable_id);
            })->where('is_present', 0)->get();
            Log::info($enrollments);
            return view('teacher.students_requests.index', ['enrollements' => $enrollments]);
        } else if ($user->role === "student") {
            $enrollments = $enrollments->where("student_id", $user->userable_id)->get();
            return view('student.enrollments.index', ['enrollments' => $enrollments]);
        }
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
        if (Gate::denies('create-enrollment')) {
            return abort(403);
        }
        $user =  $request->user();


        $isPresent = $request->has('is_present') ? 1 : 0;
        $student = Student::find($user->userable_id);
        if ($isPresent) {
            $courseId = $request->input('course_id');
            $course = Course::find($courseId);
            $sessionId = $request->input('course_session_id');
            $currentEnrollments = Enrollment::where("course_session_id", $sessionId)
                ->get();
            if ($currentEnrollments->count() >= $course->number_of_students) {
                return back()->withErrors(['error' => 'The classroom is full']);
            }
            $enrollment = Enrollment::create(['student_id' => $student->id, 'enrollment_date' => now("UTC"), "is_present" => $isPresent, "course_session_id" => $sessionId, "status" => "accepted"]);
        } else {
            $classroomId = $request->input('classroom_id');
            $enrollment = Enrollment::create(['classroom_id' => $classroomId, 'student_id' => $student->id, 'enrollment_date' => now("UTC"), "is_present" => $isPresent,]);
        }
        return back()->with(['success' => 'enrollment added successfully']);
    }

    /**
     * Display the specified resource.
     */
    public function showPresenceEnrollments()
    {
        $enrollments=Enrollment::where("is_present",1)->get();
        return view('admin.offline_inscriptions', ['enrollments' => $enrollments]);

    }

 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $enrollment = Enrollment::find($id);
        if (Gate::denies('edit-enrollment', $enrollment)) {
            abort(403);
        }
        $validator = Validator::make($request->all(), [
            'link' => 'required|string',
            'status' => 'required|in:accepted,refused,pending',
            'meeting_date' => 'date|required_if:status,accepted'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $status =  $request->input('status');
        if ($status === "accepted") {
            $link = $request->input('link');
            $meeting_date = Carbon::parse($request->input('meeting_date'));
            $meeting_topic = $request->input('topic');

            $enrollment->update(['status' => $status, 'meeting_date' => $meeting_date, "link" => $link, "topic" => $meeting_topic]);
            if (now()->gte($meeting_date->subHours(2))) {
                Reminder::firstOrCreate(
                    ['enrollment_id' => $enrollment->id],
                    [
                        'remind_at' => $meeting_date->subHours(2), 'attendeeName' => $enrollment->student->user->getName(),
                        'meetingOrganizer' => $enrollment->classroom->teacher->user->getName()
                    ]

                );
            }
            return redirect()->back()->with(['success' => 'enrollment updated successfully']);
        } else {
            $enrollment->update(['status' => $status]);
        }
    }

    public function destroy(string $id)
    {
        $enrollment = Enrollment::find($id);

        if (Gate::denies('delete-enrollment', $enrollment)); {
            abort(403);
        }
        $enrollment->delete();
    }
}
