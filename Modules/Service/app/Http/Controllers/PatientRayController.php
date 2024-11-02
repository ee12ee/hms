<?php

namespace Modules\Service\Http\Controllers;

use App\Helpers\MediaHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Modules\Register\Models\Admission;
use Modules\Register\Models\Patient;
use Modules\Service\Http\Requests\StorePatientRayRequest;
use Modules\Service\Http\Requests\UpdatePatientRayRequest;
use Modules\Service\Models\PatientRay;
use Throwable;

class PatientRayController extends Controller
{
    public function index()
    {
        $rays = PatientRay::paginate(100);
        return $this->sendResponse(200, 'all Rays', $rays);
    }

    public function store(StorePatientRayRequest $request)
    {
        $validated = $request->validated();
        if ($request->only('patient_id')) {
            $admission_id = Admission::where('patient_id', $request->only('patient_id'))->where('discharge_date', null)->get()->last();
        }
        $data = Arr::except($validated, 'patient_id');
        $data['admission_id'] = $admission_id->id;
        $Ray = PatientRay::create($data);
        return $this->sendResponse(201, 'Patient Ray Created Successfully', null);
    }

    public function show(PatientRay $PatientRay)
    {
        return $this->sendResponse(200, 'Patient Ray', $PatientRay);
    }

    public function update(UpdatePatientRayRequest $request, PatientRay $PatientRay)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $PatientRay->update($validated);
            if ($request->has('file')) {
                foreach ($PatientRay->images as $image) {
                    $img[] = 'Rays/' . $image->filename;
                }
                if (!empty($img)) {
                    Storage::disk('upload_file')->delete($img);
                    $PatientRay->images()->delete();
                }

                foreach ($request->safe()->only('file')['file'] as $i => $file) {
                    MediaHelper::Image($file, 'file',
                        'Rays', 'upload_file', $PatientRay->id, 'Modules\Service\Models\PatientRay', $request->safe()->only('admission_id')['admission_id'], 'Ray', 0);
                }
            }
            DB::commit();
            return $this->sendResponse(200, 'Patient Ray Updated Successfully', null);
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return $this->sendResponse(500, 'some thing went wrong', null);
        }
    }

    public function destroy(PatientRay $PatientRay)
    {
        DB::beginTransaction();
        try {
            foreach ($PatientRay->images as $image) {
                $img[] = 'Rays/' . $image->filename;
            }
            if (!empty($img)) {
                Storage::disk('upload_file')->delete($img);
                $PatientRay->images()->delete();
            }
            $PatientRay->delete();
            DB::commit();
            return $this->sendResponse(200, 'Patient Ray Deleted Successfully', null);
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return $this->sendResponse(500, 'some thing went wrong', null);
        }
    }

    public function showPatientRays(Patient $Patient)
    {
        $rays = $Patient->patientRays()->get();
        return $this->sendResponse(200, 'Patient Rays', $rays);
    }
}
