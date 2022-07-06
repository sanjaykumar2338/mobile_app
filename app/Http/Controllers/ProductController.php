<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {

        $products = Product::paginate(5);
        return view('admin.products.index', compact('products'));
    }

    public function create() {
        $product = new Product();
        $category = Category::all();

        return view('admin.products.create', compact('product','category'));
    }

    public function store(Request $request) {

        // Validate the form
        $request->validate([
           'name' => 'required',
           'price' => 'required',
           'description' => 'required',
           'quantity' => 'required|integer',
           'available' => 'required',
           'image' => 'required',
           'category' => 'required'
        ]);

        // Upload the image
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image->move('uploads', $image->getClientOriginalName());
        }

        // Save the data into database
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'available' => $request->available,
            'quantity' => $request->quantity,
            'image' => $request->image->getClientOriginalName(),
            'category' => $request->category
        ]);

        // Sessions Message
        $request->session()->flash('msg','Your product has been added');

        // Redirect
        return redirect('admin/products/create');
    }

    public function edit($id) {
        $product = Product::find($id);
        $category = Category::all();

        return view('admin.products.edit', compact('product','category'));
    }

    public function update(Request $request, $id) {

        // Find the product
        $product = Product::find($id);

        // Validate The form
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'quantity' => 'required|integer',
            'available' => 'required',
            'category' => 'required'
        ]);

        // Check if there is any image
        if ($request->hasFile('image')) {
            // Check if the old image exists inside folder
            if (file_exists(public_path('uploads/') . $product->image)) {
                unlink(public_path('uploads/') . $product->image);
            }

            // Upload the new image
            $image = $request->image;
            $image->move('uploads', $image->getClientOriginalName());

            $product->image = $request->image->getClientOriginalName();
        }

        // Updating the product
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $product->image,
            'available' => $request->available,
            'quantity' => $request->quantity,
            'category' => $request->category
        ]);

        // Store a message in session
        $request->session()->flash('msg', 'Product has been updated');

        // Redirect
        return redirect('admin/products');

    }

    public function show($id) {
        $product = Product::find($id);
        return view('admin.products.details', compact('product'));
    }

    public function destroy($id) {
        // Delete the product
        Product::destroy($id);

        // Store a message
        session()->flash('msg','Product has been deleted');

        // Redirect back
        return redirect('admin/products');


    }
}
