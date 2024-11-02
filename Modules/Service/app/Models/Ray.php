<?php

namespace Modules\Service\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Service\Database\Factories\RayFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Ray extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'amount',
    ];

    // protected static function newFactory(): RayFactory
    // {
    //     // return RayFactory::new();
    // }
}
