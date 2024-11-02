<?php

namespace Modules\Doctor\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'speciality' => $this->speciality,
            'address'=>$this->address,
            'phone'=>$this->phone,
            'is head of department?'=>$this->department_head,
            'department'=>$this->department->name,
        ];
    }
}
