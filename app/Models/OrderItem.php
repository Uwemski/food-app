<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //

    public function order() {
        $this->belongsTo(Order::class);
    }

    public function orderItem() {
        $this->belongsTo(Product::class);
    }
}
