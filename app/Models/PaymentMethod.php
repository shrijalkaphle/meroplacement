<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'photo',
        'type',
        'acc_number',
        'acc_name'
    ];
}
