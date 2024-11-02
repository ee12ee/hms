<?php

namespace Modules\Doctor\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Modules\Department\Models\Department;
use Modules\Doctor\Http\Requests\StoreShiftRequest;
use Modules\Doctor\Http\Requests\UpdateShiftRequest;
use Modules\Doctor\Models\Doctor;
use Modules\Doctor\Models\Shift;
use Modules\Doctor\Transformers\ShiftResource;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($month)
    {
       $shifts=Shift::query()->whereMonth('date',$month)->with('doctors')->get();
       return self::sendResponse(200,'the shifts are',ShiftResource::collection($shifts));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreShiftRequest  $request)
    {
        DB::transaction(function () use ($request) {
            $activeDoctorIds = Doctor::query()->active()->whereIn('id', $request->doctor_ids)->pluck('id');
            if ($activeDoctorIds->isEmpty()) {
                throw ValidationException::withMessages(['doctor_ids' => 'No active doctors available to attach to the shift.']);
            }
            $shift=Shift::query()->create($request->safe()->except('doctor_ids'));
            $shift->doctors()->attach($activeDoctorIds);
        });
        return self::sendResponse(201,'the shift is created successfully');
    }

    /**
     * Show the specified resource.
     */
    public function show( Shift $shift)
    {
        $shift->with('doctors')->get();
        return self::sendResponse(200,'the shift is',new ShiftResource($shift));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateShiftRequest $request,Shift $shift)
    {
        DB::transaction(function () use ($shift,$request) {
            $activeDoctorIds = Doctor::query()->active()->whereIn('id', $request->doctor_ids)->pluck('id');
            if ($activeDoctorIds->isEmpty()) {
                throw ValidationException::withMessages(['doctor_ids' => 'No active doctors available to attach to the shift.']);
            }
            $shift->doctors()->sync($activeDoctorIds);
            $shift->update($request->safe()->except('doctor_ids'));

        });
        return self::sendResponse(200, 'The shift is updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shift $shift)
    {
        DB::transaction(function () use ($shift) {
            $shift->doctors()->detach();
            $shift->deleteOrFail();
        });
        return self::sendResponse(200, 'The shift is deleted successfully');
    }
    public function destroyShiftsOfYear($year)
    {
        DB::transaction(function () use ($year) {
          $shifts=Shift::query()->whereYear('date',$year)->get();
          foreach ($shifts as $shift){
              $shift->doctors->detach();
          }
          Shift::query()->whereYear('date', $year)->delete();
        });
        return self::sendResponse(200, 'The shift is deleted successfully');
    }

}
