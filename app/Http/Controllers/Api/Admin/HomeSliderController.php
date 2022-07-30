<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HomeSliderRequest;
use App\Http\Resources\HomeResource;
use App\Http\Resources\HomeSliderResource;
use App\Models\HomeSlider;
use Illuminate\Http\Request;

class HomeSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return HomeSliderResource::collection(HomeSlider::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HomeSliderRequest $request)
    {
        return new HomeSliderResource(HomeSlider::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new HomeSliderResource(HomeSlider::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HomeSliderRequest $request, $id)
    {
        $homeSlider=HomeSlider::find($id);
        $homeSlider->update($request->all());
        return new HomeSliderResource($homeSlider);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $homeSlider=HomeSlider::find($id);
        $homeSlider->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'Deleted successfully!'
        ]);
    }
}
