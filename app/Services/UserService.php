<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function index()
    {
        $data['users'] = User::where('area_id', get_logged_in_area_id())
            ->where('id', '!=', 1)
            ->orderByDesc('id')->get();
        return view('auth.index', $data);
    }

    public function store(array $data)
    {
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'active_flag' => $data['active_flag'] ?? 0,
            'area_id' => get_logged_in_area_id(),
            'created_by' => get_logged_in_user_id(),
            'updated_by' =>  get_logged_in_user_id(),
        ]);

        return redirect(route('users', absolute: false))->with('success', 'User Created Successfully!!!');
    }

    public function update(array $data)
    {
        $user = User::find($data['id']);
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'role' => $data['role'],
            'active_flag' => $data['active_flag'] ?? 0,
            'updated_by' =>  get_logged_in_user_id(),
        ]);

        if(!empty($data['password'])){
            $user->update(['password' => Hash::make($data['password'])]);
        }

        return redirect(route('users', absolute: false))->with('success', 'User Updated Successfully!!!');

    }

    public function destroy($id)
    {
        $user = User::find($id);

        if(!$user)
            return redirect(route('users', absolute: false))->with('error', 'User Not Found');;

        $user->delete();
        return redirect(route('users', absolute: false))->with('success', 'User Deleted Successfully!!!');
    }
}
