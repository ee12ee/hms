<?php

namespace Modules\Department\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Department\Models\Room;
use Modules\Doctor\Models\Doctor;
use Modules\Doctor\Models\Shift;
use Illuminate\Database\Eloquent\SoftDeletes;

// use Modules\Department\Database\Factories\DepartmentFactory;

class Department extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name'];
//    protected $with=['rooms','doctors'];

     public function doctors(){
         return $this->hasMany(Doctor::class);
     }
    public function rooms(){
        return $this->hasMany(Room::class,'department_id');
    }
    public function shifts():MorphMany
    {
        return $this->morphMany(Shift::class, 'shiftable');
    }
    // protected static function newFactory(): DepartmentFactory
    // {
    //     // return DepartmentFactory::new();
    // }
}
