<?php

namespace Modules\Ambulance\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IsAvialableAmbulanceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'available'=>'required|boolean'
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