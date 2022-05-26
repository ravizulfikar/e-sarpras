<?php

namespace App\Http\Controllers\ESarpras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ticket;
use App\Models\SignerTicket;
use App\Models\UserTicket;
use App\Models\Report;
use App\Models\Output;

use App\Http\Services\ESarpras\TicketServices;
use App\Http\Services\ESarpras\ReportServices;
use App\Http\Services\ESarpras\OutputServices;

class OutputController extends Controller
{
    private $pages = [
        'dashboard'     => 'index',
        'title'         => 'Generate Output Final',
        'folder'        => 'e-sarpras.output',
        'index'         => 'download.index',
        // 'create'        => [
        //     'url'       => 'download.downloadGenerate',
        //     'title'     => 'Create Generate Output Finasl',
        //     'store'     => 'download.downloadStore',
        // ],
        'generate'      => [
            'view'      => 'e-sarpras.output.generate',
            'title'     => 'Create Generate Output Final',
            'url'       => 'download.downloadGenerate',
            'store'     => 'download.downloadStore',
            'tickets'   => 'download.generate.tickets',
            'reports'   => 'download.generate.reports',
        ],
        // 'show'          => [
        //     'url'       => 'report.show',
        //     'title'     => 'Detail Report',
        // ],
        // 'edit'          => [
        //     'url'       => 'report.edit',
        //     'title'     => 'Edit Report',
        //     'update'    => 'report.update',
        // ],
        // 'destroy'       => 'report.destroy',
        
        // //
        // 'download'      => [
        //     'url'       => 'download.report',
        //     'title'     => 'Download Report',
        // ],

        // 'description'   => [
        //     'store'     => 'report.storeDescription',
        //     'update'    => 'report.updateDescription',
        //     'delete'    => 'report.deleteDescription',
        // ],

        // 'picture'       => [
        //     'store'     => 'report.storePicture',
        //     'update'    => 'report.updatePicture',
        //     'delete'    => 'report.deletePicture',
        //     'byPicture' => 'report.removeByPicture',
        // ],
    ];

    public function __construct(OutputServices $output)
    {
        $this->output = $output;
    }

    public function make($type, $id, $method = null)
    {
        return $this->output->renderOutput($type, $id, $method);
    }

    public function download()
    {
        if(in_array(auth()->user()->role->slug, ['superadmin'])) {
            $view = $this->pages['folder'].'.admin.index';
            $data = $this->output->mainAdmin();
        } else {
            $view = $this->pages['folder'].'.index';
            $data = $this->output->main();
        }

        return view($view, [
            'pages' => $this->pages, 
            'data'  => $data
        ]);
    }

    public function generate()
    {
        return view($this->pages['folder'].'.generate', [
            'pages'     => $this->pages,
            // 'levels'    => $this->report->paramsLevel()
        ]);
    }

    public function storeGenerate(Request $request)
    {
        $this->output->doStore($request);
        return redirect()->route($this->pages['index'])->with('success', 'Data Generator Output successfully added!');
    }

    public function tickets(Output $output, $month, $year){
        $filename = $this->output->generateTickets($output, $month, $year);
        $output->update(['tickets' => $filename]);
        return redirect()->back()->with('success', 'Generate Ticket '.$month.'-'.$year.' Successfully!');
    }

    public function reports(Output $output, $month, $year){
        $filename = $this->output->generateReports($output, $month, $year);
        $output->update(['reports' => $filename]);
        return redirect()->back()->with('success', 'Generate Reports '.$month.'-'.$year.' Successfully!');
    }
}
