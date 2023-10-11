<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'company_id',
        'industry_id',
        'nature',
        'location',
        'education',
        'salary',
        'deadline',
        'vacancyno',
        'description',
        'status',
        'views',
        'logo'
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function industry() {
        return $this->belongsTo(Industry::class);
    }

    public function applicant() {
        return $this->hasMany(Applicant::class);
    }
}
