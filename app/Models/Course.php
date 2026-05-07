<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'content_type',
        'content_url',
        'status',
    ];

    public function progress()
    {
        return $this->hasMany(CourseProgress::class);
    }

    public function lessons()
    {
        return $this->hasMany(CourseLesson::class);
    }
}
