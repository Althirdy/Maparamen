<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'ingredient_name',
        'crew_id',
        'quantity',
        'measurement',
        'delivery_date',
        'manufactured_date',
        'expiration_date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'crew_id', 'id');
    }
}
