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

    public function getFeaturedImageAttribute()
    {
        //Si la categoría tiene imágen, devuelve la misma
        //en otro caso devuelve la imágen del primer producto
        //de esa categoría que encuentre
        if($this->image)
            return '/images/categories/' . $this->image;
        //Obtengo el primer producto de esta categoría
        //y extraigo su imágen del campo calculado, si no tiene producto
        //devuelvo la imágen por defecto
        $firstProduct = $this->products()->first();
        if ($firstProduct) {
            return $firstProduct->featured_image;
        } else {
            return '/images/default-image.jpg';
        }
    }
}
