<?php

namespace Modules\Register\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FormRequestTrait;

class UpdatePatientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'first_name'=>'required|string|max:50',
            'last_name'=>'required|string|max:50',
            'address'=>'required|string|max:50',
            'birthday'=>'required|date',
            'gender'=>'required|string',
            'marital_status'=>'nullable|string',
            'children_number'=>'nullable|numeric',
            'allergies'=>'required|string|max:50',
            'habits'=>'nullable|numeric',
            'medical_history'=>'required|string|max:100',
            'blood_group'=>'required|string',
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
