<?php

namespace App\Models;

use Session;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSeeker extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'gender',
        'dob',
        'website',
        'nationality',
        'current_address',
        'permanent_address',
        'photo',
        'aboutme'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function preference() {
        return $this->hasOne(JobSeekerPreference::class);
    }

    public function reference() {
        return $this->hasOne(JobSeekerReference::class);
    }

    public function experience() {
        return $this->hasMany(JobSeekerExperience::class);
    }

    public function education() {
        return $this->hasMany(JobSeekerEducation::class);
    }

    public function certificate() {
        return $this->hasMany(JobSeekerCertificate::class);
    }

    public function apply() {
        return $this->hasMany(Applicant::class);
    }

    public function templaterequest() {
        return $this->hasMany(CVDownloadRequest::class);
    }

    public function age() {
        return Carbon::parse($this->attributes['dob'])->age;
    }

    public function allmark() {
        return $this->hasMany(CVMark::class);
    }

    public function mark() {
        $company = Company::where(['user_id' => Session::get('user')['userid']])->first();
        return $this->allmark()->where('company_id','=', $company->id);
    }

    public function cvlist() {
        return $this->hasMany(CVAccessList::class);
    }

    public function cvrequest() {
        return $this->hasMany(RequestedCV::class,'job_seeker_id','id');
    }
}
