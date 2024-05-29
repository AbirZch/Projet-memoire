<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'image', 'number_of_students'
    ];
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
    public function sessions()
    {
        return $this->hasMany(CourseSession::class);
    }
}
