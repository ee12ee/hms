<?php

namespace Modules\Department\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Department\Http\Requests\StoreClinicRequest;
use Modules\Department\Http\Requests\UpdateClinicRequest;
use Modules\Department\Models\Clinic;

class ClinicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clinics=Clinic::all();
        return $this->sendResponse(200,'the clinics are',$clinics);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClinicRequest $request)
    {
        Clinic::query()->create($request->validated());
        return $this->sendResponse(201,'the clinic is created successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show(Clinic $clinic)
    {
        return $this->sendResponse(200,'the clinic is',$clinic);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClinicRequest $request,Clinic $clinic)
    {
        $clinic->update($request->validated());
        return $this->sendResponse(200,'the clinic is update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Clinic $clinic)
    {
        $clinic->deleteOrFail();
        return $this->sendResponse(200,'the clinic is deleted successfully');
    }
}
