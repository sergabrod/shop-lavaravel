<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('admin.products.list')->with(compact('products')); //listado de productos
    }

    public function create()
    {
        return view('admin.products.create'); //formulario de alta de producto
    }

    public function store(Request $request)
    {
        //registra el nuevo producto en la BD
        //dd($request->all());
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->save(); //realiza el insert en la BD

        return redirect('/admin/products');
    }
}
