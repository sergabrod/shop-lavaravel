<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    //mensajes en español
    public static $messages = [
      'name.required' => 'Debe ingresar un nombre de categoría',
      'name.min' => 'El nombre de la categoría debe tener al menos 3 caracteres',
      'description.required' => 'Debe ingresar una descripción',
      'description.max' => 'La descripción no puede tener más de 200 caracteres',
    ];

    //reglas de Validación
    public static $rules = [
      'name' => 'required|min:3',
      'description' => 'required|max:200',
    ];
    
    protected $fillable = ['name', 'description'];

    //$category->products
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
