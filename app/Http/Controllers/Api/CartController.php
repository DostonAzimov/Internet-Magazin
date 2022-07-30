<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{

    public function add_to_cart(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $product = Product::find($id);
        $cart = new Cart();
        $cart->user_id = $user_id;
        $cart->product_id = $id;
        $cart->category_id = $product->category_id;
        $cart->quantity = $request->quantity;
        $cart->price = $request->quantity * $product->price;
        $cart->save();
        $code = 200;
        return response()->json([
            'status' => 'Success',
            'message' => 'Successfully save to cart!',
            'Cart' => $cart
        ], $code);
    }

    public function allCart()
    {
        $user_id = Auth::user()->id;
        $cart = Cart::where('user_id', $user_id)->get();
        $code = 200;
        return response()->json([
            'status' => 'Success',
            'message' => 'All your cart!',
            'All cart' => $cart
        ], $code);
    }

    public function deleteCart($id)
    {
        $user_id = Auth::user()->id;
        $cart = Cart::find($id);
        if ($cart->delete())
        {
            $code = 200;
            return response()->json([
                'status' => 'Success',
                'message' => "Delete the product from cart!",
                'Deleted cart' => $cart
            ], $code);
        }
    }


    public function deleteAll()
    {
        $user_id = Auth::user()->id;
        $cart=Cart::where('user_id',$user_id)->get();
        foreach ($cart as $item) {
            $item->delete();
        }
        $code = 200;
        return response()->json([
            'status' => 'Success',
            'message' => "Delete all product from cart!",
        ], $code);
    }






}
