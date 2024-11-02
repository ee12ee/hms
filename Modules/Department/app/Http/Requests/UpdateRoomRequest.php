<?php

namespace Modules\Department\Http\Requests;

use BenSampo\Enum\Rules\EnumValue;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Department\Enums\RoomStatus;
use App\Traits\FormRequestTrait;

class UpdateRoomRequest extends FormRequest
{
    public function rules(): array
    {
        return [
<<<<<<< HEAD
            'number'=>'required|integer',
            'bed_numbers'=>'required|integer',
             'status'=>'required|EnumValue:' .RoomStatus::class,
//            'status'=>['required', new EnumValue(RoomStatus::class)],
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
=======
            'number'=>'sometimes|integer',
            'bed_numbers'=>'sometimes|integer',
             'status'=>'sometimes|EnumValue:' .RoomStatus::class,
            'department_id'=>'sometimes|exists:departments,id'
        ];
    }

>>>>>>> f3a2a76f750f7835004f95c45ef98cc6e0d2296b
}
