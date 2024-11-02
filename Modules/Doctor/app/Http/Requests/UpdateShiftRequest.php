<?php

namespace Modules\Doctor\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Department\Models\Clinic;
use Modules\Department\Models\Department;
use Modules\Doctor\Enums\Months;
use Modules\Doctor\Enums\ShiftType;

class UpdateShiftRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'date'=>'required|date_format:Y-m-d',
            'start_time'=>'required|date_format:H:i',
            'end_time'=>'required|date_format:H:i',
            'shift_type'=>'required|EnumValue:' . ShiftType::class,
            'doctor_ids' => 'required|array',
            'doctor_ids.*' => 'exists:doctors,id',
            'shiftable_id' => 'required|integer',
            'shiftable_type' => 'required|string|in:clinic,department',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo( 'manage doctorShifts');
    }
}
