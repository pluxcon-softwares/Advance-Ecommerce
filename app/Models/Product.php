<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['section_id', 'category_id', 'product_name', 'product_code',
    'product_price', 'product_discount', 'product_weight', 'product_video', 'product_main_image',
    'product_description', 'meta_title', 'meta_description', 'meta_keywords', 'is_featured', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
}
