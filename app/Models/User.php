<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'contact_number',
        'constituent',
        'college',
        'degree_program',
        'email',
        'role',
        'successful_orders',
        'cancelled_orders',
        'successful_deliveries',
        'cancelled_transactions',
        'password',
        'google_id',
        'profile_pic_url',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime'
    ];

     public function like_posts(): HasMany
     {
         return $this->hasMany(LikePost::class, 'user_id', 'id');
     }

    public function save_posts(): HasMany
    {
        return $this->hasMany(SavePost::class, 'user_id', 'id');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id', 'id')->where('type', 'transaction');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'customer_id', 'id');
    }

    public function deliveries(): HasMany
    {
        return $this->hasMany(Order::class, 'provider_id', 'id');
    }


    public function notification_as_poster(): HasMany
    {
        return $this->hasMany(Notification::class, 'poster_id', 'id')->orderByDesc('created_at');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class, 'provider_id', 'id')->orderByDesc('created_at');
    }

    public function conversations_as_provider(): HasMany
    {
        return $this->hasMany(Conversation::class, 'provider_id', 'id')->orderByDesc('created_at');
    }

    public function conversations_as_customer(): HasMany
    {
        return $this->hasMany(Conversation::class, 'customer_id', 'id')->orderByDesc('created_at');
    }

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
