<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return $this->taskService->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'start_date' => 'required',
            'due_date' => 'required',

        ]);

        return $this->taskService->store($request->all());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'first_name' ,
            'last_name',
            'email' => 'email|unique:Task,email,'.$request->id,
            'date_of_birth' => 'date',
            'gender' => 'in:Male,Female',
            'phone' ,
            'address' ,
            'position' => 'exists:dropdowns,id',
        ]);



        return $this->taskService->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->taskService->destroy($request->id);
    }
}
