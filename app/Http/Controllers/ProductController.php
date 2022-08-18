<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['products'] = Product::all();
        return view('products.index', $data)->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'product_name' => 'required|unique:products,product_name',
            'brand' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->brand = $request->brand;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->alert_stock = $request->alert_stock;
        $product->description = $request->description;
        $product->save();
        if ($product) {
            return redirect()->route('products.index')->with('success', 'Product Added Successfully!');
        }
        return redirect()->route('products.index')->with('error', 'Failed to Add Product!');
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'product_name' => 'required|unique:products,product_name,' .$id,
            // 'product_name' => 'required', Rule::unique('products','product_name')->ignore($id),
            'brand' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        $product = Product::find($id);
        $product->product_name = $request->product_name;
        $product->brand = $request->brand;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->alert_stock = $request->alert_stock;
        $product->description = $request->description;

        
        if ($product->isDirty()) {
            $product->update();
            return redirect()->route('products.index')->with('success', 'Product Updated Successfully!');
        }
        return redirect()->route('products.index')->with('error', 'Nothing Changed!');
    }

    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->back()->with('warning', 'Post Deleted Successfully');
    }
}
