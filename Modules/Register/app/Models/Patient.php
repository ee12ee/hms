<?php

namespace Modules\Register\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Register\Database\Factories\PatientFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Department\Models\Room;
use Modules\Service\Models\PatientTest;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Modules\Service\Models\PatientRay;
use Illuminate\Database\Eloquent\SoftDeletes;
class Patient extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'birthday',
        'gender',
        'marital_status',
        'children_number',
        'allergies',
        'habits',
        'medical_history',
        'blood_group',
        'number',
    ];

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class);
    }

    public function currentRooms(): HasManyThrough
    {
        return $this->hasManyThrough(
            PatientRoom::class,
            Admission::class,
            'patient_id',
            'admission_id',
            'id',
            'id'
        )->where('exit_date',null);
    }

    public function admissions(): HasMany
    {
        return $this->hasMany(Admission::class);
    }


    public function patientTests(): HasManyThrough
    {
        return $this->hasManyThrough(PatientTest::class, Admission::class,'patient_id','admission_id','id','id');
    }

    public function patientRays(): HasManyThrough
    {
        return $this->hasManyThrough(PatientRay::class, Admission::class,'patient_id','admission_id','id','id');
    }

    // protected static function newFactory(): PatientFactory
    // {
    //     // return PatientFactory::new();
    // }
}
