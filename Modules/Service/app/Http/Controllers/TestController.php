<?php

namespace Modules\Service\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Service\Http\Requests\StoreTestRequest;
use Modules\Service\Http\Requests\UpdateTestRequest;
use Modules\Service\Models\Test;

class TestController extends Controller
{

    public function index()
    {
        $tests = Test::paginate(100);
        return $this->sendResponse(200, 'all Tests', $tests);
    }

    public function store(StoreTestRequest $request)
    {
        $validated = $request->validated();
        $Test = Test::create($validated);
        return $this->sendResponse(201, 'Test Created Successfully', null);
    }

    public function show(Test $Test)
    {
        return $this->sendResponse(200, 'Test', $Test);
    }

    public function update(UpdateTestRequest $request, Test $Test)
    {
        $validated = $request->validated();
        $Test->update($validated);
        return $this->sendResponse(200, 'Test Updated Successfully',null);
    }

    public function destroy(Test $Test)
    {
        $Test->delete();
        return $this->sendResponse(200, 'Test Deleted Successfully', null);
    }
}
