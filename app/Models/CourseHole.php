<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseHole extends Model
{
    /** @use HasFactory<\Database\Factories\CourseHoleFactory> */
    use HasFactory;
    protected $fillable = [
        'course_id',
        'hole_number',
        'par',
        'yardage',
    ];

    public function course()
    {
        return $this->belongsTo(CourseDetail::class);
    }
}
