<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeekerEducation extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_seeker_id',
        'qualification_id',
        'program',
        'board',
        'institute_name',
        'start_date',
        'end_date',
    ];

    public function qualification() {
        return $this->belongsTo(Qualification::class);
    }
    
       public function jobseeker() {
        return $this->belongsTo(JobSeeker::class);
    }
}
