<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{


    public function addWishList(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $product = Product::find($id);
        $wishList = new WishList();
        $wishList->user_id = $user_id;
        $wishList->product_id = $id;
        $wishList->category_id = $product->category_id;
        $wishList->save();
        $code = 200;
        return response()->json([
            'status' => 'Success',
            'message' => 'Successfully save to wishList!',
            'wishList' => $wishList
        ], $code);
    }

    public function allWishList()
    {
        $user_id = Auth::user()->id;
        $wishList = WishList::where('user_id', $user_id)->get();
        $code = 200;
        return response()->json([
            'status' => 'Success',
            'message' => 'All your cart!',
            'All cart' => $wishList
        ], $code);
    }

    public function deleteWishList($id)
    {
        $wishList=WishList::find($id);
        if ($wishList->delete())
        {
            $code = 200;
            return response()->json([
                'status' => 'Success',
                'message' => "Delete the product from wishList!",
                'Deleted wishList' => $wishList
            ], $code);
        }
    }

    public function deleteAllWishList()
    {
        $user_id = Auth::user()->id;
        $wishList=WishList::where('user_id',$user_id)->get();
        foreach ($wishList as $item) {
            $item->delete();
        }
        $code = 200;
        return response()->json([
            'status' => 'Success',
            'message' => "Delete All product from wishList!"
        ], $code);
    }
}
