<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $fillable=['teacher_id','course_id'];
protected $table='classrooms';
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
