<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data['products'] = Product::all();
        $data['orders'] = Order::all();
        $lastID = Order_Detail::max('order_id');
        $data['order_receipt'] = Order_Detail::where('order_id', $lastID)->get();
        return view('orders.index', $data);
    }

    public function store(Request $request)
    {
        // return $request->all();
        $validate = Validator::make($request->all(), [
            'product_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'discount' => 'nullable',
            'total_amount' => 'required',
            'customer_name' => 'required',
            'phone' => 'required',
            'paid_amount' => 'required',
            'balance' => 'required',
        ]);

        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput();
        }

        DB::transaction(function () use ($request) {
            // Order Modal
            $orders = new Order();
            $orders->name = $request->customer_name;
            $orders->phone = $request->phone;
            $orders->save();
            $order_id = $orders->id;

            // Order Details Model
            for ($product_id = 0; $product_id < count($request->product_id); $product_id++) {
                $order_details = new Order_Detail();
                $order_details->order_id = $order_id;
                $order_details->product_id = $request->product_id[$product_id];
                $order_details->unitprice = $request->price[$product_id];
                $order_details->quantity = $request->quantity[$product_id];
                $order_details->discount = $request->discount[$product_id];
                $order_details->amount = $request->total_amount[$product_id];
                $order_details->save();
            }

            //Transaction Model
            $transaction = new Transaction();
            $transaction->order_id = $order_id;
            $transaction->user_id = Auth::user()->id;
            $transaction->paid_amount = $request->paid_amount;
            $transaction->balance = $request->balance;
            $transaction->payment_method = $request->payment_method;
            for ($product_id = 0; $product_id < count($request->product_id); $product_id++) {
                $transaction->transac_amount += $request->total_amount[$product_id];
            }
            $transaction->transac_date = date('Y-m-d');
            $transaction->save();

            Cart::where('user_id', Auth::user()->id)->delete();

            // Last order History
            $data['products'] = Product::all();
            $data['order_details'] = Order_Detail::where('order_id', $order_id)->get();
            $data['orderedBy'] = Order::where('id', $order_id)->get();

            return view('orders.index',$data)->with('success', 'Order Placed Successfully');
        });

        return back()->with('success', 'Order Placed Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
