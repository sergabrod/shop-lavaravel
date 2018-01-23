<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;

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
        //reglas de Validación
        $rules = [
          'name' => 'required|mi:3',
          'description' => 'required|max:200',
          'price' => 'required|numeric|min:0',
        ];
        //Validación del formulario
        $this->validate($request, $rules);
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

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.products.edit')->with(compact('product')); //formulario de edición de producto
    }

    public function update(Request $request, $id)
    {
        //registra el nuevo producto en la BD
        //dd($request->all());
        $product = Product::find($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->long_description = $request->input('long_description');
        $product->save(); //realiza el insert en la BD

        return redirect('/admin/products');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        //borro la imagen asociada antes para evitar error de FK
        ProductImage::where('product_id', $product->id)->delete();
        $product->delete(); //borra el producto en la BD

         //vuelve hacia atrás porque el usuario ya está ubicado
         // en el listado de productos
        return back();
    }
}
