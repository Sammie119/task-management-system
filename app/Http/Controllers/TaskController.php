<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private TaskService $TaskService;

    public function __construct(TaskService $TaskService)
    {
        $this->TaskService = $TaskService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         return $this->TaskService->index();
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

        return $this->TaskService->store($request->all());
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



        return $this->TaskService->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->TaskService->destroy($request->id);
    }
}
