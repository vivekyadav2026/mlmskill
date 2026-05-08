<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id',
        'title',
        'description',
        'price',
        'content_type',
        'content_url',
        'status',
    ];

    public function module()
    {
        return $this->belongsTo(CourseModule::class, 'module_id');
    }

    public function progress()
    {
        return $this->hasMany(CourseProgress::class);
    }

    public function lessons()
    {
        return $this->hasMany(CourseLesson::class);
    }
}
