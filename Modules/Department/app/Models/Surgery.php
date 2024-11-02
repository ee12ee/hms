<?php

namespace Modules\Department\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Doctor\Models\Doctor;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Modules\Register\Models\Admission;
use Modules\Register\Models\Patient;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
// use Modules\Department\Database\Factories\SurgeryFactory;

class Surgery extends Model
{
    use HasFactory,SoftDeletes;

    protected $with = ['doctors','patient'];

    protected $fillable = [
        'name',
        'anesthesia_type',
        'result',
        'date',
        'hour',
        'end_hour',
        'admission_id',
        'room_id'
    ];

    public function doctors(): BelongsToMany
    {
        return $this->belongsToMany(Doctor::class,'surgery_doctors');
    }

    public function patient(): hasOneThrough
    {
        return $this->hasOneThrough(Patient::class, Admission::class,'patient_id','id');
    }

    // protected static function newFactory(): SurgeryFactory
    // {
    //     // return SurgeryFactory::new();
    // }
}
