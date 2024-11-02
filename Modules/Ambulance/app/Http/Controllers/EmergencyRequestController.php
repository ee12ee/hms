<?php

namespace Modules\Ambulance\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Ambulance\Events\EmergencyRequestCreated;
use Modules\Ambulance\Http\Requests\StoreEmergencyRequest;
use Modules\Ambulance\Models\EmergencyRequest;

class EmergencyRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//    public function index()
//    {
//       EmergencyRequest::all();
//    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmergencyRequest $request)
    {
        $emergencyRequest=EmergencyRequest::query()->create($request->validated());
        event(new EmergencyRequestCreated($emergencyRequest));
        return self::sendResponse(201, 'the emergency request is created successfully');


    }

    /**
     * Show the specified resource.
     */
//    public function show(EmergencyRequest $emergencyRequest)
//    {
//        return self::sendResponse(200,'the emergency request is',$emergencyRequest);
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     */
//    public function destroy(EmergencyRequest $emergencyRequest)
//    {
//        $emergencyRequest->delete();
//        return self::sendResponse(200,'the emergency request is deleted successfully');
//    }
}
