<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    //dashboard
    public function index()
    {
        $users = User::count();
        $products = Product::count();
        // $order_item = OrderItem::count();

        return view('admin.dashboard', compact('users','products'));
    }

    public function editCategory($id) {
        $category = Category::findOrFail($id);

        if(!$category) {
            return response()->json([
                'success' => false,
                'message' => "Category doesn't exist"
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => $category
        ]);
    }
}
