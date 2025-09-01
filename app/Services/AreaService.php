<?php

namespace App\Services;

use App\Models\Area;
use App\Models\District;

class AreaService
{
    public function index()
    {
        $data['areas'] = Area::orderByDesc('id')->get();
        return view('areas.index', $data);
    }

    public function store(array $data)
    {
        Area::create([
            'name' => $data['name'],
            'active_flag' => $data['active_flag'] ?? 0,
            'created_by' => get_logged_in_user_id(),
            'updated_by' =>  get_logged_in_user_id(),
        ]);

        return redirect(route('areas', absolute: false))->with('success', 'Area Created Successfully!!!');
    }

    public function update(array $data)
    {
        $category = Area::find($data['id']);
        $category->update([
            'name' => $data['name'],
            'active_flag' => $data['active_flag'] ?? 0,
            'updated_by' =>  get_logged_in_user_id(),
        ]);

        return redirect(route('areas', absolute: false))->with('success', 'Area Updated Successfully!!!');

    }

    public function destroy($id)
    {
        $category = Area::find($id);

        if(!$category)
            return redirect(route('areas', absolute: false))->with('error', 'Area Not Found');;

        District::where('area_id', $category->id)->delete();
        $category->delete();
        return redirect(route('areas', absolute: false))->with('success', 'Area Deleted Successfully!!!');
    }

    public function storeDistrict(array $data)
    {
//        dd($data);
        if(empty($data['district'][1])){
            return redirect(route('areas', absolute: false))->with('error', 'List of District is Empty!!!');
        }

        $results = 0;
        foreach ($data['district'] as $value) {
//            dd($value, isset($value['active_flag']));
            if(empty($value['id'])){
                District::updateOrCreate([
                    'area_id' => $data['area_id'],
                    'name' => trim($value['name']),
                    'active_flag' => $value['active_flag'] ?? 0,
                ],
                [
                    'created_by' => get_logged_in_user_id(),
                    'updated_by' =>  get_logged_in_user_id(),
                ]);
            } else {
                District::find($value['id'])->update([
                    'area_id' => $data['area_id'],
                    'name' => trim($value['name']),
                    'active_flag' => $value['active_flag'] ?? 0,
                    'updated_by' =>  get_logged_in_user_id(),
                ]);
            }
        }

        return redirect(route('areas', absolute: false))->with('success', 'District Created Successfully!!!');
    }

    public function destroyDistrict($id)
    {
        $dropdown = District::find($id);

        if(!$dropdown){
            return response()->json([
                'status' => 'error',
                'message' => 'District Not Found'
            ], 400);
        }

        $dropdown->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'District Deleted Successfully!!!'
        ]);
    }
}
