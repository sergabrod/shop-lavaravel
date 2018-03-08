<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;
use File;

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
      $category = Category::create($request->only('name', 'description'));

      if ($request->hasFile('image')){
        //subimos la imágen seleccionada al servidor
        $file = $request->file('image');
        $path = public_path() .  '/images/categories';
        $fileName = uniqid() . '-' . $file->getClientOriginalName();
        $moved = $file->move($path, $fileName);

        //Agregamos la imágen en la categoría creada
        if ($moved) {
          $category->image = $fileName;
          $category->save(); //update
        }
      }

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
      //$category->update($request->all());
      $category->update($request->only('name', 'description'));
      if ($request->hasFile('image')){
          //subimos la imágen seleccionada al servidor
          $file = $request->file('image');
          $path = public_path() .  '/images/categories';
          $fileName = uniqid() . '-' . $file->getClientOriginalName();
          $moved = $file->move($path, $fileName);

          //Agregamos la imágen en la categoría creada
          if ($moved) {
              $previousImage = $category->image;
              $category->image = $fileName;
              $saved = $category->save(); //update
              //Eliminamos la imágen anterior
              if ($saved && $previousImage)
                  File::delete($path . '/' . $previousImage);
          }
      }
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
