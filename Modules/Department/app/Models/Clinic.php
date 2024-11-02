<?php

namespace Modules\Department\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Doctor\Models\Shift;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Modules\Department\Database\Factories\ClinicFactory;

class Clinic extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['name'];
    public function shifts(): MorphMany
    {
        return $this->morphMany(Shift::class, 'shiftable');
    }


    // protected static function newFactory(): ClinicFactory
    // {
    //     // return ClinicFactory::new();
    // }
}
