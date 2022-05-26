<?php

namespace App\Http\Services\ESarpras;

use App\Models\Ticket;
use App\Models\Report;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class DashboardServices
{
    public function countByStatus($status)
    {
        if($status == 'all'){
            return Ticket::count();
        } else {
            return Ticket::whereStatus($status)->count();
        }
    }

    public function countByType($type)
    {
        if($type == 'all'){
            return Ticket::count();
        } else {
            return Ticket::whereType($type)->count();
        }
    }
}
