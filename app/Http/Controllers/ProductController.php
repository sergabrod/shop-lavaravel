<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function show($id)
   {
        $product = Product::find($id);
        //return view('show')->with(compact('product')); // Muestro detalle del producto
        return "Mostrando datos del producto $id";
   }
}
