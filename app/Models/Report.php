<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'sender_id',
        'reported_id',
        'post_id',
        'order_id',
        'type',
        'complaint'
    ];
}
