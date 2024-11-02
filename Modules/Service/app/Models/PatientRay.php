<?php

namespace Modules\Service\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Register\Models\Admission;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Doctor\Models\Doctor;

// use Modules\Service\Database\Factories\PatientRayFactory;

class PatientRay extends Model
{
    use HasFactory,SoftDeletes;

    protected $with = [
        'ray',
        'images',
        'doctor'
    ];

    protected $fillable = [
        'result',
        'description',
        'date',
        'ray_id',
        'admission_id',
        'doctor_id',
    ];

    public function ray(): BelongsTo
    {
        return $this->belongsTo(Ray::class);
    }

    public function admission(): BelongsTo
    {
        return $this->belongsTo(Admission::class);
    }

    public function images()
    {
        return $this->morphMany(RayImage::class, 'mediaable');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    // protected static function newFactory(): PatientRayFactory
    // {
    //     // return PatientRayFactory::new();
    // }
}
