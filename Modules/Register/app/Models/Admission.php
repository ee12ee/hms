<?php

namespace Modules\Register\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Register\Database\Factories\AdmissionFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Department\Models\Surgery;
use Modules\Service\Models\Inspection;
use Modules\Service\Models\PatientRay;
use Modules\Service\Models\PatientTest;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Doctor\Models\Doctor;

class Admission extends Model
{
    use HasFactory,SoftDeletes;

    protected $with = ['doctor'];

    protected $fillable = [
        'admission_date',
        'discharge_date',
        'discharge_reason',
        'patient_id',
        'doctor_id',
        'patient_complaint'
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function inspections(){
        return $this->hasMany(Inspection::class);
    }

    public function patientRays()
    {
        return $this->hasMany(PatientRay::class);
    }

    public function patientTests()
    {
        return $this->hasMany(PatientTest::class);
    }

    public function patientRooms()
    {
        return $this->hasMany(PatientRoom::class);
    }

    public function surgeries()
    {
        return $this->hasMany(Surgery::class);
    }


    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    // protected static function newFactory(): AdmissionFactory
    // {
    //     // return AdmissionFactory::new();
    // }
}
