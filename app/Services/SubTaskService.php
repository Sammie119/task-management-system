<?php

namespace App\Services;

use App\Models\subTask;

class SubTaskService
{
    public function index()
    {
        $data['subTask'] = subTask::orderByDesc('id')->get();
        return view("sub_task.index", $data);
    }

    public function store(array $data)
    {
        subTask::create([
            'task_id' => get_logged_in_sub_task_id(),
            'user_id' =>get_logged_in_user_id(),
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

        return redirect(route('sub_task', absolute: false))->with('success', 'SubTask Created Successfully!!!');
    }

    public function update(array $data)
    {
       subTask::find($data['id'])->update([
           'task_id' => get_logged_in_sub_task_id(),
            'user_id' =>get_logged_in_user_id(),
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

        return redirect(route('sub_task', absolute: false))->with('success', 'SubTask Updated Successfully!!!');
    }

    public function destroy($id)
    {
        $subTask = subTask::find($id);

        if(!$subTask)
            return redirect(route('sub_task', absolute: false))->with('error', 'SubTask Not Found');;

        $subTask->delete();
        return redirect(route('sub_task', absolute: false))->with('success', 'SubTask Deleted Successfully!!!');
    }
}
