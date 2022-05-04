<?php

namespace App\Http\Controllers\ESarpras;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Requests\ESarpras\UserRequest;
use App\Http\Requests\ESarpras\User\Store as UserStore;
use App\Http\Requests\ESarpras\User\Update as UserUpdate;
use App\Http\Services\ESarpras\UserServices;

class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $pages = [
        'dashboard'     => 'index',
        'title'         => 'User Management',
        'folder'        => 'e-sarpras.user',
        'index'         => 'user.index',
        'create'        => [
            'url'       => 'user.create',
            'title'     => 'Create User',
            'store'     => 'user.store',
        ],
        'show'          => [
            'url'       => 'user.show',
            'title'     => 'Detail User',
        ],
        'edit'          => [
            'url'       => 'user.edit',
            'title'     => 'Edit User',
            'update'    => 'user.update',
        ],
        'destroy'       => 'user.destroy',
    ];

    public function __construct(UserServices $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return view($this->pages['folder'].'.index', [
            'pages' => $this->pages, 
            'data'  => $this->user->main()
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
            'roles'     => $this->user->paramsRole()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(UserStore $request)
    {
        $this->user->doStore($request);
        return redirect()->route($this->pages['index'])->with('success', 'Data User successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view($this->pages['folder'].'.show', [
            'pages'     => $this->pages,
            'data'      => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view($this->pages['folder'].'.edit', [
            'pages'     => $this->pages,
            'data'      => $user,
            'roles'     => $this->user->paramsRole()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdate $request, User $user)
    {
        $data = $this->user->doUpdate($request, $user);

        if($data == 'email'){
            return redirect()->back()->with('error', 'Email has already been taken. Please use another Email!');
        } else if($data == 'username'){
            return redirect()->back()->with('error', 'Username has already been taken. Please use another Username!');
        } else {
            return redirect()->back()->with('success', 'Data User successfully update!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success'=>true]);
    }

    //Account Edit
    public function account($username)
    {
        return view($this->pages['folder'].'.account.show', [
            'pages'     => $this->pages,
            'data'      => $this->user->findBy('username', $username)
        ]);
    }

    public function account_edit($username)
    {
        return view($this->pages['folder'].'.account.edit', [
            'pages'     => $this->pages,
            'data'      => $this->user->findBy('username', $username),
            'roles'     => $this->user->paramsRole()
        ]);
    }
}
