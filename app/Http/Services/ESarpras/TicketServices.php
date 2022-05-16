<?php

namespace App\Http\Services\ESarpras;

use App\Models\Ticket;
use App\Models\SignerTicket;
use App\Models\UserTicket;
use App\Models\Category;
use App\Models\User;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class TicketServices
{
    public function main()
    {
        return Ticket::all();
    }

    public function findBy($field, $id)
    {
        return Ticket::where($field, $id)->first();
    }

    public function findGetHistory($field, $id, $status)
    {
        return Ticket::with('SignerTickets')->whereIn($field, $id)->whereStatus($status)->get();
    }

    public function byStatus($status)
    {
        $Ticket = Ticket::with('SignerTickets')->whereIn('type', $this->checkAuth())->whereStatus($status);

        if($status == 'process' || $status == 'finish'){
            $UserTicket = UserTicket::whereUserId(auth()->user()->id)->get()->pluck('ticket_id');
            $data = $Ticket->whereIn('id', $UserTicket)->get();
        } else {
            $data = $Ticket->get();
        }

        return $data;
        // return Ticket::with('SignerTickets')->whereIn('type', $this->checkAuth())->whereStatus($status)->get();
    }

    public function checkAuth(){
        if(auth()->user()->role->slug == 'ta-teknisi'){
            return ["troubleshooting", "monitoring"];
        } else if(auth()->user()->role->slug == 'ta-asisten'){
            return ["server", "troubleshooting", "monitoring"];
        } else if(auth()->user()->role->slug == 'ta-admin'){
            return ["server"];
        } else {
            return ["server", "troubleshooting", "monitoring"];
        }
    }

    public function getUserProcess($id)
    {
        return UserTicket::whereTicketId($id)->get();
    }

    public function getFirstUserProcess($id)
    {
        return UserTicket::whereTicketId($id)->orderBy('id', "ASC")->first();
    }

    public function getSigner($id)
    {
        return SignerTicket::whereTicketId($id)->first();
    }

    public function signedTicket($request, $signer){
        $signer->update($request->all());

        return response()->json([
            'success'   => true,
            'message'   => 'Ticket has been signed !',
        ]);
    }

    public function AddUserTicket($request){
        $data = UserTicket::create(['ticket_id' => $request->ticket_id, 'user_id' => $request->user_id]);

        return response()->json([
            'success'   => true,
            'message'   => 'Add User Process Successfully!',
            'route'     => route('process.deleteUser', $data->id),
            'data'      => $data->id,
        ]);
    }

    public function DeleteUserTicket($UserTicket){
        $UserTicket->delete();

        return response()->json([
            'success'   => true,
            'message'   => 'User has been deleted successfully!',
        ]);
    }

    public function paramsUser($ticket)
    {
        $UserTicket = UserTicket::whereTicketId($ticket->id)->get()->pluck('user_id');

        if($ticket->type == 'monitoring' || $ticket->type == 'troubleshooting'){
            return User::whereIn('role_id', [7, 8])->whereNotIn('id', $UserTicket)->get();
        } else if($ticket->type == 'server'){
            return User::whereIn('role_id', [6, 7])->whereNotIn('id', $UserTicket)->get();
        } else {
            return User::whereIn('role_id', [6, 7, 8])->get();
        }
    }

    public function doUpdateProcess($request, $ticket) {
        $ticket->update($request->all());
        return "success";
    }

    public function ProcessFinish($ticket){
        return $ticket->update(['status' => 'finish']);
    }

    public function ProcessDelete($ticket){
        UserTicket::whereTicketId($ticket->id)->whereUserId(auth()->user()->id)->delete();
        return $ticket->update(['status' => 'entry']);
    }

    // public function doStore($request) {

    //     $role = Ticket::create($request->all());

    //     return $role;
    // }

    // public function doUpdate($request, $role) {

    //     $role->update($request->all());

    //     return "success";
    // }

    //Service to Client
    public function storeUser($request)
    {
        //Clean Array Null
        $locationNow        = $request['location'];
        foreach($locationNow as $key=>$value) {
            if(is_null($value) || $value == ''){
                unset($locationNow[$key]);
            }
        }

        $request['date']            = date('Y-m-d H:i:s');
        $request['source']          = 'base';
        $request['category']        = strtolower($request['category']);
        $request['location']        = json_encode($locationNow, true);
        $request['detail']          = json_encode($request['detail'], true);
        $request['status']          = 'entry';
        $request['verification']    = 'open';

        //Store to Ticket
        $Ticket = Ticket::create($request->all());
        
        //Store to Signer
        if($request['type'] == 'troubleshooting' || $request['type'] == 'monitoring'){
            $this->storeSigner($Ticket, $request);
        }

        //CheckCategory
        $this->checkCategory($request);

        // return $role;
        return response()->json([
            'success' => true,
            'message' => 'Data Successfully Synced!',
            'token'   => $request['token']
        ]);
    }

    public function storeSigner($Ticket, $request){
        $request['ticket_id']       = $Ticket->id;
        $request['date']            = $Ticket->date;
        $request['signer']          = $request['signer'];
        $request['type_identity']   = $request['type_identity'];
        $request['number_identity'] = $request['number_identity'];

        $Signer = SignerTicket::create($request->all());

        return $Signer;
    }

    public function checkCategory($request){
        $category = Category::where('name', strtolower($request['category']))->first();

        if(!empty($category)){
            return true;
        } else {
            return Category::create(["name" => strtolower($request['category'])]);
        }
    }

    public function assignTicket($ticket){
        $ticket->update(['status' => 'process']);
        $assign = UserTicket::create(['ticket_id' => $ticket->id, 'user_id' => auth()->user()->id]);
        return $assign;
    }
}
