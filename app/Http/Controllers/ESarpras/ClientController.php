<?php

namespace App\Http\Controllers\ESarpras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Region;

class ClientController extends Controller
{
    public function getWilayah($city){
        return response()->json([
            "data" => Region::whereCity($city)->get(),
        ]);
    }
}
