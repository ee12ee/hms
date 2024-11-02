<?php

namespace Modules\Ambulance\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Ambulance\Http\Requests\IsAvialableAmbulanceRequest;
use Modules\Ambulance\Http\Requests\StoreAmbulanceRequest;
use Modules\Ambulance\Http\Requests\UpdateAmbulanceRequest;
use Modules\Ambulance\Models\Ambulance;

class AmbulanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $ambulances=Ambulance::all();
       return self::sendResponse(200,'the ambulances are',$ambulances);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAmbulanceRequest $request)
    {
        Ambulance::query()->create($request->validated());
        return self::sendResponse(201,'the ambulance is created successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show(Ambulance $ambulance)
    {
        return self::sendResponse(200,'the ambulance is',$ambulance);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAmbulanceRequest $request,Ambulance $ambulance)
    {
        $ambulance->update($request->validated());
        return self::sendResponse(200,'the ambulance is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ambulance $ambulance)
    {
        $ambulance->deleteOrFail();
        return self::sendResponse(200,'the ambulance is deleted successfully');
    }
    public  function isAvailable(IsAvialableAmbulanceRequest $request ,Ambulance $ambulance)
    {
        $ambulance->update($request->validated());
        return self::sendResponse(200,'the ambulance available is changed successfully');
    }
}
