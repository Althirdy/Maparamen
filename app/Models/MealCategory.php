<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class MealCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category',
    ];

    public function meals()
    {
        return $this->hasMany(Meals::class, 'category_id','id');
    }
    
}
