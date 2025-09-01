<?php

namespace App\Services;

use App\Models\Dropdown;
use App\Models\DropdownCategory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DropdownService
{
    public function index()
    {
        $data['dropdowns'] = DropdownCategory::where('area_id', get_logged_in_area_id())->orderByDesc('id')->get();
        return view('dropdowns.index', $data);
    }

    public function store(array $data)
    {
        DropdownCategory::create([
            'name' => $data['name'],
            'active_flag' => $data['active_flag'] ?? 0,
            'area_id' => get_logged_in_area_id(),
            'created_by' => get_logged_in_user_id(),
            'updated_by' =>  get_logged_in_user_id(),
        ]);

        return redirect(route('dropdowns', absolute: false))->with('success', 'Dropdown Category Created Successfully!!!');
    }

    public function update(array $data)
    {
        $category = DropdownCategory::find($data['id']);
        $category->update([
            'name' => $data['name'],
            'active_flag' => $data['active_flag'] ?? 0,
            'updated_by' =>  get_logged_in_user_id(),
        ]);

        return redirect(route('dropdowns', absolute: false))->with('success', 'Dropdown Category Updated Successfully!!!');

    }

    public function destroy($id)
    {
        $category = DropdownCategory::find($id);

        if(!$category)
            return redirect(route('dropdowns', absolute: false))->with('error', 'Dropdown Category Not Found');;

        Dropdown::where('category_id', $category->id)->delete();
        $category->delete();
        return redirect(route('dropdowns', absolute: false))->with('success', 'Dropdown Category Deleted Successfully!!!');
    }

    public function storeDropdowns(array $data)
    {
//        dd($data);
        if(empty($data['dropdown'][1])){
            return redirect(route('dropdowns', absolute: false))->with('error', 'List of Dropdown is Empty!!!');
        }

        $results = 0;
        foreach ($data['dropdown'] as $value) {
//            dd($value, isset($value['active_flag']));
            if(empty($value['id'])){
                Dropdown::updateOrCreate([
                    'category_id' => $data['category_id'],
                    'name' => trim($value['name']),
                    'active_flag' => $value['active_flag'] ?? 0,
                    'area_id' => get_logged_in_area_id(),
                ],
                [
                    'created_by' => get_logged_in_user_id(),
                    'updated_by' =>  get_logged_in_user_id(),
                ]);
            } else {
                Dropdown::find($value['id'])->update([
                    'category_id' => $data['category_id'],
                    'name' => trim($value['name']),
                    'active_flag' => $value['active_flag'] ?? 0,
                    'updated_by' =>  get_logged_in_user_id(),
                ]);
            }
        }

        return redirect(route('dropdowns', absolute: false))->with('success', 'Dropdown Created Successfully!!!');
    }

    public function destroyDropdowns($id)
    {
        $dropdown = Dropdown::find($id);

        if(!$dropdown){
            return response()->json([
                'status' => 'error',
                'message' => 'Dropdown Not Found'
            ], 400);
        }

        $dropdown->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Dropdown Deleted Successfully!!!'
        ]);
//        return redirect(route('dropdowns', absolute: false))->with('success', 'Dropdown Deleted Successfully!!!');
    }
}
