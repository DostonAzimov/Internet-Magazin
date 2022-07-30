<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DateSaleRequest;
use App\Http\Resources\DateSaleResource;
use App\Http\Resources\HomeResource;
use App\Models\DataSale;
use Illuminate\Http\Request;

class DateSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DateSaleResource::collection(DataSale::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DateSaleRequest $request)
    {
        return new DateSaleResource(DataSale::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new DateSaleResource(DataSale::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'sale_date'=>'required|date'
        ]);
        $dataSale=DataSale::find($id);
        $dataSale->update($request->all());
        return new DateSaleResource($dataSale);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $date_sale=DataSale::find($id);
        $date_sale->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'Deleted successfully!'
        ]);
    }
}
