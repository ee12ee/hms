<?php

namespace Modules\Department\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Department\Http\Requests\StoreRoomRequest;
use Modules\Department\Http\Requests\UpdateRoomRequest;
use Modules\Department\Models\Room;
use Modules\Register\Models\Patient;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Support\Facades\Log;
use Modules\Register\Models\PatientRoom;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return $this->sendResponse(200, 'all rooms', $rooms);
    }

    public function store(StoreRoomRequest $request)
    {
        $validated = $request->validated();
        $Room = Room::create($validated);
        return $this->sendResponse(201, 'Room Created Successfully', null);
    }

    public function show(Room $Room)
    {
        return $this->sendResponse(200, 'Room', $Room);
    }

    public function update(UpdateRoomRequest $request, Room $Room)
    {
        $validated = $request->validated();
        $Room->update($validated);
        return $this->sendResponse(200, 'Room Updated Successfully', $Room);
    }

    public function destroy(Room $Room)
    {
        $Room->delete();
        return $this->sendResponse(200, 'Room Deleted Successfully', null);
    }

    public function findRoom(Request $request)
    {
        $number=$request->input('number');
        $status=$request->input('status');
        $departmentName=$request->input('department_name');
        $bedNumbers = $request->input('bed_numbers');

        $Rooms = Room::query();

        if ($number) {
            $Rooms->whereBetween('number','=',$number);
        }

        if ($status) {
            $Rooms->where('status',$status);
        }

        if ($departmentName) {
            $Rooms->WhereHas('department', function ($query) use ($departmentName) {
                    $query->where('name', 'like', '%'.$departmentName.'%');
                });
        }

        if ($bedNumbers) {
            $Rooms->where('bed_numbers','=',$bedNumbers);
        }

        $Rooms=$Rooms->get();
       return $this->sendResponse(200, 'Rooms that found', $Rooms);
    }

    public function changeRoomStatus(Request $request, Room $room)
    {

        $room->update([
           'status'=> $request->status
        ]);
        return $this->sendResponse(200, 'Room status Was Change Successfully', null);
    }

    public function bookRoom(Patient $patient,Room $room)
    {
        DB::beginTransaction();
        try {
            if($room->status=='vacant')
            {
                $room->update([
                    'status'=> 'partially vacant'
                 ]);
                 $admission=$patient->admissions->last();
                 PatientRoom::create([
                  'entry_date'=>Carbon::now(),
                  'admission_id'=>$admission->id,
                  'room_id'=>$room->id,
                 ]);
                 $Msg="Room Was Booked Successfully";
            }
            elseif($room->status=='partially vacant')
            {
                $room->update([
                    'status'=> 'occupied'
                 ]);
                 $admission=$patient->admissions->last();
                 PatientRoom::create([
                  'entry_date'=>Carbon::now(),
                  'admission_id'=>$admission->id,
                  'room_id'=>$room->id,
                 ]);
                 $Msg="Room Was Booked Successfully";
            }
            else{
                $Msg="Room Was Not Booked Successfully! Check Room Status";
            }
            DB::commit();
            return $this->sendResponse(200, $Msg, null);
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return $this->sendResponse(500, 'some thing went wrong', null);
        }
    }

    public function unBookRoom(PatientRoom $patientRoom,Room $room)
    {
        DB::beginTransaction();
        try {
            if($room->status=='occupied')
            {
                $room->update([
                    'status'=> 'partially vacant'
                 ]);
                 $patientRoom->update([
                    'exit_date'=>Carbon::now(),
                 ]);
                 $Msg="Room Was UnBooked Successfully";
            }
            else
            {
                $room->update([
                    'status'=> 'vacant'
                 ]);
                 $patientRoom->update([
                    'exit_date'=>Carbon::now(),
                 ]);
                 $Msg="Room Was UnBooked Successfully";
            }
            DB::commit();
            return $this->sendResponse(201, $Msg, null);
        } catch (Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return $this->sendResponse(500, 'some thing went wrong', null);
        }
    }
}
