<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'order_id',
        'provider_id',
        'customer_id',
        'star_rating',
        'remarks'
    ];
}
