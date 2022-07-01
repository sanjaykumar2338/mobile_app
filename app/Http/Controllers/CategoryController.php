<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {

        $category = Category::all();

        return view('admin.category.index', compact('category'));
    }

    public function create() {
        $category = new Category();
        return view('admin.category.create', compact('category'));
    }

    public function store(Request $request) {

        // Validate the form
        $request->validate([
           'name' => 'required',          
           'image' => 'required'
        ]);

        // Upload the image
        if ($request->hasFile('image')) {
            $image = $request->image;
            $image->move('uploads', $image->getClientOriginalName());
        }

        // Save the data into database
        Category::create([
            'name' => $request->name,            
            'image' => $request->image->getClientOriginalName()
        ]);

        // Sessions Message
        $request->session()->flash('msg','Your Category has been added');

        // Redirect
        return redirect('admin/category/create');
    }

    public function edit($id) {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id) {

        // Find the product
        $category = Category::find($id);

        // Validate The form
        $request->validate([
            'name' => 'required'
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

            $category->image = $request->image->getClientOriginalName();
        }

        // Updating the product
        $category->update([
            'name' => $request->name,
            'image' => $category->image
        ]);

        // Store a message in session
        $request->session()->flash('msg', 'Category has been updated');

        // Redirect
        return redirect('admin/category');

    }

    public function show($id) {
        $category = Category::find($id);
        return view('admin.category.details', compact('category'));
    }

    public function destroy($id) {
        // Delete the product
        Category::destroy($id);

        // Store a message
        session()->flash('msg','Category has been deleted');

        // Redirect back
        return redirect('admin/category');
    }
}
