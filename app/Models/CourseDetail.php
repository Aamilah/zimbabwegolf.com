<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CourseHole;

class CourseDetail extends Model
{
    /** @use HasFactory<\Database\Factories\CourseDetailFactory> */
    use HasFactory;
    protected $fillable = [
        'name',
        'location',
        'description',
        'par',
        'total_yardage',
    ];

    public function holes()
    {
        return $this->hasMany(CourseHole::class);
    }
}
