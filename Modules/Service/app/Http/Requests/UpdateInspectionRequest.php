<?php

namespace Modules\Service\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInspectionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'diagnose'=>'required|string|max:128',
            'medicine'=>'required|string|max:128',
            'description'=>'required|string|max:255',
            'admission_id'=>'required|integer|exists:admissions,id',
            'doctor_id'=>'required|integer|exists:doctors,id'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo('manage services');
    }
}
