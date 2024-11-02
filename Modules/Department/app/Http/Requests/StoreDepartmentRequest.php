<?php

namespace Modules\Department\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FormRequestTrait;
class StoreDepartmentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|min:2|max:50',
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
