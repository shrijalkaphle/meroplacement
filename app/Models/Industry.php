<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'job_count',
        'status',
        'photo'
    ];

    public function jobs() {
        return $this->hasMany(JobPost::class);
    }

    public function preference() {
        return $this->hasMany(JobSeekerPreference::class);
    }
}
