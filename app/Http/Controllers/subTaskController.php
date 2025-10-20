<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Services\SubTaskService;
use Illuminate\Http\Request;
use \App\Models\User;

class subTaskController extends Controller
{
    private SubTaskService $sub_taskService;

    public function __construct(SubTaskService $sub_taskService)
    {
        $this->sub_taskService = $sub_taskService;
    }

    //Fetch all Tasks
    public function create()
    {
        $tasks = Task::where('status', 'In-Progress')->pluck('name', 'id');
        $users = User::pluck('name', 'id');

        return view('sub_task.create', compact('tasks', 'users'));

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
            'task_id' => 'integer|exists:tasks,id',
            'user_id' => 'integer|exists:users,id',
            'sub_task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'priority' => 'required|string',
            'start_date' => 'required|date',
            'due_date' => 'required|date',

        ]);

        // Fetch actual names
        $task = Task::find($request->task_id);
        $user = User::find($request->user_id);

        // Merge into data
        $data = $request->all();
        $data['task_name'] = $task ? $task->name : null;
        $data['assigned_name'] = $user ? $user->name : null;

        if (!$user) {
            return back()->with('error', 'Invalid user selected.');
        }


        return $this->sub_taskService->store($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'task_id' => 'integer|exists:tasks,id',
            'user_id' => 'integer|exists:users,id',
            'sub_task_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'priority' => 'required|string',
            'start_date' => 'required|date',
            'due_date' => 'required|date',
        ]);

        // Fetch actual names
        $task = Task::find($request->task_id);
        $user = User::find($request->user_id);

        // Merge into data
        $data = $request->all();
        $data['task_name'] = $task ? $task->name : null;
        $data['assigned_name'] = $user ? $user->name : null;

        if (!$user) {
            return back()->with('error', 'Invalid user selected.');
        }

        return $this->sub_taskService->update($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        return $this->sub_taskService->destroy($request->id);
    }
}
