<?php

namespace Modules\Service\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Traits\FormRequestTrait;

class StoreRayRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name'=>'required|string|max:50',
            'type'=>'required|string|max:50',
            'amount'=>'required|numeric',
        ];
    }
    public function authorize(): bool
    {
        return $this->user()->hasPermissionTo('manage services');
    }

}
