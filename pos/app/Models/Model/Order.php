<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id', 'customer_name', 'total',
    ];

    public function order_details()
    {
    	return $this->hasMany(OrderDetail::class);
    }
}
