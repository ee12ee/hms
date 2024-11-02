<?php

namespace Modules\Department\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


// use Modules\Department\Database\Factories\RoomFactory;

class Room extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'number',
        'bed_numbers',
        'status',
        'department_id',
    ];
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function scopeVacantOrPartiallyVacant( Builder $query): void
    {
        $query->whereIn('status', ['vacant', 'partially vacant']);
    }
    // protected static function newFactory(): RoomFactory
    // {
    //     // return RoomFactory::new();
    // }
}
