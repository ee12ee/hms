<?php

namespace Modules\Service\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FormRequestTrait;

class StorePatientTestRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'result'=>'nullable|string|max:50',
            'description'=>'nullable|string|max:50',
            'date'=>'required|date',
            'test_id'=>'required|exists:tests,id',
            'patient_id'=>'required|exists:patients,id',
            'doctor_id'=>'required|exists:doctors,id',
        ];
    }
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo('manage services');
    }

}
