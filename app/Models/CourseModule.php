<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModule extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status'];

    public function courses()
    {
        return $this->hasMany(Course::class, 'module_id');
    }
}
