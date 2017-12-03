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
}
