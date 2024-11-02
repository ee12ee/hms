<?php

namespace Modules\Department\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FormRequestTrait;
use BenSampo\Enum\Rules\EnumValue;
use Modules\Department\Enums\AnesthetizationTypes;

class StoreSurgeryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'anesthesia_type'=>['required', new EnumValue(AnesthetizationTypes::class)],
            'result' => 'nullable|string',
            'date' => 'required|date',
            'hour'=>'required|date_format:H:i:s',
            'end_hour' => 'nullable|date_format:H:i:s',
            'patient_id' => 'required|exists:patients,id',
            'room_id' => 'required|exists:rooms,id',
            'surgery_doctor' => 'required|array',
            'surgery_doctor.*.doctor_id' => 'required|exists:doctors,id',
        ];
    }
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo('manage departments and clinics');
    }

}
