<?php

namespace Modules\Service\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Doctor\Models\Doctor;
use Modules\Register\Models\Admission;
// use Modules\Service\Database\Factories\InspectionFactory;

class Inspection extends Model
{
    use HasFactory, SoftDeletes;

    protected $with = ['doctor'];

    protected $fillable = [
        'diagnose',
        'medicine',
        'description',
        'admission_id',
        'doctor_id'
    ];

    public function admission(){
        return $this->belongsTo(Admission::class,'admission_id');
    }
    public function doctor(){
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    // protected static function newFactory(): InspectionFactory
    // {
    //     // return InspectionFactory::new();
    // }
}
