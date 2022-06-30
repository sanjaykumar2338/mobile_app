<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function products() {
        $products = Product::all();
        return response()->json([
            'status' => true,
            'message' => 'Product List(s)',
            'data' => $products,
            'image_url' => \URL::asset('uploads')
        ], 200);
    }

    public function category() {
        $category = Category::all();
        return response()->json([
            'status' => true,
            'message' => 'Category List(s)',
            'data' => $category,
            'image_url' => \URL::asset('uploads')
        ], 200);
    }
}