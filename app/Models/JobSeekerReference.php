<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeekerReference extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_seeker_id',
        'name',
        'position',
        'organization_name',
        'email',
        'contact_home',
        'contact_mobile',
    ];
}
