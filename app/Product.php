<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        //$product->category
        return $this->belongsTo(Category::class);
    }

    //product->images
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    //featured_image
    public function getFeaturedImageAttribute()
    {
        //Si el producto tiene una imágen destacada, obtengo la primera de ellas
        $featuredImage = $this->images()->where('featured', true)->first();
        //Si el producto no tiene imágenes destacadas, obtengo la primera
        if (!$featuredImage) {
            $featuredImage = $this->images()->first();
        }
        //Si encontramos al menos una imágen, devolvemos el campo calculado url
        if ($featuredImage) {
          return $featuredImage->url;
        }
        //caso contrario devolvemos la imágen por defecto de Productos
        return '/images/products/default-image.jpg';
    }
}
