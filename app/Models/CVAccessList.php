<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CVAccessList extends Model
{
    use HasFactory;
    protected $fillable = [
        'request_id',
        'job_seeker_id'
    ];

    public function jobseeker() {
        return $this->belongsTo(JobSeeker::class,'job_seeker_id','id');
    }
}
