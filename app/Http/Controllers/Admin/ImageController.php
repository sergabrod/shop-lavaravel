<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\ProductImage;
use File;

class ImageController extends Controller
{
    public function index($id)
    {
        $product = Product::find($id);
        $images = $product->images()->orderBy('featured', 'desc')->get()  ;
        return view('admin.products.images.list')->with(compact('product', 'images'));
    }

    public function store(Request $request, $id)
    {
            //subimos la imágen seleccionada al servidor
            $file = $request->file('photo');
            $path = public_path() .  '/images/products';
            $fileName = uniqid() . $file->getClientOriginalName();
            $moved = $file->move($path, $fileName);

            //crear un registro en la tabla product_images
            if ($moved) {
              $productImage = new ProductImage();
              $productImage->image = $fileName;
              //$productImage->featured = false;
              $productImage->product_id = $id;
              $productImage->save(); //INSERT
            }

            return back();
    }

    public function destroy(Request $request, $id)
    {
          //Eliminamos el archivo
          $productImage = ProductImage::find($request->input('image_id'));

          if (substr($productImage->image, 0, 4) == 'http') {
              $deleted = true;
          } else {
              $fullPath = public_path() .  '/images/products/' . $productImage->image;
              $deleted = File::delete($fullPath);
          }
          //Eliminamos el registro en la BD
          if ($deleted) {
             $productImage->delete();
          }

          return back();

    }

    public function selectFeatured($id, $image_id)
    {
          //Primero quitamos el atributo featured que tengan las imágenes
          //para ese producto
          ProductImage::where('product_id', $id)->update([
            'featured' => false
          ]);
          //Luego destaco la imágen en cuestión
          $productImage = ProductImage::find($image_id);
          $productImage->featured = true;
          $productImage->save();

          return back();
    }
}
