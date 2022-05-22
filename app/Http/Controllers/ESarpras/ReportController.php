<?php

namespace App\Http\Controllers\ESarpras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Report;
use App\Models\ReportDescription;
use App\Models\ReportPicture;

use App\Http\Requests\ESarpras\ReportRequest;
use App\Http\Services\ESarpras\ReportServices;

class ReportController extends Controller
{
    private $pages = [
        'dashboard'     => 'index',
        'title'         => 'Report Activity',
        'folder'        => 'e-sarpras.report',
        'index'         => 'report.index',
        'create'        => [
            'url'       => 'report.create',
            'title'     => 'Create Report',
            'store'     => 'report.store',
        ],
        'generate'      => [
            'url'       => 'report.generate',
            'title'     => 'Generate Report',
            'store'     => 'report.generateStore',
        ],
        'show'          => [
            'url'       => 'report.show',
            'title'     => 'Detail Report',
        ],
        'edit'          => [
            'url'       => 'report.edit',
            'title'     => 'Edit Report',
            'update'    => 'report.update',
        ],
        'destroy'       => 'report.destroy',
        
        //
        'download'      => [
            'url'       => 'download.report',
            'title'     => 'Download Report',
        ],

        'description'   => [
            'store'     => 'report.storeDescription',
            'update'    => 'report.updateDescription',
            'delete'    => 'report.deleteDescription',
        ],

        'picture'       => [
            'store'     => 'report.storePicture',
            'update'    => 'report.updatePicture',
            'delete'    => 'report.deletePicture',
            'byPicture' => 'report.removeByPicture',
        ],
    ];

    public function __construct(ReportServices $report)
    {
        $this->report = $report;
    }

    public function index()
    {
        return view($this->pages['folder'].'.index', [
            'pages' => $this->pages, 
            'data'  => $this->report->main()
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
            'levels'    => $this->report->paramsLevel()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(ReportRequest $request)
    {
        $this->report->doStore($request);
        return redirect()->route($this->pages['index'])->with('success', 'Data report successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Report $report)
    {
        return view($this->pages['folder'].'.show', [
            'pages'     => $this->pages,
            'data'      => $this->report->findBy('id', $report->id),
            'paramsDesc'=> $this->report->paramsDescription(),
            // 'paramsPic' => $this->report->paramsPicture(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        return view($this->pages['folder'].'.edit', [
            'pages'     => $this->pages,
            'data'      => $report,
            'levels'    => $this->report->paramsLevel()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReportRequest $request, Report $report)
    {
        $data = $this->report->doUpdate($request, $report);

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
    public function destroy(Report $report)
    {
        $this->report->deleteDescription($report);
        $this->report->deletePicture($report);
        $report->delete();

        return response()->json(['success'=>true]);
    }


    //Generate
    public function generate()
    {
        return view($this->pages['folder'].'.generate', [
            'pages'     => $this->pages
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function generateStore(ReportRequest $request)
    {
        $data = $this->report->doStoreGenerate($request);
        
        if($data->original['success'] == true){
            return redirect()->route($this->pages['index'])->with('success', $data->original['message']);
        } else {
            return redirect()->route($this->pages['index'])->with('error', $data->original['message']);
        }
        // return redirect()->route($this->pages['index'])->with('success', 'Data report successfully generate!');
    }

    //Description
    public function storeDescription($id, Request $request)
    {
        return $this->report->doStoreDescription($id, $request);
    }


    public function updateDescription(Request $request, ReportDescription $report_description)
    {
        $report_description->update($request->all());

        if($report_description){
            return redirect()->back()->with('success', 'Data Successfully Updated!');
        } else {
            return redirect()->back()->with('error', 'Server Error !');
        }

    }

    public function deleteDescription(ReportDescription $report_description)
    {
        $report_description->delete();

        return response()->json(['success'=>true]);
    }

     //Picture
     public function storePicture($id, Request $request)
     {
        return $this->report->doStorePicture($id, $request);
     }
 
 
    public function updatePicture(Request $request, ReportPicture $report_picture)
    {
        return $this->report->doUpdatePicture($report_picture->id, $request);
    }
 
    public function deletePicture(ReportPicture $report_picture)
    {
        $this->report->PictureRemoves($report_picture);
        $report_picture->delete();
        return response()->json(['success'=>true]);
    }

    public function uploadPicture(Request $request){
        return $this->report->tmpFileUpload($request);
    }

    public function removePicture(Request $request){
        return $this->report->tmpFileRemove($request);
    }

    public function removeByPicture(ReportPicture $report_picture, $name){
        return $this->report->removeByPicture($report_picture, $name);
        // return response()->json(['success'=>true]);
    }
}
