<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Order\OrderItem;

class Product extends Model
{
    //
    use Hasfactory,notifiable;

    protected $fillable= [
        'name','description','price','image','categories_id','is_available'
    ];

    protected $casts = [
        'image' => 'array'
    ];


    public function order() {
        $this->belongsTo(Order::class);
    }

    public function orderItem() {
        $this->hasMany(orderItem::class);
    }
}
