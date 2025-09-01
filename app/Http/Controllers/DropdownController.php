<?php

namespace App\Http\Controllers;

use App\Models\Dropdown;
use App\Services\DropdownService;
use Illuminate\Http\Request;

class DropdownController extends Controller
{
    private DropdownService $dropdownService;

    public function __construct(DropdownService $dropdownService)
    {
        $this->dropdownService = $dropdownService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->dropdownService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        return $this->dropdownService->store($request->all());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        return $this->dropdownService->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->dropdownService->destroy($request->id);
    }

    public function storeDropdowns(Request $request)
    {
        $request->validate([
            'dropdown' => ['required'],
        ]);

        return $this->dropdownService->storeDropdowns($request->all());
    }

    public function destroyDropdowns(Request $request)
    {
        return $this->dropdownService->destroyDropdowns($request->id);
    }
}
