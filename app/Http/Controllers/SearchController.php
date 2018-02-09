<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class SearchController extends Controller
{
    public function show(Request $request)
    {
         $query = $request->input('query');
         $products = Product::where('name', 'like', "%$query%")->paginate(5);
         //Si sólo encuenra un producto, lo redirecciono a la página de else
         //producto encontrado
         if ($products->count() == 1) {
             $id = $products->first()->id;
             return redirect("products/$id/show");
         }
         return view('search.show')->with(compact('products', 'query'));
    }

    public function data()
    {
        $products = Product::pluck('name');
        return $products;
    }
}
