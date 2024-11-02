<?php

namespace Modules\Register\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Register\Http\Requests\StorePatientRequest;
use Modules\Register\Http\Requests\UpdatePatientRequest;
use Modules\Register\Models\Patient;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Carbon\Carbon;
class PatientController extends Controller
{

    public function index()
    {
        $Patients = Patient::paginate(100);
        return $this->sendResponse(200, 'all Patient', $Patients);
    }

    public function store(StorePatientRequest $request)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $number= $validated['first_name'].Str::random(5);
            $validated['number'] = $number;
            $Patient = Patient::create($validated);
            if ($request->has('admission')) {
                $admissionData=$request->safe()->only('admission')['admission'];
                $date=Carbon::now();
                $admissionData['admission_date']=$date;
                $admissions=$Patient->admissions()->createMany([$admissionData]);
            }
            DB::commit();
            return $this->sendResponse(201, 'Patient Created Successfully', null);
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return $this->sendResponse(500, 'some thing went wrong', null);
        }
    }

    public function show(Patient $Patient)
    {
        return $this->sendResponse(200, 'Patient', $Patient);
    }

    public function update(UpdatePatientRequest $request, Patient $Patient)
    {
        $validated = $request->validated();
        $number= $validated['first_name'].Str::random(5);
        $validated['number'] = $number;
        $Patient->update($validated);
        return $this->sendResponse(200, 'Patient Updated Successfully', $Patient);
    }

    public function destroy(Patient $Patient)
    {
        $Patient->delete();
        return $this->sendResponse(200, 'Patient Deleted Successfully', null);
    }

}
