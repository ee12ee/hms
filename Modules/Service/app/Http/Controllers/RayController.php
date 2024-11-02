<?php

namespace Modules\Service\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Service\Http\Requests\StoreRayRequest;
use Modules\Service\Http\Requests\UpdateRayRequest;
use Modules\Service\Models\Ray;
use Illuminate\Support\Facades\Storage;

class RayController extends Controller
{
    public function index()
    {
        $rays = Ray::paginate(100);
        return $this->sendResponse(200, 'all rays', $rays);
    }

    public function store(StoreRayRequest $request)
    {
        $validated = $request->validated();
        $Ray = Ray::create($validated);
        return $this->sendResponse(201, 'Ray Created Successfully', null);
    }

    public function show(Ray $Ray)
    {
        return $this->sendResponse(200, 'Ray', $Ray);
    }

    public function update(UpdateRayRequest $request, Ray $Ray)
    {
        $validated = $request->validated();
        $Ray->update($validated);
        return $this->sendResponse(200, 'Ray Updated Successfully', null);
    }

    public function destroy(Ray $Ray)
    {
        $Ray->delete();
        return $this->sendResponse(200, 'Ray Deleted Successfully', null);
    }
}
