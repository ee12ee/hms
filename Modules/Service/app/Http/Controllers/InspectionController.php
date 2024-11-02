<?php

namespace Modules\Service\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Register\Models\Admission;
use Modules\Service\Http\Requests\StoreInspectionRequest;
use Modules\Service\Http\Requests\UpdateInspectionRequest;
use Modules\Service\Models\Inspection;

class InspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groupedByAdmissionName = Inspection::with('admission')->get()->groupBy(function($inspection) {
            return $inspection->admission->name;
        });
        return self::sendResponse(200,'the inspections are',$groupedByAdmissionName);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInspectionRequest $request)
    {
        Admission::query()->create($request->validated());
        return self::sendResponse(201,'the inspection is created successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show(Inspection $inspection)
    {
        return self::sendResponse(200,'the inspection is',$inspection);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInspectionRequest $request, Inspection $inspection)
    {
        $inspection->update($request->validated());
        return self::sendResponse(200,'the inspection is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inspection $inspection)
    {
        $inspection->deleteOrFail();
        return self::sendResponse(200,'the inspection is deleted successfully');
    }
}
