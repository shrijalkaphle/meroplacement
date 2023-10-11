<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumApplicant extends Model
{
    use HasFactory;
    protected $fillable = [
        'premium_job_id',
        'name',
        'email',
        'mobile',
        'education',
        'status',
        'address',
        'resume'
    ];
}
