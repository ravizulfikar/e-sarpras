<?php

namespace App\Http\Controllers\ESarpras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Ticket;
use App\Models\SignerTicket;
use App\Models\UserTicket;
use App\Models\Report;

use App\Http\Services\ESarpras\TicketServices;
use App\Http\Services\ESarpras\ReportServices;
use App\Http\Services\ESarpras\OutputServices;

class OutputController extends Controller
{
    public function __construct(OutputServices $output)
    {
        $this->output = $output;
    }

    public function make($type, $id, $method = null)
    {
        return $this->output->renderOutput($type, $id, $method);
    }
}
