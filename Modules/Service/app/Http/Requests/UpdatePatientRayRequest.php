<?php

namespace Modules\Service\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FormRequestTrait;

class UpdatePatientRayRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'result'=>'required|string|max:50',
            'description'=>'required|string|max:50',
            'date'=>'required|date',
            'ray_id'=>'required|exists:rays,id',
            'admission_id'=>'required|exists:admissions,id',
            'doctor_id'=>'required|exists:doctors,id',
            'file' => 'required|array|min:1',
            'file.*' => 'image|mimes:jpg,png',
        ];
    }
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo('manage services');
    }

}
