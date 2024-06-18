<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\cartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class cartController extends Controller
{
    public function add(Request $request) {
        try {
            $validatedData = $request->validate([
                'user_id' => 'required',
                'barang_model_id' => 'required',
                'quantity' => 'required',
            ]);
            
            $find = cart::where('user_id', $validatedData['user_id'])->first();
    
            if($find){
                $cartItem = CartItem::updateOrCreate(
                    ['cart_id' => $find->id, 'barang_model_id' => $validatedData['barang_model_id']],
                    ['quantity' => DB::raw('quantity + ' . $validatedData['quantity'])]
                ); 
    
                return response()->json(['success' => 'Barang ditambahkan ke keranjang']);
            }
    
            $cart = cart::create([
                'user_id' => $validatedData['user_id'],]);
            
            $cartItem = CartItem::updateOrCreate(
                ['cart_id' => $cart->id, 'barang_model_id' => $validatedData['barang_model_id']],
                ['quantity' => DB::raw('quantity + ' . $validatedData['quantity'])]
            ); 
    
            return response()->json(['success' => 'Barang ditambahkan ke keranjang']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
        
    }
    public function index(){

        $cartItems = DB::table('cart as c')
        ->join('cartitem as ci', 'ci.cart_id', '=', 'c.id')
        ->join('barang as bm', 'bm.id', '=', 'ci.barang_model_id')
        ->where('c.user_id', Auth::user()->id)
        ->get();

        return view('keranjang', compact('cartItems'));
    }

}
