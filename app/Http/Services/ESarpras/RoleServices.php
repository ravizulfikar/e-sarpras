<?php

namespace App\Http\Services\ESarpras;

use App\Models\Role;
use App\Models\Level;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RoleServices
{
    public function main()
    {
        return Role::all();
    }

    public function findBy($field, $id)
    {
        return User::where($field, $id)->first();
    }

    public function paramsLevel()
    {
        return Level::select(['level'])->get();
    }

    public function doStore($request) {

        $role = Role::create($request->all());

        return $role;
    }

    public function doUpdate($request, $role) {

        $role->update($request->all());

        return "success";
    }
}
