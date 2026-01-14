<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\File; // Needed to delete image files

class AdminProductController extends Controller
{
    /**
     * Show Products Page
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products', compact('products'));
    }

    /**
     * Add New Product
     */
    public function store(Request $request)
    {
        // 1. Validate Input
        $request->validate([
            'name' => 'required|unique:products,name',
            'price' => 'required|numeric',
            'details' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // 2. Handle Image Upload
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('uploaded_img'), $imageName);

        // 3. Create Product
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
            'image' => $imageName,
        ]);

        return back()->with('success', 'Product added successfully!');
    }

    /**
     * Delete Product
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            // 1. Delete Image File
            $imagePath = public_path('uploaded_img/' . $product->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }

            // 2. Delete from Cart & Wishlist (Cleanup)
            Cart::where('product_id', $id)->delete();
            Wishlist::where('product_id', $id)->delete();

            // 3. Delete Product Record
            $product->delete();

            return back()->with('success', 'Product deleted successfully!');
        }

        return back()->with('message', ['Product not found!']);
    }

    // ... existing index, store, and destroy functions ...

    /**
     * Show the Update Page
     */
    public function edit($id)
    {
        $product = Product::find($id);
        
        // Safety check: if product doesn't exist, go back
        if(!$product){
            return redirect()->route('admin.products');
        }

        return view('admin.update_product', compact('product'));
    }

    /**
     * Process the Update
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if(!$product){
            return back()->with('message', ['Product not found!']);
        }

        // 1. Update Text Fields
        $product->name = $request->name;
        $product->price = $request->price;
        $product->details = $request->details;

        // 2. Handle Image Update (Only if a new file is uploaded)
        if ($request->hasFile('image')) {
            
            // Delete Old Image
            $oldImagePath = public_path('uploaded_img/' . $product->image);
            if (\Illuminate\Support\Facades\File::exists($oldImagePath)) {
                \Illuminate\Support\Facades\File::delete($oldImagePath);
            }

            // Upload New Image
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploaded_img'), $imageName);
            
            // Save new filename to database
            $product->image = $imageName;
        }

        $product->save();

        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }
}