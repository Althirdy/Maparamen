<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuccessOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'crew_id',
        'total_amount',
        'tender',
        'change',
        'paymentMethod',
        'orderType',
        'isDiscounted',
        'reference_number'
    ];

    public function successOrderMeal(){
        return $this->belongsTo(successOrderMeal::class,'success_order_id','id'); 
    }

    public function user(){
        return $this->hasMany(User::class,'crew_id','id');
    }
}
