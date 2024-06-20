<?php

namespace App\Http\Controllers;

use App\Models\barangModel;
use App\Models\cart;
use App\Models\cartItem;
use App\Models\transaction;
use App\Models\transactionHistory;
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
    public function checkout(Request $request)
    {
        $cart = Cart::where('user_id', Auth::user()->id)->first();
        if (!$cart) {
            return response()->json(['error' => 'Cart not found'], 404);
        }

        DB::transaction(function () use ($cart) {
            foreach ($cart->cartItems as $cartItem) {
                $item = barangModel::find($cartItem->barang_model_id);

                if ($item->stok < $cartItem->quantity) {
                    throw new \Exception('Item not available or insufficient quantity');
                }
                $transaction = transaction::create([
                    'user_id' => $cart->user_id,
                    'barang_model_id' => $cartItem->barang_model_id,
                    'quantity' => $cartItem->quantity,
                ]);

                $item->stok -= $cartItem->quantity;
                $item->save();

                transactionHistory::create([
                    'transaction_id' => $transaction->id,
                    'action' => 'create',
                ]);
            }

            CartItem::where('cart_id', $cart->id)->delete();
            $cart->delete();
        });

        return response()->json(['message' => 'Checkout successful'], 201);
    }
    public function index(){

        $cartItems = DB::table('cart as c')
        ->join('cartItem as ci', 'ci.cart_id', '=', 'c.id')
        ->join('barang as bm', 'bm.id', '=', 'ci.barang_model_id')
        ->where('c.user_id', Auth::user()->id)
        ->get();

        return view('keranjang', compact('cartItems'));
    }
    public function delete(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'user_id' => 'required',
                'barang_model_id' => 'required',
            ]);

            $cart = Cart::where('user_id',intval($validatedData['user_id']))->first();

            if (!$cart) {
                return response()->json(['error' => 'Cart not found'], 404);
            }

            $cartItem = CartItem::where('cart_id', $cart->id)
                                ->where('barang_model_id', $validatedData['barang_model_id'])
                                ->first();

            if (!$cartItem) {
                return response()->json(['error' => 'Item not found in cart'], 404);
            }

            $cartItem->delete();

            return response()->json(['success' => 'Item removed from cart']);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
    public function viewHistory(){
        $data = DB::table('transaction_history as th')
        ->join('transaction as thx', 'th.transaction_id', '=', 'thx.id')
        ->join('barang as b', 'b.id', '=', 'thx.barang_model_id')
        ->join('users as u', 'u.id', '=', 'thx.user_id')
        ->orderBy('thx.created_at', 'desc')
        ->get();

        return view('history', compact('data'));
    }
}
