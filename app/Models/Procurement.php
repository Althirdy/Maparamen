<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'ingredient_id',
        'quantity',
        'status'
    ];


    public function ingredients()
    {
        return $this->hasMany(Ingredients::class, 'id', 'ingredient_id');
    }
}
