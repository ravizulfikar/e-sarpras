<?php

namespace App\Http\Services\ESarpras;

use App\Models\Region;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegionServices
{
    public function main()
    {
        return Region::all();
    }

    public function findBy($field, $id)
    {
        return Region::where($field, $id)->first();
    }

    public function paramsCity()
    {
        return Region::paramsCity();
    }

    public function paramsLevelRegion()
    {
        return Region::paramsLevelRegion();
    }

    public function doStore($request) {
        $request['detail']   = json_encode($request['detail'], true);
        $region = Region::create($request->all());
        return $region;
    }

    public function doUpdate($request, $region) {
        $request['detail']   = json_encode($request['detail'], true);
        $region->update($request->all());
        return "success";
    }
}
