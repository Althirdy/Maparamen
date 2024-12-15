<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Void_Order extends Model
{
    use HasFactory;

    protected $table = 'void_orders';

    protected $fillable = [
        'crew_id',
        'meal_id',
        'quantity',
        'status'
    ];

    public function meals()
    {
        return $this->hasMany(Meals::class, 'id', 'meal_id');
    }

    public function users(){

        return $this->hasMany(User::class,'id','crew_id');
    } 
    
}
