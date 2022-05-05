<?php

namespace App\Http\Controllers\ESarpras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Role;
use App\Http\Requests\ESarpras\RoleRequest;
use App\Http\Services\ESarpras\RoleServices;

class RoleController extends Controller
{
    private $pages = [
        'dashboard'     => 'index',
        'title'         => 'Role Management',
        'folder'        => 'e-sarpras.role',
        'index'         => 'role.index',
        'create'        => [
            'url'       => 'role.create',
            'title'     => 'Create Role',
            'store'     => 'role.store',
        ],
        'show'          => [
            'url'       => 'role.show',
            'title'     => 'Detail Role',
        ],
        'edit'          => [
            'url'       => 'role.edit',
            'title'     => 'Edit Role',
            'update'    => 'role.update',
        ],
        'destroy'       => 'role.destroy',
    ];

    public function __construct(RoleServices $role)
    {
        $this->role = $role;
    }

    public function index()
    {
        return view($this->pages['folder'].'.index', [
            'pages' => $this->pages, 
            'data'  => $this->role->main()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->pages['folder'].'.create', [
            'pages'     => $this->pages,
            'levels'    => $this->role->paramsLevel()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(RoleRequest $request)
    {
        $this->role->doStore($request);
        return redirect()->route($this->pages['index'])->with('success', 'Data Role successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view($this->pages['folder'].'.show', [
            'pages'     => $this->pages,
            'data'      => $role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view($this->pages['folder'].'.edit', [
            'pages'     => $this->pages,
            'data'      => $role,
            'levels'    => $this->role->paramsLevel()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        $data = $this->role->doUpdate($request, $role);

        if($data == 'success'){
            return redirect()->back()->with('success', 'Data Successfully Updated!');
        } else {
            return redirect()->back()->with('error', 'Server Error !');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['success'=>true]);
    }
}
