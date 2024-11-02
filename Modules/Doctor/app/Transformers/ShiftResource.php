<?php

namespace Modules\Doctor\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShiftResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
       return [
           'id'=>$this->id,
           'date'=>$this->date,
           'start_time'=>$this->start_time,
           'end_time'=>$this->end_time,
           'shift_type'=>$this->shift_type,
           'doctors' => DoctorResource::collection($this->whenLoaded('doctors'))
       ];
    }
}
