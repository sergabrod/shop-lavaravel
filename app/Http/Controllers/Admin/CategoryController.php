<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;

class CategoryController extends Controller
{
  public function index()
  {
      $categories = Category::OrderBy('name')->paginate(10);
      return view('admin.categories.list')->with(compact('categories')); //listado de productos
  }

  public function create()
  {
      return view('admin.categories.create'); //formulario de alta de producto
  }

  public function store(Request $request)
  {
      //Validación del formulario
      $this->validate($request, Category::$rules, Category::$messages);
      //registra el nuevo producto en la BD
      //dd($request->all());
      Category::create($request->all()); //asignacción masiva
      //$category = new Category();
      //$category->name = $request->input('name');
      //$category->description = $request->input('description');
      //$category->save(); //realiza el insert en la BD

      return redirect('/admin/categories');
  }

 //podemos transformar directamente el id en una categoria
  public function edit(Category $category)
  {
      return view('admin.categories.edit')->with(compact('category')); //formulario de edición de producto
  }

  public function update(Request $request, Category $category)
  {

      //Validación del formulario
      $this->validate($request, Category::$rules, Category::$messages);
      //registra la nueva categoría en la BD
      //dd($request->all());

      //$category = Category::find($id);
      //$category->name = $request->input('name');
      //$category->description = $request->input('description');
      //$category->save(); //realiza el insert en la BD
      $category->update($request->all());

      return redirect('/admin/categories');
  }

  public function destroy(Category $category)
  {
      //Guardo null en todos los productos asociados a la categoría a eliminar
      Product::where('category_id', $category->id)->update(['category_id' => null]);
      $category->delete();
      return back();
  }
}
