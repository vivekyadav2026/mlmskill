<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'company_name', 'description', 'location', 
        'salary_range', 'job_type', 'category', 'status'
    ];

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
}
