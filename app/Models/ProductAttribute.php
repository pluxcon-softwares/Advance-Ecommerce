<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [ 'product_id', 'size' , 'price', 'stock' , 'sku', 'status' ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
