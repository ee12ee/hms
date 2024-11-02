<?php

namespace Modules\Department\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FormRequestTrait;
class UpdateDepartmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'=>'required|string|min:2|max:50',
        ];
    }

<<<<<<< HEAD
    // /**
    //  * Determine if the user is authorized to make this request.
    //  */
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo('manage departments and clinics');
    }
=======
>>>>>>> f3a2a76f750f7835004f95c45ef98cc6e0d2296b
}
