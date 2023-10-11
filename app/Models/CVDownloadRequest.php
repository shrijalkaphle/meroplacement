<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CVDownloadRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_seeker_id',
        'template',
        'status'
    ];

    public function jobseeker() {
        return $this->belongsTo(JobSeeker::class,'job_seeker_id','id');
    }
}
