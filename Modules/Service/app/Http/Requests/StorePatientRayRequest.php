<?php

namespace Modules\Service\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FormRequestTrait;

class StorePatientRayRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'result'=>'nullable|string|max:50',
            'description'=>'nullable|string|max:50',
            'date'=>'required|date',
            'ray_id'=>'required|exists:rays,id',
            'patient_id'=>'required|exists:patients,id',
            'doctor_id'=>'required|exists:doctors,id',
            'file' => 'array|min:1',
            'file.*' => 'image|mimes:jpg,png',
        ];
    }
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo('manage services');
    }

}
