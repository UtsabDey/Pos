<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable  = [
        'product_name', 'brand', 'quantity', 'price', 
    ];

    public function orderdetail()
    {
        return $this->hasMany('App\Models\Order_Detail');
    }

    public function cart()
    {
        return $this->hasMany('App\Models\Cart');
    }
}
