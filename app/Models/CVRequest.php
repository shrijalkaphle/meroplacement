<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CVRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'access_till',
        'status'
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function cvlist() {
        return $this->hasMany(CVAccessList::class,'request_id','id');
    }
}
