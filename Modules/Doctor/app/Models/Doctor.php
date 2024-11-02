<?php

namespace Modules\Doctor\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Department\Models\Department;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Modules\Department\Models\Surgery;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Modules\Doctor\Database\Factories\DoctorFactory;

class Doctor extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'speciality',
        'address',
        'phone',
        'status',
        'license_number',
        'department_id',
       ' department_head'];

    public function shifts()
    {
        return $this->belongsToMany(Shift::class,'shift_doctor');
    }

    public function department()
    {
        return $this->belongsTo(Department::class,'department_id');
    }

    public static function booted()
    {
        parent::creating(function (Doctor $doctor){
            $doctor->address = request()->city.','.request()->street;
        });
    }
    public function scopeActive(Builder $query):void
    {
          $query->where('status','active');
    }

    public function surgeries(): BelongsToMany
    {
        return $this->belongsToMany(Surgery::class,'surgery_doctors');
    }


    // protected static function newFactory(): DoctorFactory
    // {
    //     // return DoctorFactory::new();
    // }
}
