<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollInquiry extends Model
{
    use HasFactory;
    protected $fillable = [
        'training_id',
        'name',
        'email',
        'mobile',
        'address',
    ];

    public function training() {
        return $this->belongsTo(Training::class);
    }
}
