<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OrderResource::collection(Order::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'phoneNumber' => 'required|numeric',
            'town' => 'required',
            'region' => 'required',
            'address' => 'required',
            'paymentMode' => 'required'
        ]);
        $user_id = Auth::user()->id;
        $cartTotal = Cart::where('user_id', $user_id)->sum('price');
        $order = new Order();
        $order->user_id = $user_id;
        $order->total = $cartTotal;
        $order->firstName = $request->firstName;
        $order->lastName = $request->lastName;
        $order->email = $request->email;
        $order->phoneNumber = $request->phoneNumber;
        $order->town = $request->town;
        $order->region = $request->region;
        $order->address = $request->address;
        $order->status = 'ordered';
        $order->save();

        $cart=Cart::where('user_id',$user_id)->get();

        foreach ($cart as $item) {
            $orderItem=new OrderItem();
            $orderItem->product_id=$item->product_id;
            $orderItem->order_id=$order->id;
            $orderItem->price=$item->price;
            $orderItem->quantity=$item->quantity;
            $orderItem->save();
        }

        if ($request->paymentMode=='payme'||'click'||'apelsin')
        {
            $transaction=new Transaction();
            $transaction->user_id=Auth::user()->id;
            $transaction->order_id=$order->id;
            $transaction->mode=$request->paymentMode;
            $transaction->status='pending';
            $transaction->save();
        }
        Cart::where('user_id',$user_id)->delete();
        return new OrderResource($order);


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new OrderResource(Order::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
