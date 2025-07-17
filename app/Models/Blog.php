<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /** @use HasFactory<\Database\Factories\BlogFactory> */
    use HasFactory;
    protected $fillable = [
        'headline',
        'category',
        'author',
        'author_id',
        'thumbnail',
        'image_caption',
        'image_credit',
        'content',
        'slug',
    ];
}
