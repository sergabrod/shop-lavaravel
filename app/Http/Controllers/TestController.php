<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function welcome()
    {
        //otengo sólo las categorias que tienen Productos
        //para eso uso el método has() de Laravel
        $categories = Category::has('products')->get();
        return view('welcome')->with(compact('categories'));
    }
}
