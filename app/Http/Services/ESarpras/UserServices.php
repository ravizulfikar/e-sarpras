<?php

namespace App\Http\Services\ESarpras;

use App\Models\User;
use App\Models\Role;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use DataTables;

class UserServices
{
    public function main()
    {
        return User::whereActive('t')->get();
    }

    public function findBy($field, $id)
    {
        return User::whereActive('t')->where($field, $id)->first();
    }

    public function paramsRole()
    {
        return Role::select(['id', 'name'])->get();
    }

    public function doStore($request) {
        $request['username']  = strtolower($request['username']);
        $request['email']     = strtolower($request['email']);
        $request['profile']   = json_encode($request['profile'], true);
        $request['password']  = bcrypt('1234567890');
        $request['confirmed'] = true;
        $request['active']    = true;

        $user = User::create($request->all());

        return $user;
    }

    public function doUpdate($request, $user) {
        // dd([$request["image"]->extension(), $request->all(), $user]);
        if(!empty($request["image"])){
            $filename = UploadFile($request["image"], 'uploads/avatar/', RenderJson($user->profile, "photo"));
        } else {
            $filename = RenderJson($user->profile, "photo");
        }

        $profile        = $request['profile'];
        $profileMerge   = array_merge($profile, ["photo" => $filename]);


        //Update to Datapase
        $request['username']  = strtolower($request['username']);
        $request['email']     = strtolower($request['email']);
        $request['profile']   = json_encode($profileMerge, true);

        if($request['password'] != null) {
            $request['password'] = bcrypt($request['password']);
        } else {
            unset($request['password']);
        }

        if($request['confirmed']) {
            $request['confirmed'] = true;
        } else {
            $request['confirmed'] = false;
        }

        if($request['active']) {
            $request['active'] = true;
        } else {
            $request['active'] = false;
        }

        // dd($request->all());

        $user->update($request->all());

        return "success";
    }

    // public function doDelete($id){
    //     $user = User::findOrFail($id);
    //     $user->delete();

    //     return $user;
    // }

    // public function fetchUser()
    // {
    //     $data = self::main();

    //     return DataTables::of($data)->addIndexColumn()
    //             ->addColumn('name', function($row){
    //                 return $row->name;
    //             })
    //             ->addColumn('email', function($row){
    //                 return $row->email;
    //             })
    //             ->addColumn('action', function($row){
    //                 $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
    //                 return $actionBtn;
    //             })
    //             ->rawColumns(['action'])   //merender content column dalam bentuk html
    //             ->make(true);
    //             // ->escapeColumns()  //mencegah XSS Attack
    //             // ->toJson();
    // }
}
