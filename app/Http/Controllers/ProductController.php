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

    public function store()
    {
        //registra el nuevo producto en la BD
    }
}
