<?php

namespace App\Http\Controllers;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\User;

use Illuminate\Http\Request;

class CartController extends Controller
{
    //

    // display cart page
    public function viewCart()
    {
        return view('cart.index');
    }

    //store in session
    public function addToCart(Request $request, $id)
    {

        // dd(';ss;ss,sf');working
        //gt product by id

        $product = Product::findOrFail($id);

        // dd($product);

        //if there's no cart, create one with session
        $cart  = session('cart', []);
        
        $quantity = $request->input('quantity', 1);

        if(isset($cart[$id]) ){
            $cart[$id]['quantity'] += $quantity;
        }else{
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'description' => $product->description,
                'quantity' => $quantity
            ];
        }

        //store in cart
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'product added successfully');
    }

    public function updateCart(Request $request)
    {

    }

    //empty entire cart
    public function clearCart()
    {
        //Get cart_item_id from request
        //Verify it belongs to current user's cart (security!)
        // Delete the cart_item
        // Return success
    }
}
