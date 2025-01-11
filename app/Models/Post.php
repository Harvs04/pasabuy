<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'user_id',
        'item_name',
        'item_origin',
        'item_type',
        'sub_type',
        'item_image',
        'delivery_date',
        'arrival_time',
        'mode_of_payment',
        'transaction_fee',
        'max_orders',
        'cutoff_date',
        'meetup_place',
        'additional_notes',
    ];    

    protected $casts = [
        'item_type' => 'array',
        'sub_type' => 'array',
        'mode_of_payment' => 'array'
    ];
}
