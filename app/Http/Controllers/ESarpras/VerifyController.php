<?php

namespace App\Http\Controllers\ESarpras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ticket;
use App\Models\SignerTicket;
use App\Models\UserTicket;
use App\Models\Report;
use App\Http\Requests\ESarpras\TicketRequest;
use App\Http\Services\ESarpras\VerifyServices;

class VerifyController extends Controller
{
    private $pages = [
        'dashboard'     => 'index',
        'folder'        => 'e-sarpras.verify',
        'ticketing'     => [
            'view'          => 'e-sarpras.verify.ticketing.main',
            'title'         => 'Ticketing Verification',
            'index'         => 'ticketing.verify',
            'show'          => [
                'view'      => 'e-sarpras.verify.ticketing.view',
                'url'       => 'ticketing.verify.show',
                'title'     => 'Detail Ticket',
            ],
            'reSign'        => 'ticketing.verify.reSign',
            'verifyNow'     => 'ticketing.verify.verifyNow',
        ],
        'reporting'     => [
            'view'          => 'e-sarpras.verify.reporting.main',
            'title'         => 'Reporting Verification',
            'index'         => 'reporting.verify',
            'show'          => [
                'view'      => 'e-sarpras.verify.reporting.view',
                'url'       => 'reporting.verify.show',
                'title'     => 'Detail Report',
            ],
            'verifyNow'     => 'reporting.verify.verifyNow',
        ],
        // 'title'         => 'Role Management',
        // 'index'         => 'role.index',
        // 'create'        => [
        //     'url'       => 'role.create',
        //     'title'     => 'Create Role',
        //     'store'     => 'role.store',
        // ],
        // 'show'          => [
        //     'url'       => 'role.show',
        //     'title'     => 'Detail Role',
        // ],
        // 'edit'          => [
        //     'url'       => 'role.edit',
        //     'title'     => 'Edit Role',
        //     'update'    => 'role.update',
        // ],
        // 'destroy'       => 'role.destroy',
    ];

    public function __construct(VerifyServices $verify)
    {
        $this->verify = $verify;
    }
    
    public function ticketing(){
        if(in_array(auth()->user()->role->slug, ['kasatpel'])){
            $data = [
                'trouble_monit'     =>  $this->verify->mainTicket(['troubleshooting', 'monitoring'], ['open', 'kasatpel', 'kasubbag']),
                'server'            =>  $this->verify->mainTicket(['server'], ['open', 'kasatpel', 'kasubbag']),
            ];
        } else if(in_array(auth()->user()->role->slug, ['kasubbag'])){
            $data = [
                'trouble_monit'     =>  $this->verify->mainTicket(['troubleshooting', 'monitoring'], ['kasubbag', 'kasatpel']),
                'server'            =>  $this->verify->mainTicket(['server'], ['kasubbag', 'kasatpel']),
            ];
        } else {
            $data = [
                'trouble_monit'     =>  $this->verify->mainTicket(['troubleshooting', 'monitoring'], ['kasubbag']),
                'server'            =>  $this->verify->mainTicket(['server'], ['kasubbag']),
            ];
        }

        return view($this->pages['ticketing']['view'], [
            'pages' => $this->pages, 
            'data'  => $data,
        ]);
    }

    public function ticketingShow(Ticket $ticket)
    {
        return view($this->pages['ticketing']['show']['view'], [
            'pages'         => $this->pages,
            'data'          => $ticket,
            'userProcess'   => $this->verify->getUserProcess($ticket->id),
            'signer'        => $this->verify->getSigner($ticket->id),
        ]);
    }

    public function ticketReSign(Ticket $ticket)
    {
        return $this->verify->reSign($ticket);
    }
    
    public function ticketVerifyNow(Ticket $ticket)
    {
        if(in_array(auth()->user()->role->slug, ['kasatpel'])){
            $data = "kasatpel";
        } else if(in_array(auth()->user()->role->slug, ['kasubbag'])){
            $data = "kasubbag";
        } 

        $ticket->update(["verification" => $data]);
        return redirect()->back()->with('success', "Ticket has been verified!");
    }
    

    public function reporting(){
        if(in_array(auth()->user()->role->slug, ['kasatpel'])){
            $data = $this->verify->mainReport(['open', 'kasatpel', 'kasubbag', 'kabid']);
        } else if(in_array(auth()->user()->role->slug, ['kasubbag'])){
            $data = $this->verify->mainReport(['kasubbag', 'kasatpel', 'kabid']);
        } else if(in_array(auth()->user()->role->slug, ['kabid'])){
            $data = $this->verify->mainReport(['kasubbag', 'kabid']);
        } else {
            $data = $this->verify->mainReport(['kabid']);
        }

        return view($this->pages['reporting']['view'], [
            'pages' => $this->pages, 
            'data'  => $data,
        ]);
    }

    public function reportingShow(Report $report)
    {
        return view($this->pages['reporting']['show']['view'], [
            // 'pages'         => $this->pages,
            // 'data'          => $report,
            'pages'     => $this->pages,
            'data'      => $this->verify->showReport('id', $report->id),
            // 'userProcess'   => $this->verify->getUserProcess($report->id),
            // 'signer'        => $this->verify->getSigner($report->id),
        ]);
    }

    public function reportVerifyNow(Report $report)
    {
        if(in_array(auth()->user()->role->slug, ['kasatpel'])){
            $data = "kasatpel";
        } else if(in_array(auth()->user()->role->slug, ['kasubbag'])){
            $data = "kasubbag";
        } else if(in_array(auth()->user()->role->slug, ['kabid'])){
            $data = "kabid";
        }

        $report->update(["verification" => $data]);
        return redirect()->back()->with('success', "Ticket has been verified!");
    }
}
