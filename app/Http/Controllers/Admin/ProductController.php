<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        //mensajes en español
        $messages = [
          'name.required' => 'Debe ingresar un nombre de producto',
          'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
          'description.required' => 'Debe ingresar una descripción',
          'description.max' => 'La descripción no puede tener más de 200 caracteres',
          'price.required' => 'Debe ingresar un precio para el producto',
          'price.numeric' => 'El precio debe ser un valor numérico',
          'price.min' => 'El precio ingresado debe ser mayor o igual a 0',
        ];

        //reglas de Validación
        $rules = [
          'name' => 'required|min:3',
          'description' => 'required|max:200',
          'price' => 'required|numeric|min:0',
        ];
        //Validación del formulario
        $this->validate($request, $rules, $messages);
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
      //mensajes en español
      $messages = [
        'name.required' => 'Debe ingresar un nombre de producto',
        'name.min' => 'El nombre del producto debe tener al menos 3 caracteres',
        'description.required' => 'Debe ingresar una descripción',
        'description.max' => 'La descripción no puede tener más de 200 caracteres',
        'price.required' => 'Debe ingresar un precio para el producto',
        'price.numeric' => 'El precio debe ser un valor numérico',
        'price.min' => 'El precio ingresado debe ser mayor o igual a 0',
      ];

      //reglas de Validación
      $rules = [
        'name' => 'required|min:3',
        'description' => 'required|max:200',
        'price' => 'required|numeric|min:0',
      ];
      //Validación del formulario
      $this->validate($request, $rules, $messages);
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
