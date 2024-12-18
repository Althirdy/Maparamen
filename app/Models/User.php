<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'crew_id',
        'email',
        'phone',
        'status',
        'role',
        'password',
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
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function void_order()
    {
        return $this->belongsTo(Void_Order::class, 'crew_id', 'id');
    }

    public function successOrders()
    {
        return $this->hasMany(SuccessOrder::class, 'crew_id', 'id');
    }

    public function bad_order()
    {
        return $this->belongsTo(BadOrder::class, 'crew_id', 'id');
    }

    public function delivery()
    {
        return $this->hasMany(Delivery::class, 'crew_id', 'id');
    }
}
