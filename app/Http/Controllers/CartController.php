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
        $cartItems = session()->get('cart', []);

        // dd($cartItems);
        return view('cart.index', compact('cartItems'));
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
            // Get product ID and new quantity from request
            $product = Product::findOrFail($id);

            // Update quantity in session cart
            $cart = session('cart');

            if($request->quantity = 0){
                //clear cart
            }else{
                $cart[$request->product_id]['quantity'] = $request->quantity;
            }
            // If quantity is 0, remove item
            // Return response
    }

    //empty entire cart
    public function clearCart(Request $request)
    {
        //Get cart_item_id from request
        $cart = session('cart');
        // dd($cart);
        // Delete the cart_item
        session()->forget('cart');
        // Return success
        return redirect()->back()->with('cleared','Cart cleared successfully');
    }
    
    //remove item by id
    public function removeItem($id)
    {
        $product = Product::findOrFail($id);
        // dd($product);
        $cart=session('cart');

        if(isset($cart[$id])){
            unset($cart[$id]);

            session(['cart' => $cart]);
            return redirect()->back()->with('success','Cart deleted successfully');
        }else {
            return redirect()->back()->with('error','Cart does not exist');
        }
    }
}
