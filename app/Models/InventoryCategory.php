<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'category'
    ];

    public function ingredients(){
        return $this->belongsTo(Ingredients::class,'category_id','id');
    }

}
