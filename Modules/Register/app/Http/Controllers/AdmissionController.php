<?php

namespace Modules\Register\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Modules\Register\Http\Requests\StoreAdmissionRequest;
use Modules\Register\Http\Requests\UpdateAdmissionRequest;
use Modules\Register\Models\Admission;
use Modules\Register\Models\Patient;
use Throwable;

class AdmissionController extends Controller
{

    public function index()
    {
        $Admissions = Admission::all();
        return $this->sendResponse(200, 'all Admissions', $Admissions);
    }

    public function store(StoreAdmissionRequest $request)
    {
        $validated = $request->validated();
        $date = Carbon::now();
        $validated['admission_date'] = $date;
        $Admission = Admission::create($validated);
        return $this->sendResponse(201, 'Admission Created Successfully', null);
    }

    public function show(Admission $Admission)
    {
        $AdmissionWithInspections = $Admission->with('inspections')->get();
        return $this->sendResponse(200, 'Admission', $AdmissionWithInspections);
    }

    public function showPatientAdmission(Patient $patient)
    {
        return $this->sendResponse(200, 'Patient Admissions', $patient->Admissions);
    }

    public function PatientLastAdmission(Patient $patient)
    {
        return $this->sendResponse(200, 'Patient Last Admissions', $patient->admissions->last());
    }

    public function patientMovement(Admission $admission)
    {
        $admission = Admission::with('patientRays', 'patientTests', 'patientRooms', 'inspections', 'surgeries')->where('id', $admission->id)->get();
        return $this->sendResponse(200, 'Patient Movement Admissions', $admission);
    }

    public function PatientDischarge(UpdateAdmissionRequest $request, Admission $Admission)
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $validated['discharge_date'] = Carbon::now();
            $Admission->update($validated);
            $patient = $Admission->patient;

            //unBook patient rooms
            $patientRooms = $patient->currentRooms;
            if ($patientRooms != null) {
                foreach ($patientRooms as $patientRoom) {
                    if ($patientRoom->room->status == 'occupied') {
                        $room = $patientRoom->room;
                        $room->update([
                            'status' => 'partially vacant',
                        ]);

                        $patientRoom->update(['exit_date' => Carbon::now()]);

                    } else {
                        $room = $patientRoom->room;
                        $room->update([
                            'status' => 'vacant',
                        ]);
                        $patientRoom->update(['exit_date' => Carbon::now()]);
                    }
                }
            }
            $admission = Admission::with('patientRays', 'patientTests', 'patientRooms', 'inspections', 'surgeries')->where('id', $Admission->id)->first();
            $name = 'PatientDischarge' . $patient->first_name . $admission->id;
            $filename = $name . '.pdf';
            $view = View::make('PatientDischargeFile', ['admission' => $admission, 'patient' => $patient]);
            $html = $view->render();

            $pdf = new TCPDF;

            $pdf::SetTitle('PatientDischargeFile');
            $pdf::SetFont('aealarabiya', '', 18);
            $pdf::setRTL(true);
            $pdf::AddPage();

            $pdf::writeHTML($html, true, false, true, false, '');

            $pdf::Output(public_path($filename), 'F');

            DB::commit();
            return response()->download(public_path($filename));
            // return $this->sendResponse(200, 'Patient Discharged Successfully', null);
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return $this->sendResponse(500, 'some thing went wrong', null);
        }
    }
}
