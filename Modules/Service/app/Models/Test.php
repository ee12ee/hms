<?php

namespace Modules\Service\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Service\Database\Factories\TestFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
class Test extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'type',
        'amount',
    ];

    // protected static function newFactory(): TestFactory
    // {
    //     // return TestFactory::new();
    // }
}
