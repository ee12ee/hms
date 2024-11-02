<?php

namespace Modules\Ambulance\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmergencyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'patient_name'=>'required|string|min:2|max:50',
            'patient_contact'=>'required|regex:/^09\d{8}$/',
            'location'=>'required|string',
            'emergency_type'=>'required|string'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo('manage ambulance',);
    }
}
