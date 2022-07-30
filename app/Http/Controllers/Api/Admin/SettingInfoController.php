<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingInfoRequest;
use App\Http\Resources\SettingInfoResource;
use App\Models\SettingInfo;
use Illuminate\Http\Request;

class SettingInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SettingInfoResource::collection(SettingInfo::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingInfoRequest $request)
    {
        return new SettingInfoResource(SettingInfo::create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new SettingInfoResource(SettingInfo::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingInfoRequest $request, $id)
    {
        $sett=SettingInfo::find($id);
        $sett->update($request->validated());
        return new SettingInfoResource($sett);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sett=SettingInfo::find($id);
        $sett->delete();
        return response()->json([
            'status'=>'success',
            'message'=>'Deleted successfully!'
        ]);
    }
}
