<?php

namespace Modules\Ambulance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Ambulance\Database\Factories\EmergencyRequestFactory;

class EmergencyRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'patient_name',
        'patient_contact',
        'location',
        'emergency_type'];

    // protected static function newFactory(): EmergencyRequestFactory
    // {
    //     // return EmergencyRequestFactory::new();
    // }
}
