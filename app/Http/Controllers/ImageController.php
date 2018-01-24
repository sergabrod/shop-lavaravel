<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;

class ImageController extends Controller
{
    public function index($id)
    {
        $product = Product::find($id);
        $images = $product->images;
        return view('admin.products.images.list')->with(compact('product', 'images'));
    }

    public function store(Request $request, $id)
    {
        //subimos la imágen seleccionada al servidor
        $file = $request->file('photo');
        $path = public_path() .  '/images/products';
        $fileName = uniqid() . $file->getClientOriginalName();
        $file->move($path, $fileName);

        //crear un registro en la tabla product_images
        $productImage = new ProductImage();
        $productImage->image = $fileName;
        //$productImage->featured = false;
        $productImage->product_id = $id;
        $productImage->save(); //INSERT
        
        return back();
    }

    public function destroy()
    {

    }
}
