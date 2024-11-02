<?php

namespace Modules\Doctor\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\Department\Models\Department;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Modules\Doctor\Database\Factories\ShiftFactory;

class Shift extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'shift_type',
        'shiftable_id',
        'shiftable_type'
    ];

    public function doctors(){
        return $this->belongsToMany(Doctor::class,'shift_doctor');
    }
    public function shiftable(): MorphTo
    {
        return $this->morphTo();
    }

    // protected static function newFactory(): ShiftFactory
    // {
    //     // return ShiftFactory::new();
    // }
}
