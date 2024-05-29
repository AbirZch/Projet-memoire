<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = ["enrollment_date", "meeting_date", "classroom_id", "student_id", "link", "status", "topic", "is_present", "course_session_id"];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function classroom()
    {
        return $this->belongsTo(ClassRoom::class);
    }
    public function meeting()
    {
        return $this->hasOne(Meeting::class);
    }
    public function session()
    {
        return $this->belongsTo(CourseSession::class, 'course_session_id');
    }
}
