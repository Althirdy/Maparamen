<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meals extends Model
{
    use HasFactory;

    protected $fillable = [
        'meal_name',
        'meal_price',
        'meal_img',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(MealCategory::class, 'category_id', 'id');
    }

    public function void_order()
    {
        return $this->belongsTo(Void_Order::class, 'meal_id', 'id');
    }

    public function successOrderMeal(){
        return $this->belongsTo(successOrderMeal::class,'meal_id','id');
    }    

    public function bad_order(){
        return $this->belongsTo(BadOrder::class,'meal_id','id');
    }
}
