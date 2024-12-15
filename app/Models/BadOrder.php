<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadOrder extends Model
{
    use HasFactory;

    protected $fillable= [
        'invoice_no',
        'crew_id',
        'meal_name',
        'quantity',
        'price',
        'status',
        'return_reason'
    ];
    
}
