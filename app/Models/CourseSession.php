<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSession extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
