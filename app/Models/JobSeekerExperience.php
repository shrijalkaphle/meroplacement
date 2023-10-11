<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeekerExperience extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_seeker_id',
        'organization_name',
        'organization_nature',
        'organization_location',
        'position',
        'start_date',
        'end_date',
        'responsibilities',
        'position_level'
    ];

    public function organization_industry() {
        return $this->belongsTo(Industry::class, 'organization_nature', 'id');
    }
}
