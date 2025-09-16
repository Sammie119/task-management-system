<?php

namespace App\Http\Controllers;

use App\Models\subTask;
use App\Services\SubTaskService;
use Illuminate\Http\Request;

class subTaskController extends Controller
{
    private SubTaskService $sub_taskService;

    public function __construct(SubTaskService $sub_taskService)
    {
        $this->sub_taskService = $sub_taskService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return $this->sub_taskService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=> '',
            'task_id'=> '',
            'name' => 'required',
            'description' => '',
            'status' => 'required',
            'priority' => 'required',
            'start_date' => 'required',
            'due_date' => 'required',

        ]);

        return $this->sub_taskService->store($request->all());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'user_id'=> '',
            'task_id'=> '',
            'name' => 'required',
            'description' => '',
            'status' => 'required',
            'priority' => 'required',
            'start_date' => 'required',
            'due_date' => 'required',
        ]);



        return $this->sub_taskService->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->sub_taskService->destroy($request->id);
    }
}
