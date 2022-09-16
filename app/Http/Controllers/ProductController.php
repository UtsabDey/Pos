<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Picqer;

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

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'product_name' => 'required|unique:products,product_name',
            'product_code' => 'required|unique:products,product_code',
            'brand' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        // $product_code = rand(106890122, 10000000);
        // $redColor = '255, 0, 0';
        // $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        // $barcodes = $generator->getBarcode($product_code, $generator::TYPE_STANDARD_2_5, 2, 60);

        $product_code = $request->product_code;

        $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
        file_put_contents('image/products/barcodes/' . $product_code . '.jpg', 
        $generator->getBarcode($product_code, $generator::TYPE_CODE_128, 3, 50));

        $product = new Product();
        $product->product_name = $request->product_name;
        $product->brand = $request->brand;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->product_code = $product_code;
        $product->barcode = $product_code . '.jpg';

        if($request->hasFile('product_image')){
            $file = $request->file('product_image');
            $file->move(public_path(). '/image/products', $file->getClientOriginalName());
            $product_image = $file->getClientOriginalName();
            $product->product_image = $product_image;
        }

        $product->alert_stock = $request->alert_stock;
        $product->description = $request->description;
        $product->save();
        if ($product) {
            return redirect()->route('products.index')->with('success', 'Product Added Successfully!');
        }
        return redirect()->route('products.index')->with('error', 'Failed to Add Product!');
    }

    public function show(Product $product)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'product_name' => 'required|unique:products,product_name,' . $id,
            'product_code' => 'required|unique:products,product_code,' . $id,
            // 'product_name' => 'required', Rule::unique('products','product_name')->ignore($id),
            'brand' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        $product_code = $request->product_code;

        $product = Product::find($id);

        if ($request->product_code != '' && $request->product_code != $product->product_code) {
            if ($product->barcode != '') {
                $barcode_path = public_path() . '/image/products/barcodes/' . $product->barcode;
                unlink($barcode_path);
            }
            $generator = new Picqer\Barcode\BarcodeGeneratorJPG();
            file_put_contents('image/products/barcodes/' . $product_code . '.jpg', 
            $generator->getBarcode($product_code, $generator::TYPE_CODE_128, 3, 50));

            $product->barcode = $product_code . '.jpg';
        }

        $product->product_name = $request->product_name;
        $product->brand = $request->brand;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->product_code = $product_code;
        $product->alert_stock = $request->alert_stock;
        $product->description = $request->description;

        if($request->hasFile('product_image')){
            if ($product->product_image != '') {
                $proImage_path = public_path() . '/image/products/' . $product->product_image;
                unlink($proImage_path);
            }

            $file = $request->file('product_image');
            $file->move(public_path(). '/image/products', $file->getClientOriginalName());
            $product_image = $file->getClientOriginalName();
            $product->product_image = $product_image;
        }

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

    public function GetProductBarcode()
    {
        $data['productsBarcode'] = Product::select('barcode', 'product_code')->get();
        return view('products.barcode.index', $data);
    }
}
