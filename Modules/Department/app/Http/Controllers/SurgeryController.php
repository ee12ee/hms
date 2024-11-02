<?php

namespace Modules\Department\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Department\Http\Requests\StoreSurgeryRequest;
use Modules\Department\Http\Requests\UpdateSurgeryRequest;
use Modules\Department\Models\Surgery;
use Modules\Register\Models\Admission;
use Throwable;

class SurgeryController extends Controller
{

    public function index()
    {
        $Surgeries = Surgery::paginate(100);
        return $this->sendResponse(200, 'all Surgeries', $Surgeries);
    }

    public function store(StoreSurgeryRequest $request)
    {
        return $request;
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            if ($request->only('patient_id')) {
                $admission_id = Admission::where('patient_id', $request->only('patient_id'))->where('discharge_date', null)->get()->last();
            }
            $data = Arr::except($validated, 'patient_id');
            $data['admission_id'] = $admission_id->id;
            $Surgery = Surgery::create($data);
            if ($request->has('surgery_doctor')) {
                $surgery_doctor = $request->safe()->only('surgery_doctor')['surgery_doctor'];
                $Surgery->doctors()->attach($surgery_doctor);
            }
            DB::commit();
            return $this->sendResponse(201, 'Surgery Created Successfully', null);
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return $this->sendResponse(500, 'some thing went wrong', null);
        }
    }

    public function show(Surgery $surgery)
    {
        return $this->sendResponse(200, 'Surgery', $surgery);
    }

    public function update(UpdateSurgeryRequest $request, Surgery $Surgery)
    {
        DB::beginTransaction();
        try {
            if ($request->only('patient_id')) {
                $admission_id = Admission::where('patient_id', $request->only('patient_id'))->where('discharge_date', null)->get()->last();
            }
            $validated = $request->validated();
            $data = Arr::except($validated, 'patient_id');
            $data['admission_id'] = $admission_id->id;
            $Surgery->update($data);
            if ($request->has('surgery_doctor')) {
                $surgery_doctor = $request->safe()->only('surgery_doctor')['surgery_doctor'];
                $Surgery->doctors()->sync($surgery_doctor);
            }
            DB::commit();
            return $this->sendResponse(200, 'Surgery Updated Successfully', null);
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return $this->sendResponse(500, 'some thing went wrong', null);
        }
    }

    public function destroy(Surgery $Surgery)
    {
        DB::beginTransaction();
        try {
            $Surgery->doctors()->detach();
            $Surgery->delete();
            DB::commit();
            return $this->sendResponse(200, 'Surgery Deleted Successfully', null);
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return $this->sendResponse(500, 'some thing went wrong', null);
        }
    }
}
