<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class returnIngredients extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'ingredient_name',
        'quantity',
        'measurement',
        'return_date',
        'delivery_date',
        'return_reason',
        'remarks'
    ];


    public function delivery()
    {
        return $this->belongsTo(Delivery::class, 'order_id', 'id');
    }
}
