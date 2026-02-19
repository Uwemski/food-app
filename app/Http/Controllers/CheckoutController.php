<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;

class CheckoutController extends Controller
{
    //index method
    public function index()
    {
     return view('cart.checkout');
    }

    // Wrap order creation in 
    // DB::transaction()
    //handle checkout request
    public function processCheckout(CheckoutRequest $request)
    {
        $cart = session('cart');
        dd($cart);
    }
}
