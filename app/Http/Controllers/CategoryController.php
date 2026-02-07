<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Request\StoreCategoryRequest;


class CategoryController extends Controller
{
    //a function to list
    public function index() 
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        // dd($request->all());
        //form request
        $data = $request->validated();

        // dd($data);
        try{
            if($request->hasFile('image')) {
                $path = $request->file('image')->store('uploads', 'categories');
                $data['image'] = $path;
            }

            $category = Category::create($data);

            if($category) {
                return redirect()->back()->with('success', 'category created successfully');
            }
        }catch(\Exception $e) {
            \Log::error('Category creation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'something happened, try again later');
        }
    }

    public function update(StoreCategoryRequest $request, $id) 
    {
        try {
            // Find the category
            $category = Category::findOrFail($id);
            // Validate the request
            $validated = $request->validated();
            
            // Handle image upload if present
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($category->image && \Storage::exists('public/' . $category->image)) {
                    \Storage::delete('public/' . $category->image);
                }
                
                // Store new image and add to validated data
                $validated['image'] = $request->file('image')->store('categories', 'public');
            }
            
            // Update all fields at once
            $category->update($validated);
            
            return response()->json([
                'success' => true,
                'message' => 'Category updated successfully!',
                'data' => $category->fresh() // Get the updated data
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'error' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            \Log::error('Category update error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to update category: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        // dd($category);
        $category->delete();
        return redirect()->back()->with('Success', 'Category deleted successfully');
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Category deleted successfully'
        // ]);
    }
}
