<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiumJob extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'industry_id',
        'title',
        'slug',
        'deadline',
        'status',
        'logo',
        'address',
        'description'
    ];
    public function company() {
        return $this->belongsTo(Company::class);
    }
    public function industry() {
        return $this->belongsTo(Industry::class);
    }

    public function applicant() {
        return $this->hasMany(PremiumApplicant::class);
    }
}
