<?php

namespace Modules\Service\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Register\Models\Admission;
use Modules\Register\Models\Patient;
use Modules\Service\Http\Requests\StorePatientTestRequest;
use Modules\Service\Http\Requests\UpdatePatientTestRequest;
use Modules\Service\Models\PatientTest;
use Illuminate\Support\Arr;

class PatientTestController extends Controller
{

    public function index()
    {
        $tests = PatientTest::all();
        return $this->sendResponse(200, 'all Tests', $tests);
    }

    public function store(StorePatientTestRequest $request)
    {
        $validated = $request->validated();
        if ($request->only('patient_id')) {
            $admission_id = Admission::where('patient_id', $request->only('patient_id'))->where('discharge_date', null)->get()->last();
        }
        $data = Arr::except($validated, 'patient_id');
        $data['admission_id'] = $admission_id->id;
        $Test = PatientTest::create($data);
        return $this->sendResponse(201, 'Patient Test Created Successfully', null);
    }

    public function show(PatientTest $PatientTest)
    {
        return $this->sendResponse(200, 'Patient Test', $PatientTest);
    }

    public function update(UpdatePatientTestRequest $request,PatientTest $PatientTest)
    {
        $validated = $request->validated();
        $PatientTest->update($validated);
        return $this->sendResponse(200, 'Patient Test Updated Successfully', $PatientTest);
    }

    public function destroy(PatientTest $PatientTest)
    {
        $PatientTest->delete();
        return $this->sendResponse(200, 'Patient Test Deleted Successfully', null);
    }

    public function showPatientTest(Patient $Patient)
    {
       $tests= $Patient->patientTests()->get();
        return $this->sendResponse(200, 'Patient Tests', $tests);
    }
}
