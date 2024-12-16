<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredients extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'ingredient_name',
        'quantity',
        'measurement',
        'manufactured_date',
        'expiration_date',
        'delivery_date'
    ];

    public function category(){

        return $this->hasMany(InventoryCategory::class,'id','category_id');
    }
}
