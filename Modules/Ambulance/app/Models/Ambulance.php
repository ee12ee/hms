<?php

namespace Modules\Ambulance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Ambulance\Database\Factories\AmbulanceFactory;

class Ambulance extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'vehicle_number',
        'vehicle_model',
        'driver_name',
        'driver_contact',
        'available'];

    // protected static function newFactory(): AmbulanceFactory
    // {
    //     // return AmbulanceFactory::new();
    // }
}
