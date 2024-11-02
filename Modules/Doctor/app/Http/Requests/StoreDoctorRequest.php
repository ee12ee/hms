<?php

namespace Modules\Doctor\Http\Requests;


use BenSampo\Enum\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Doctor\Enums\DoctorStatues;
class StoreDoctorRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'first_name'=>'required|alpha|min:2|max:25',
            'last_name'=>'required|alpha|min:2|max:25',
            'speciality'=>'required|string',
            'city'=>'required|string',
            'street'=>'required|string',
            'phone'=>'required|regex:/^09\d{8}$/|unique:doctors,phone',
            'license_number'=>'required|unique:doctors,license_number',
            'department_id'=>'required|exists:departments,id',
            'department_head'=>'required|boolean',
            'status'=>'required|EnumValue:' . DoctorStatues::class
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo( 'manage doctors');
    }
}
