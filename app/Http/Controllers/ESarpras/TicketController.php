<?php

namespace App\Http\Controllers\ESarpras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ticket;
use App\Models\SignerTicket;
use App\Models\UserTicket;
use App\Http\Requests\ESarpras\TicketRequest;
use App\Http\Services\ESarpras\TicketServices;

class TicketController extends Controller
{
    private $pages = [
        'dashboard'     => 'index',
        //Entry
        'entry'         => [
            'title'     => 'Entry Ticket',
            'url'       => 'entry.ticket',
            'index'     => 'e-sarpras.ticket.entry',
            'update'    => 'entry.update',
        ],
        'process' => [
            'title'     => 'Process Ticket',
            'url'       => 'process.ticket',    
            'index'     => 'e-sarpras.ticket.process',
            'update'    => 'process.update',
            'edit'      => 'process.edit',
            'viewEdit'  => 'e-sarpras.ticket.process_edit',
            'titleEdit' => 'Process Ticket Update',
            'finish'    => 'process.finish',
            'delete'    => 'process.delete',
        ],
        // 'finish'         => [
        //     'title'     => 'Finish Ticket',
        //     'url'       => 'ticket.index',
        //     'index'     => 'e-sarpras.ticket.finish',
        //     'view'      => 'finish.view',
        // ],

        //
        'main'          => [
            'title'     => 'Ticket Management',
            'url'       => 'ticket.index',
            'index'     => 'e-sarpras.ticket.index',
            
            // 'create'    => 'e-sarpras.ticket.create',
            // 'edit'      => 'e-sarpras.ticket.edit',
            // 'update'    => 'e-sarpras.ticket.update',
            // 'delete'    => 'e-sarpras.ticket.delete',
        ],
        // 'title'         => 'Ticket Management',
        // 'folder'        => 'e-sarpras.ticket',
        // 'index'         => 'ticket.index',
        // 'create'        => [
        //     'url'       => 'ticket.create',
        //     'title'     => 'Create ticket',
        //     'store'     => 'ticket.store',
        // ],
        'show'          => [
            'url'       => 'ticket.show',
            'title'     => 'Detail ticket',
            'view'      => 'e-sarpras.ticket.view',
            'viewAdmin' => 'e-sarpras.ticket.admin.finish_view',
            'update'    => 'ticket.update',
            'deleteUser'=> 'process.deleteUser',
        ],
        // 'edit'          => [
        //     'url'       => 'ticket.edit',
        //     'title'     => 'Edit ticket',
        //     'update'    => 'ticket.update',
        // ],
        'destroy'       => 'ticket.destroy',
        'reset'         => 'ticket.reset',

        //Client
        'createUser'        => [
            'title'         => 'Create Your Ticket',
            'description'   => 'Enter your Trouble details to create ticket',
            'store'         => 'ticket.storeUser',
            'sign'          => 'ticket.signUser',
            'updateSign'    => 'ticket.updateSignUser'
        ],

        //Admin
        'admin' => [
            'url'           => 'entry.admin.ticket',
            'title'         => 'Ticket On Process',
            'index'         => 'e-sarpras.ticket.admin.onprocess_main',
            'indexFinish'   => 'e-sarpras.ticket.admin.finish_main',
            'view'          => [
                'url'       => 'entry.admin.view',
                'index'     => 'e-sarpras.ticket.admin.onprocess_view',
                'title'     => 'Detail ticket',
            ],
            'finish'        => [
                'url'       => 'entry.admin.view',
                'index'     => 'e-sarpras.ticket.admin.finish_view',
                'title'     => 'Detail ticket',
            ],
            
        ],
    ];

    public function __construct(TicketServices $ticket)
    {
        $this->ticket = $ticket;
    }


    public function entry()
    {
        return view($this->pages['entry']['index'], [
            'pages' => $this->pages,
            'data'  => $this->ticket->byStatus('entry'),
        ]);
    }

    public function entry_update(Ticket $ticket)
    {
        $this->ticket->assignTicket($ticket);
        return redirect()->route('process.ticket')->with('success', 'Ticket in Process !');
    }

    public function entry_view(Ticket $ticket)
    {
        return view($this->pages['entry']['viewAdmin']['index'], [
            'pages'         => $this->pages,
            'data'          => $ticket,
            'userProcess'   => $this->ticket->getUserProcess($ticket->id),
            'signer'        => $this->ticket->getSigner($ticket->id),
        ]);
    }

    public function process()
    {
        return view($this->pages['process']['index'], [
            'pages' => $this->pages,
            'data'  => $this->ticket->byStatus('process'),
        ]);
    }

    public function process_update(Request $request, Ticket $ticket)
    {
        $data = $this->ticket->doUpdateProcess($request, $ticket);

        if($data == 'success'){
            return redirect()->back()->with('success', 'Data Ticket Successfully Updated!');
        } else {
            return redirect()->back()->with('error', 'Server Error !');
        }

    }

    public function process_edit(Ticket $ticket)
    {
        return view($this->pages['process']['viewEdit'], [
            'pages'         => $this->pages,
            'data'          => $ticket,
            'userProcess'   => $this->ticket->getUserProcess($ticket->id),
            'firstUser'     => $this->ticket->getFirstUserProcess($ticket->id),
            'signer'        => $this->ticket->getSigner($ticket->id),
            'paramsUser'    => $this->ticket->paramsUser($ticket),
        ]);
    }

    public function process_finish(Ticket $ticket)
    {
        $this->ticket->ProcessFinish($ticket);
        return redirect()->route('ticket.index')->with('success', 'Ticket Finish !');
    }

    public function process_delete(Ticket $ticket)
    {
        $this->ticket->ProcessDelete($ticket);
        return redirect()->back()->with('success', 'Ticket Successfully Delete for You!');
    }

    public function signed_ticket(Request $request, SignerTicket $signer){
        return $this->ticket->signedTicket($request, $signer);
    }

    public function add_user_ticket(Request $request){
        return $this->ticket->AddUserTicket($request);
    }

    public function delete_user_ticket(UserTicket $UserTicket){
        return $this->ticket->DeleteUserTicket($UserTicket);
    }

    //Finish

    // public function finish()
    // {
    //     return view($this->pages['finish']['index'], [
    //         'pages' => $this->pages,
    //         'data'  => $this->ticket->byStatus('finish'),
    //     ]);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        if(in_array(auth()->user()->role->slug, ['superadmin', 'admin'])){
            $view = $this->pages['admin']['indexFinish'];
            $data = [
                'trouble_monit'       =>  $this->ticket->byType(['troubleshooting', 'monitoring'], ['finish']),
                'server'              =>  $this->ticket->byType(['server'], ['finish']),
            ];
        } else {
            $view = $this->pages['main']['index'];
            $data = $this->ticket->byStatus('finish');
        }
        
        return view($view, [
            'pages' => $this->pages, 
            'data'  => $data,
        ]);
    }

    public function show(Ticket $ticket)
    {
        if(in_array(auth()->user()->role->slug, ['superadmin', 'admin'])){
            $view = $this->pages['show']['viewAdmin'];
        } else {
            $view = $this->pages['show']['view'];
        }

        return view($view, [
            'pages'         => $this->pages,
            'data'          => $ticket,
            'userProcess'   => $this->ticket->getUserProcess($ticket->id),
            'firstUser'     => $this->ticket->getFirstUserProcess($ticket->id),
            'signer'        => $this->ticket->getSigner($ticket->id),
            'paramsUser'    => $this->ticket->paramsUser($ticket),
            'typeTicket'    => RenderParams('type-ticket'),
            'location'      => RenderParams('location'),
            'floorUnit'     => RenderParams('floor-unit'),
            'categorys'     => ParamsCategory(),
            'identityType'  => RenderParams('identity-type'),
        ]);
    }

    public function update(Request $request, Ticket $ticket)
    {
        $data = $this->ticket->doUpdateProcess($request, $ticket);

        if($data == 'success'){
            return redirect()->back()->with('success', 'Data Ticket Successfully Updated!');
        } else {
            return redirect()->back()->with('error', 'Server Error !');
        }

    }

    
    // public function create()
    // {
    //     return view($this->pages['folder'].'.create', [
    //         'pages'     => $this->pages,
    //     ]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // public function store(TicketRequest $ticket)
    // {
    //     $this->ticket->doStore($request);
    //     return redirect()->route($this->pages['index'])->with('success', 'Data Role successfully added!');
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit(Ticket $ticket)
    // {
    //     return view($this->pages['folder'].'.edit', [
    //         'pages'     => $this->pages,
    //         'data'      => $ticket
    //     ]);
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(TicketRequest $request, Ticket $ticket)
    // {
    //     $data = $this->ticket->doUpdate($request, $ticket);

    //     if($data == 'success'){
    //         return redirect()->back()->with('success', 'Data Successfully Updated!');
    //     } else {
    //         return redirect()->back()->with('error', 'Server Error !');
    //     }

    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return response()->json(['success'=>true]);
    }

    public function reset($ticket)
    {
        $this->ticket->resetTicket($ticket);
        return response()->json(['success'=>true]);
    }


    //Client
    public function createUser()
    {
        return view('e-sarpras.create-ticket', [
            'pages'         => $this->pages,
            'token'         => TokenCreate(),
            'typeTicket'    => RenderParams('type-ticket'),
            'location'      => RenderParams('location'),
            'floorUnit'     => RenderParams('floor-unit'),
            'categorys'     => ParamsCategory(),
            'identityType'  => RenderParams('identity-type'),
        ]);
    }

    public function storeUser(TicketRequest $request)
    {
        $data = $this->ticket->storeUser($request);

        if($data->original['success'] == true){
            return redirect()->route('ticket.historyUser')->with('success', 'Ticket Successfully Created!');
        } else {
            return redirect()->back()->with('error', 'Server Error !');
        }

    }

    public function historyUser()
    {
        return view('e-sarpras.history-ticket', [
            'pages'         => $this->pages,
            'token'         => TokenCreate(),
            'typeTicket'    => RenderParams('type-ticket'),
            'location'      => RenderParams('location'),
            'floorUnit'     => RenderParams('floor-unit'),
            'categorys'     => ParamsCategory(),
            'identityType'  => RenderParams('identity-type'),
        ]);
    }

    public function historyGetUser(Request $request)
    {
        
        $data['open']       = $this->ticket->findGetHistory('token',$request->items, 'entry');
        $data['process']    = $this->ticket->findGetHistory('token',$request->items, 'process');
        $data['finish']     = $this->ticket->findGetHistory('token',$request->items, 'finish');

        return response()->json([
            "success"   => true,
            "data"      => $data 
        ]);
    }

    public function signUser(Ticket $ticket)
    {
        $checkSign = SignerTicket::whereTicketId($ticket->id)->first();

        if(!empty($checkSign->sign)){
            return redirect(url('/'))->with('warning', 'Ticket Already signed!');
        }

        return view('e-sarpras.sign-ticket', [
            'pages'         => $this->pages,
            'data'          => $ticket,
            'userProcess'   => $this->ticket->getUserProcess($ticket->id),
            'firstUser'     => $this->ticket->getFirstUserProcess($ticket->id),
            'signer'        => $this->ticket->getSigner($ticket->id),
            'paramsUser'    => $this->ticket->paramsUser($ticket),
            'typeTicket'    => RenderParams('type-ticket'),
            'location'      => RenderParams('location'),
            'floorUnit'     => RenderParams('floor-unit'),
            'categorys'     => ParamsCategory(),
            'identityType'  => RenderParams('identity-type'),
        ]);
    }

    public function updateSignUser(Request $request, SignerTicket $signer){
        return $this->ticket->signedTicket($request, $signer);
    }




    //Admin
    public function admin_main()
    {
        return view($this->pages['admin']['index'], [
            'pages' => $this->pages,
            'data'  => [
                'trouble_monit'       =>  $this->ticket->byType(['troubleshooting', 'monitoring'], ['entry', 'process']),
                'server'              =>  $this->ticket->byType(['server'], ['entry', 'process']),
            ],
        ]);
    }

    public function admin_view(Ticket $ticket)
    {
        return view($this->pages['admin']['view']['index'], [
            'pages'         => $this->pages,
            'data'          => $ticket,
            'userProcess'   => $this->ticket->getUserProcess($ticket->id),
            'firstUser'     => $this->ticket->getFirstUserProcess($ticket->id),
            'signer'        => $this->ticket->getSigner($ticket->id),
            'paramsUser'    => $this->ticket->paramsUser($ticket),
        ]);
    }
}
