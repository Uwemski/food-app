<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index() 
    {
        $products = Product::all();
        // if($product->isNotEmpty){
            // return view('admin.products.index', compact('product'));    
        // }
        return view('admin.products.index', compact('products'));

    }

    public function guestIndex()
    {
        $products = Product::where('is_available', 'available')->get();

        return view('shop.products', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request) 
    {
        // dd($request->all());
        //validate
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg,pdf|max:10025',
            'categories_id' => 'required'
        ]);

        // dd($data);
        //strip_tags
        $data['name'] = strip_tags($data['name']);
        $data['description'] = strip_tags($data['description']);
        $data['image'] = strip_tags($data['image']);

        //try catch
        try{
            if($request->hasFile('image')) {
                $path = $request->file('image')->store('uploads', 'products');
                $data['image'] = $path;
            }

            $pro = Product::create($data);
            return redirect()->back()->with('success', 'product created successfully');
        } catch(\Exception $e) {
            // Logg
            \Log::error('Product creation failed: '. $e->getMessage());
            return redirect()->back()->with('error', 'error encountered, try again');
        }

    }

    //edit
    public function edit($id) 
    {
        $product = Product::findOrFail($id);
        // dd('askamaya');

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    public function update(Request $request, $id)
    {
        dd('yewqgwgwquieiuw');
    }

    //patch request for availability
    public function updateAvailabilty(Request $request, Product $product)
    {
        $data = $request->validate([
            'is_available' => 'required|in:available,not_available'
        ]);

        $y = $product->update($data);

        if($y) {
            return response()->json([
                'success' => true,
                'message' => 'Availability updated successfully',
                'product' => $product
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Error encountered'
            ]);
        }
        
    }
    
    public function delete($id) 
    {
        $pro = Product::findOrFail($id);

        $pro->delete();
        //if you're not using json
        return redirect()->back()->with('success', 'product deleted successfully');

    }

    

}
