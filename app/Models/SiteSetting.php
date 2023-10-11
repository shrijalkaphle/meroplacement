<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'meta_title',
        'meta_description',
        'meta_keyword',
        'about',
        'email',
        'number',
        'address',
        'favicon',
        'logo',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'termscondition',
        'training_banner',
        'footer_about'
    ];
}
