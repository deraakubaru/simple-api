<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::all();
        return response()->json(['customers' => $customers]);
    }
    public function store(){
        
        $attributes = request()->validate([
            'customer_name' => 'required|string',
        ]);

        $customer = Customer::create($attributes);

        return response()->json(['message' => 'Customer berhasil dibuat!']);
    }
    public function addAddress(){
        $attributes = request()->validate([
            'customer_id' => 'required',
            'address' => 'required',
        ]);
        $customerAddress - CustomerAddress::create($attributes);

        return response()->json(['message' => 'Alamat telah ditambahkan']);
    }
    public function updateAddress($id){

        $attributes = request()->validate([
            'address' => 'required',
        ]);
        $customerAddress - CustomerAddress::find($id);

        if(!$customerAddress){
            return response()->json(['message' => 'Alamat customer tidak ditemukan!']);
        }else{
            $customerAddress->update($attributes);
        }
        return response()->json(['message' => 'Alamat telah diubah']);
    }
    public function update($id){
        try{
            $attributes = request()->validate([
                'customer_name' => 'required|string',
            ]);

            $customer = Customer::find($id);

            if(!$customer){
                return response()->json(['message' => 'Customer tidak ditemukan!']);
            }else{
                $customer->update($attributes);
            }
        }catch(Exception $e){
            return response()->json(['error' => 'Kesalahan!' . $e->getMessage()]);
        }
    }
    public function destroy($id){
        $customer = Customer::find($id);
        $customer->delete();
        return response()->json(['message' => 'Kategori telah dihapus!']);
    }
}
