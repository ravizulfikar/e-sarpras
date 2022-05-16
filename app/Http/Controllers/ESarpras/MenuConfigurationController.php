<?php

namespace App\Http\Controllers\ESarpras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuConfigurationController extends Controller
{
    private $pages = [
        'dashboard'     => 'index',
        'title'         => 'Menu Configuration',
        'folder'        => 'e-sarpras.menu',
        'index'         => 'menu.index',
        'update'        => 'menu.update'
    ];

    public function index()
    {
        return view($this->pages['folder'].'.index', [
            'pages' => $this->pages
        ]);
    }

    public function update()
    {
        // $data = $this->role->doUpdate($request, $role);

        // if($data == 'success'){
        //     return redirect()->back()->with('success', 'Data Successfully Updated!');
        // } else {
        //     return redirect()->back()->with('error', 'Server Error !');
        // }

    }
}
