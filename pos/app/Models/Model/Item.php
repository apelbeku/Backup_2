<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
    	'name', 'price', 'stock',
    ];

    public function order_details()
    {
    	return $this->hasMany(OrderDetail::class);
    }
}
