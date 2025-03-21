<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    // remove later
    protected static function boot()
    {
        parent::boot();

        // Before saving the model, update status if it's a transaction
        static::saving(function ($post) {
            if ($post->type === 'transaction') {
                $post->updateTransactionStatus();
            }
        });
    }

    // Method to update transaction status based on cutoff date
    public function updateTransactionStatus()
    {
        if ($this->cutoff_date && Carbon::parse($this->cutoff_date)->isAfter(Carbon::now())) {
            $this->status = 'ongoing';
            $this->save();
        }
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
