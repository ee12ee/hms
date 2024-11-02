<?php

namespace Modules\Department\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Department\Http\Requests\StoreDepartmentRequest;
use Modules\Department\Http\Requests\UpdateDepartmentRequest;
use Modules\Department\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments=Department::with(['doctors'=>function($query){
            $query->where('department_head',true)->get();
        }])->get();
        return $this->sendResponse(200,'the departments are',$departments) ;
    }

    public function store(StoreDepartmentRequest $request)
    {
        Department::query()->create($request->validated());
        return $this->sendResponse(201,'the department is created successfully ');
    }

    public function show(Department $department)
    {
        $dep=$department->with('rooms','doctors')->get();
        return $this->sendResponse(200,'the department is',$dep);
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $department->update($request->validated());
        return $this->sendResponse(200,'the department is updated successfully');
    }

    public function destroy(Department $department)
    {
        $department->deleteOrFail();
        return $this->sendResponse(200,'the department is deleted successfully');
    }

    public function showAvailableRooms(Department $Department)
    {
       $rooms=$Department->with(['rooms'=>function($query){
           $query->vacantOrPartiallyVacant();
       }])->get();
       return self::sendResponse(200,'the available room is',$rooms);
    }
}
