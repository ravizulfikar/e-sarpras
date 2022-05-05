<?php

namespace App\Http\Controllers\ESarpras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Region;
use App\Http\Requests\ESarpras\RegionRequest;
use App\Http\Services\ESarpras\RegionServices;

class RegionController extends Controller
{
    private $pages = [
        'dashboard'     => 'index',
        'title'         => 'Region Management',
        'folder'        => 'e-sarpras.region',
        'index'         => 'region.index',
        'create'        => [
            'url'       => 'region.create',
            'title'     => 'Create Region',
            'store'     => 'region.store',
        ],
        'show'          => [
            'url'       => 'region.show',
            'title'     => 'Detail Region',
        ],
        'edit'          => [
            'url'       => 'region.edit',
            'title'     => 'Edit Region',
            'update'    => 'region.update',
        ],
        'destroy'       => 'region.destroy',
    ];

    public function __construct(RegionServices $region)
    {
        $this->region = $region;
    }

    public function index()
    {
        return view($this->pages['folder'].'.index', [
            'pages' => $this->pages, 
            'data'  => $this->region->main()
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
            'pages'       => $this->pages,
            'cities'      => $this->region->paramsCity(),
            'levels'      => $this->region->paramsLevelRegion()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(RegionRequest $request)
    {
        $this->region->doStore($request);
        return redirect()->route($this->pages['index'])->with('success', 'Data Region successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        return view($this->pages['folder'].'.show', [
            'pages'     => $this->pages,
            'data'      => $region
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        return view($this->pages['folder'].'.edit', [
            'pages'     => $this->pages,
            'data'      => $region,
            'cities'      => $this->region->paramsCity(),
            'levels'      => $this->region->paramsLevelRegion()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegionRequest $request, Region $region)
    {
        $data = $this->region->doUpdate($request, $region);

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
    public function destroy(Region $region)
    {
        $region->delete();
        return response()->json(['success'=>true]);
    }
}
