<?php

namespace Modules\Service\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FormRequestTrait;

class UpdatePatientTestRequest extends FormRequest
{
    use FormRequestTrait;

    public function rules(): array
    {
        return [
            'result'=>'required|string|max:50',
            'description'=>'required|string|max:50',
            'date'=>'required|date',
            'test_id'=>'required|exists:tests,id',
            'admission_id'=>'required|exists:admissions,id',
            'doctor_id'=>'required|exists:doctors,id',
        ];
    }
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo('manage services');
    }

}
