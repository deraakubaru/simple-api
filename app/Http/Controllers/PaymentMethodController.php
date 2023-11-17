<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethod;

class PaymentMethodController extends Controller
{
    public function index(){
        $paymenMethod = PaymentMethod::all();
        return response()->json(['Payment Method' => $paymenMethod]);
    }
    public function store(){
        
        $attributes = request()->validate([
            'name' => 'required|string',
        ]);

        $paymenMethod = PaymentMethod::create($attributes);

        return response()->json(['message' => 'Payment Method berhasil dibuat!']);
    }
    public function update($id){
        try{
            $attributes = request()->validate([
                'name' => 'required|string',
                'is_active' => 'required',
            ]);

            $paymenMethod = PaymentMethod::find($id);

            if(!$paymenMethod){
                return response()->json(['message' => 'Payment Method tidak ditemukan!']);
            }else{
                $paymenMethod->update($attributes);
            }
        }catch(Exception $e){
            return response()->json(['error' => 'Kesalahan!' . $e->getMessage()]);
        }
    }
    public function destroy($id){
        $paymenMethod = PaymentMethod::find($id);
        $paymenMethod->delete();
        return response()->json(['message' => 'Payment Method telah dihapus!']);
    }
}
