<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Services\AreaService;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    private AreaService $areaService;

    public function __construct(AreaService $areaService)
    {
        $this->areaService = $areaService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->areaService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        return $this->areaService->store($request->all());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        return $this->areaService->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->areaService->destroy($request->id);
    }

    public function storeDistrict(Request $request)
    {
        $request->validate([
            'district' => ['required'],
        ]);

        return $this->areaService->storeDistrict($request->all());
    }

    public function destroyDistrict(Request $request)
    {
        return $this->areaService->destroyDistrict($request->id);
    }
}
