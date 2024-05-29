<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function sessions()
    {
        return $this->hasMany(CourseSession::class);
    }
}
