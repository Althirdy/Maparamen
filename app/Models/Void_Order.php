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
        'status'
    ];

    public function meals()
    {
        return $this->hasMany(Meals::class, 'meal_id','id');
    }

    public function user(){

        return $this->hasMany(User::class,'crew_id','id');
    } 
    
}
