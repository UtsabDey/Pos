<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{
    public $products_details = [];

    public function mount()
    {
        // $this->products_details = Product::all();
    }

    Public function ProductDetails($product_id)
    {
        $this->products_details = Product::where('id', $product_id)->get();
        // dd($count); 
    }

    Public function productPreview($product_id)
    {
        $image = $this->products_details = Product::where('id', $product_id)->select('product_image')->get();
        dd($image);
    }

    public function render()
    {
        $data['products'] = Product::all();
        return view('livewire.products', $data)->with('no', 1);
    }
}
