<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        "topic",
        "password", "enrollment_id", "meeting_id",
        "start_time",
        "start_url",
        "join_url"
    ];
    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}
