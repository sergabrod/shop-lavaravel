<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ImageController extends Controller
{
    public function index($id)
    {
        $product = Product::find($id);
        $images = $product->images;
        return view('admin.products.images.list')->with(compact('product', 'images'));
    }

    public function store()
    {

    }

    public function destroy()
    {

    }
}
