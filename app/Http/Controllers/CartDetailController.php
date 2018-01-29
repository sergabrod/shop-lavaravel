<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CartDetail;

class CartDetailController extends Controller
{
    public function store(Request $request)
    {
      $cartDetail = new CartDetail();
      $cartDetail->cart_id = auth()->user()->cart->id;
      $cartDetail->product_id = $request->product_id;
      $cartDetail->quantity =$request->quantity;
      $cartDetail->save();

      $notification = "El producto fue agregado al carrito";
      return back()->with(compact('notification'));
    }

    public function destroy(Request $request)
    {
        $cartDetail = CartDetail::find($request->cart_detail_id);

        //Sólo elminar si el id pertenece a un carrito del usuario activo
        if ($cartDetail->cart_id == auth()->user()->cart->id)
            $cartDetail->delete(); //borra el producto en la BD

         //vuelve hacia atrás porque el usuario ya está ubicado
         // en el dashboard del carrito
         $notification = "El producto fue quitado del carrito";
         return back()->with(compact('notification'));
    }
}
