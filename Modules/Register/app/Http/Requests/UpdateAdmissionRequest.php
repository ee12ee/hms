<?php

namespace Modules\Register\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FormRequestTrait;

class UpdateAdmissionRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'discharge_reason'=>'nullable|string|max:50',
            'patient_id'=>'required|exists:patients,id',
            'patient_complaint'=>'required|string',
            'doctor_id'=>'nullable|exists:doctors,id',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo('manage patient records');
    }
}
