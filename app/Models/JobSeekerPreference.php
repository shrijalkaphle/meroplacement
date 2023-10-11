<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeekerPreference extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_seeker_id',
        'specialization',
        'skills',
        'looking_for',
        'location',
        'current_company',
        'current_position',
        'current_salary',
        'expected_salary',
        'industry_id',
        'languages'
    ];

    public function industry() {
        return $this->belongsTo(Industry::class);
    }


    public function jobseeker() {
        return $this->belongsTo(JobSeeker::class);
    }
}
