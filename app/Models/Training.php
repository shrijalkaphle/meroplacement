<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'start_date',
        'duration',
        'image',
        'description',
        'status',
        'trainer_image',
        'trainer_name',
        'trainer_description',
        'fee'
    ];

    public function enroll() {
        return $this->hasMany(TrainingEnroll::class);
    }
}
