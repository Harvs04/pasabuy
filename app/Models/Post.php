<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, HasUuids;
    protected $fillable = [
        'type',
        'user_id',
        'poster_name',
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
        'mode_of_payment' => 'array',
        'delivery_date' => 'date',
        'cutoff_date' => 'date'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
