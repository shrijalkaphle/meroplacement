<?php

namespace App\Models;

use Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CVMark extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'job_seeker_id'
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function jobseeker() {
        return $this->belongsTo(JobSeeker::class);
    }
}
