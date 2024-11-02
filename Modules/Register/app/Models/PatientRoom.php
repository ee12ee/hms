<?php

namespace Modules\Register\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Register\Database\Factories\PatientRoomFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Department\Models\Room;

class PatientRoom extends Model
{
    use HasFactory,SoftDeletes;

    protected $with = ['room'];

    protected $fillable = [
        'entry_date',
        'exit_date',
        'admission_id',
        'room_id'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // protected static function newFactory(): PatientRoomFactory
    // {
    //     // return PatientRoomFactory::new();
    // }
}
