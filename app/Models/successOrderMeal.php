<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class successOrderMeal extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'success_order_id',
        'meal_id',
        'quantity'
    ];

    public function successOrder()
    {
        $this->hasMany(SuccessOrder::class, 'success_order_id', 'id');
    }

    public function meals()
    {
        $this->hasMany(Meals::class, 'meal_id', 'id');
    }
}
