<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait ResponseTrait
{
    public function successfulResponse($status='success',$data=null,$message,$code=200)
    {
      return response()->json(['status' => $status,'message'=>$message, 'data' => $data],$code);
    }

    public function errorResponse($status='error',$data=null,$message,$code=500)
    {
      return response()->json(['status' => $status,'message'=>$message, 'data' => $data],$code);
    }
}
