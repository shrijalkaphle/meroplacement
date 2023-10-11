<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestedCV extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_seeker_id',
        'template',
        'type',
        'file',
        'status'
    ];

    public function jobseeker() {
        return $this->belongsTo(JobSeeker::class);
    }
}
