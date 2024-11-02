<?php

namespace Modules\Ambulance\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAmbulanceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'vehicle_number'=>'required|string|unique:ambulances,vehicle_number',
            'vehicle_model'=>'required|string',
            'driver_name'=>'required|string',
            'driver_contact'=>'required|regex:/^09\d{8}$/',
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
