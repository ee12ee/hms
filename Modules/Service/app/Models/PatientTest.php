<?php

namespace Modules\Service\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Register\Models\Admission;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Doctor\Models\Doctor;

// use Modules\Service\Database\Factories\PatientTestFactory;

class PatientTest extends Model
{
    use HasFactory,SoftDeletes;

    protected $with = [
        'test' ,'doctor',
    ];

    protected $fillable = [
        'result',
        'description',
        'date',
        'test_id',
        'admission_id',
        'doctor_id',
    ];

    public function test(): BelongsTo
    {
        return $this->belongsTo(Test::class);
    }

    public function admission(): BelongsTo
    {
        return $this->belongsTo(Admission::class);
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    // protected static function newFactory(): PatientTestFactory
    // {
    //     // return PatientTestFactory::new();
    // }
}
