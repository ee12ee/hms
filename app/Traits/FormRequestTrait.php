<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait FormRequestTrait
{
    public function authorize(): bool
    {
        return true;
    }

}
