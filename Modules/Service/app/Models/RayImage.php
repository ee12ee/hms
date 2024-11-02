<?php

namespace Modules\Service\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Service\Database\Factories\RayImageFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
class RayImage extends Model
{
    use HasFactory,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'filename',
        'mediaable_type',
        'mediaable_id',
    ];

    public function mediaable(): MorphTo
    {
        return $this->morphTo();
    }
    // protected static function newFactory(): RayImageFactory
    // {
    //     // return RayImageFactory::new();
    // }
}
