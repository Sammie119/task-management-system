<?php

namespace App\Services;

use App\Models\Staff;

class StaffService
{
    public function index()
    {
        $data['staff'] = Staff::orderByDesc('id')->get();
        return view("staff.index", $data);
    }

    public function store(array $data)
    {
        Staff::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'position' => $data['position'],
            'active_flag' => $data['active_flag'] ?? 0,
            'area_id' => get_logged_in_area_id(),
            'created_by' => get_logged_in_user_id(),
            'updated_by' =>  get_logged_in_user_id(),
        ]);

        return redirect(route('staff', absolute: false))->with('success', 'Staff Created Successfully!!!');
    }
}
