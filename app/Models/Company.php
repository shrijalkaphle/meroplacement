<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'slug',
        'address',
        'website',
        'industry_id',
        'logo',
        'description'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function jobpost() {
        return $this->hasMany(JobPost::class);
    }
    public function industry() {
        return $this->belongsTo(Industry::class);
    }
    public function allrequest() {
        return $this->hasMany(CVRequest::class);
    }
    public function request() {
        return $this->allrequest()->where('status', '=','1');
    }
}
