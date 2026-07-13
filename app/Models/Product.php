<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=[
        'category_id',
        'name',
        'slug',
        'short_description',
        'description',
        'base_price',
        'thumbnail',
        'featured',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
