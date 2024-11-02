<?php

namespace Modules\Doctor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Doctor\Http\Requests\StoreDoctorRequest;
use Modules\Doctor\Http\Requests\UpdateDoctorRequest;
use Modules\Doctor\Models\Doctor;
use Modules\Doctor\Transformers\DoctorResource;


class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors= Doctor::all()->groupBy('status');
        $groupedDoctors = $doctors->map(function ($doctorGroup) {
            return DoctorResource::collection($doctorGroup);
        });
        return self::sendResponse(200,'the doctors are',$groupedDoctors);

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDoctorRequest $request)
    {
        Doctor::query()->create($request->validated());
        return self::sendResponse(201,'the doctor is created successfully');

    }

    /**
     * Show the specified resource.
     */
    public function show(Doctor $doctor)
    {
        $doc=$doctor->with('department')->firstOrFail();
        return self::sendResponse(200,'the doctor are',$doc);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        $doctor->update($request->validated());
        return self::sendResponse(200,'the doctor is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->deleteOrFail();
        return self::sendResponse(200,'the doctor is deleted successfully');
    }
}
