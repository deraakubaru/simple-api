<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return response()->json(['Products' => $products]);
    }
    public function store(){
        
        $attributes = request()->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
        ]);

        $product = Product::create($attributes);

        return response()->json(['message' => 'Produk berhasil dibuat!']);
    }
    public function update($id){
        try{
            $attributes = request()->validate([
                'name' => 'required|string',
                'price' => 'required|numeric',
            ]);

            $product = Product::find($id);

            if(!$product){
                return response()->json(['message' => 'Produk tidak ditemukan!']);
            }else{
                $product->update($attributes);
            }
        }catch(Exception $e){
            return response()->json(['error' => 'Kesalahan!' . $e->getMessage()]);
        }
    }
    public function destroy($id){
        $product = Product::find($id);
        $product->delete();
        return response()->json(['message' => 'Produk telah dihapus!']);
    }
}
