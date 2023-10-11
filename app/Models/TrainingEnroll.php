<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingEnroll extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'name',
        'email',
        'mobile',
        'address',
        'status',
        'paid'
    ];

    public function training() {
        return $this->belongsTo(Training::class);
    }
}
