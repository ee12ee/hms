<?php

namespace Modules\Register\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FormRequestTrait;

class StoreAdmissionRequest extends FormRequest
{
    // use FormRequestTrait;

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'discharge_reason'=>'nullable|string|max:50',
            'patient_id'=>'required|exists:patients,id',
            'patient_complaint'=>'required|string',
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
