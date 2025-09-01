<?php

use App\Models\Dropdown;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

if (!function_exists("get_logged_in_user_id")) {
    function get_logged_in_user_id(): int
    {
        return Auth::user()->id;
    }
}

if (!function_exists("get_logged_in_area_id")) {
    function get_logged_in_area_id(): int
    {
        return Auth::user()->area_id;
    }
}

if (!function_exists("get_user_name")) {
    function get_user_name($id): string
    {
        $user = User::find($id);
        if($user){
            return $user->name;
        }
        return "";
    }
}

if(!function_exists('get_active_flag')) {
    function get_active_flag($active_flag)
    {
        if($active_flag === 1 ) {
            return '<span class="badge rounded-pill bg-success">Enabled</span>';
        }

        return '<span class="badge rounded-pill bg-danger">Disabled</span>';
    }
}

if(!function_exists('get_user_role')) {
    function get_user_role($role)
    {
        return [
            'super_admin' => 'Super Admin',
            'admin' => 'Admin',
            'user' => 'User',
            'auditor' => 'Auditor',
        ][$role] ?? 'user';
    }
}

if (!function_exists("get_dropdown_name")) {
    function get_dropdown_name($id): string|null
    {
        $dropdown = Dropdown::find($id);
        if($dropdown){
            return $dropdown->name;
        }
        return null;
    }
}

if (!function_exists("get_staff_name")) {
    function get_staff_name($id): string|null
    {
        $staff = Staff::find($id);
        if($staff){
            return $staff->first_name.' '.$staff->last_name;
        }
        return null;
    }
}

