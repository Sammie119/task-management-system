<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function index()
    {
        $data['Task'] = Task::orderByDesc('id')->get();
        return view("Task.index", $data);
    }

    public function store(array $data)
    {
        Task::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'status' => $data['status'],
            'priority' => $data['priority'],
            'start_date' => $data['start_date'],
            'due_date' => $data['due_date'],
            'active_flag' => $data['active_flag'] ?? 0,
            'area_id' => get_logged_in_area_id(),
            'created_by' => get_logged_in_user_id(),
            'updated_by' =>  get_logged_in_user_id(),
        ]);

        return redirect(route('task', absolute: false))->with('success', 'Task Created Successfully!!!');
    }

    public function update(array $data)
    {
       Task::find($data['id'])->update([
           'name' => $data['name'],
            'description' => $data['description'],
            'status' => $data['status'],
            'priority' => $data['priority'],
            'start_date' => $data['start_date'],
            'due_date' => $data['due_date'],
            'active_flag' => $data['active_flag'] ?? 0,
            'area_id' => get_logged_in_area_id(),
            'created_by' => get_logged_in_user_id(),
            'updated_by' =>  get_logged_in_user_id(),
        ]);

        return redirect(route('task', absolute: false))->with('success', 'Task Updated Successfully!!!');
    }

    public function destroy($id)
    {
        $Task = Task::find($id);

        if(!$Task)
            return redirect(route('task', absolute: false))->with('error', 'Task Not Found');;

        $Task->delete();
        return redirect(route('task', absolute: false))->with('success', 'Task Deleted Successfully!!!');
    }
}
