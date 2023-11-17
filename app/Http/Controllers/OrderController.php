<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;
use App\Models\PaymentMethod;
use App\Models\Product;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::all();
        return response()->json(['Orders' => $orders]);
    }
    public function store(){
        
        $attributes = request()->validate([
            'customer_id' => 'required',
            'product_id' => 'required',
            'payment_method_id' => 'required',
            'quantity' => 'required|integer',
        ]);

        $order = Order::create($attributes);

        return response()->json(['message' => 'Transaksi berhasil dibuat!']);
    }
    public function update($id){
        
    }
    public function destroy($id){
        $order = Order::find($id);
        $order->delete();
        return response()->json(['message' => 'Transaksi telah dihapus!']);
    }

}
