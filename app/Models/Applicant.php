<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_post_id',
        'job_seeker_id',
        'status',
    ];

    public function jobseeker() {
        return $this->belongsTo(JobSeeker::class,'job_seeker_id', 'id');
    }
    public function jobpost() {
        return $this->belongsTo(JobPost::class,'job_post_id', 'id');
    }
}
