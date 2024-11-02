<?php

namespace Modules\Department\Http\Requests;

use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Department\Enums\RoomStatus;
use App\Traits\FormRequestTrait;

class StoreRoomRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'number'=>'required|integer',
            'bed_numbers'=>'required|integer',
            'status'=>['required', new EnumValue(RoomStatus::class)],
            'department_id'=>'required|exists:departments,id'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo('manage departments and clinics');
    }
}
