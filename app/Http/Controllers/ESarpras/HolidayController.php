<?php

namespace App\Http\Controllers\ESarpras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Holiday;
use App\Http\Requests\ESarpras\HolidayRequest;
use App\Http\Services\ESarpras\HolidayServices;

class HolidayController extends Controller
{
    private $pages = [
        'dashboard'     => 'index',
        'title'         => 'Holiday Management',
        'folder'        => 'e-sarpras.holiday',
        'index'         => 'holiday.index',
        'create'        => [
            'url'       => 'holiday.create',
            'title'     => 'Create Holiday',
            'store'     => 'holiday.store',
        ],
        'show'          => [
            'url'       => 'holiday.show',
            'title'     => 'Detail Holiday',
        ],
        'edit'          => [
            'url'       => 'holiday.edit',
            'title'     => 'Edit Holiday',
            'update'    => 'holiday.update',
        ],
        'destroy'       => 'holiday.destroy',
    ];

    public function __construct(HolidayServices $holiday)
    {
        $this->holiday = $holiday;
    }

    public function index()
    {
        return view($this->pages['folder'].'.index', [
            'pages' => $this->pages, 
            'data'  => $this->holiday->main()
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
            'pages'     => $this->pages
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(HolidayRequest $request)
    {
        $this->holiday->doStore($request);
        return redirect()->route($this->pages['index'])->with('success', 'Data successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Holiday $holiday)
    {
        return view($this->pages['folder'].'.show', [
            'pages'     => $this->pages,
            'data'      => $holiday
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Holiday $holiday)
    {
        return view($this->pages['folder'].'.edit', [
            'pages'     => $this->pages,
            'data'      => $holiday
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HolidayRequest $request, Holiday $holiday)
    {
        $data = $this->holiday->doUpdate($request, $holiday);

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
    public function destroy(Holiday $holiday)
    {
        $holiday->delete();
        return response()->json(['success'=>true]);
    }

    public function synchronizeData(){

        $data = $this->holiday->sync();
        
        if($data->original['success'] == true){
            return redirect()->back()->with('success', $data->original['message']);
        } else {
            return redirect()->back()->with('error', $data->original['message']);
        }
        
    }
}
