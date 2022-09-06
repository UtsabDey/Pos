<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Order extends Component
{
    public $orders, $products = [], $product_code, $message = '', $productIncart;
    public $pay_money = '', $balance = '';

    public function mount()
    {
        $this->products = Product::all();
        $this->productIncart = Cart::all();
    }

    public function InsertoCart()
    {
        $countProduct = Product::where('id', $this->product_code)->first();
        if (!$countProduct){
            return session()->flash('error', 'Product not found');
            // return $this->message = 'Product not found';
        }

        $countCartProduct = Cart::where('product_id', $this->product_code)->count();
        if ($countCartProduct > 0) {
            return session()->flash('warning', 'Product ' .$countProduct->product_name . ' is already exist in cart');
            // return $this->message = 'Product ' .$countProduct->product_name . ' is already exist in cart';
        }

        $addtoCart = new Cart();
        $addtoCart->user_id = Auth::user()->id;
        $addtoCart->product_id = $countProduct->id;
        // $addtoCart->product_qty = $countProduct->quantity;
        $addtoCart->product_qty = 1;
        $addtoCart->product_price = $countProduct->price;
        $addtoCart->save();

        $this->productIncart->prepend($addtoCart);

        $this->product_code = '';
        return session()->flash('success', 'Product added successfully');
        return $this->message = 'Product added successfully'; 
    }

    public function removeProduct($cartId)
    {
        Cart::find($cartId)->delete();

        if ($this->pay_money != '') {
            
        }
        return back()->with('success', 'Product removed successfully from Cart');
        // return session()->flash('success', 'Product removed successfully from Cart');
        // $this->message = 'Product removed successfully from Cart';

        $this->productIncart = $this->productIncart->except($cartId);
    }

    public function IncrementQty($cartId)
    {
        $carts = Cart::find($cartId);
        $carts->increment('product_qty', 1);
        $updatePrice = $carts->product_qty * $carts->product->price;
        $carts->update([
            'product_price' => $updatePrice
        ]);
        $this->mount();
    }

    public function DecrementQty($cartId)
    {
        $carts = Cart::find($cartId);
        if($carts->product_qty == 1){
            return session()->flash('info', 'Product ' . $carts->product->product_name . ' Quantity can not be less than 1, add quantity or remove product in cart.');
        }
        $carts->decrement('product_qty', 1);
        $updatePrice = $carts->product_qty * $carts->product->price;
        $carts->update([
            'product_price' => $updatePrice
        ]);
        $this->mount();
    }

    public function render()
    {
        if ($this->pay_money != '') {
            $totalAmount = $this->pay_money - $this->productIncart->sum('product_price');
            $this->balance = $totalAmount;
        }
        return view('livewire.order');
    }
}
