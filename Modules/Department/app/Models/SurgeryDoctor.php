<?php

namespace Modules\Department\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Department\Database\Factories\SurgeryDoctorFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class SurgeryDoctor extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'surgery_id',
        'doctor_id'
    ];

    // protected static function newFactory(): SurgeryDoctorFactory
    // {
    //     // return SurgeryDoctorFactory::new();
    // }
}
