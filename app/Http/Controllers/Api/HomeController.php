<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomeResource;
use App\Models\Cart;
use App\Models\Category;
use App\Models\DataSale;
use App\Models\HomeSlider;
use App\Models\Product;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


    public function products()
    {
        return HomeResource::collection(Product::all());
    }

    public function OnSale()
    {
        $product = Product::where('sale_price', '>', 0)->inRandomOrder()->get()->take(12);
        return new HomeResource($product);
    }

    public function latestProduct()
    {
        $product = Product::orderBy('created_at', 'DESC')->get()->take(10);
        return new HomeResource($product);
    }

    public function categories()
    {
        $categories = Category::all();
        $code = 200;
        return response()->json([
            'status' => 'Success',
            'message' => 'Categories',
            'SaleProduct' => $categories
        ], $code);
    }

    public function search(Request $request)
    {
        $search = '%' . $request->name . '%';
        $product = Product::where('name', 'LIKE', $search)->get();
        return new HomeResource($product);
    }

    public function showProduct($id)
    {
        return new HomeResource(Product::find($id));
    }

    public function relatedProduct($id)
    {
        $product=Product::find($id);
        $products=Product::where('category_id',$product->category_id)->inRandomOrder()->limit(7)->get();
        return new HomeResource($products);
    }

    public function popularProduct()
    {
        $products=Product::inRandomOrder()->limit(7)->get();
        return new HomeResource($products);
    }

    public function mostViewedProduct()
    {
        $products=Product::inRandomOrder()->limit(9)->get();
        return new HomeResource($products);
    }

    public function productCategory($id)
    {
        $product=Product::where('category_id',$id)->inRandomOrder()->limit(9)->get();
        return new HomeResource($product);
    }

    public function homeSlider()
    {
        return HomeResource::collection(HomeSlider::all());
    }







}
