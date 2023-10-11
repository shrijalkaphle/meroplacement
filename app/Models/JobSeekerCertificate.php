<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeekerCertificate extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_seeker_id',
        'title',
        'institute_name',
        'duration',
        'obtained_date',
    ];
}
