<?php

namespace App\Http\Controllers\ESarpras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Services\ESarpras\DashboardServices;

class DashboardController extends Controller
{
    private $pages = [
        'dashboard'         => 'index',
        'title'             => 'Dashboard',
        'folder'            => 'e-sarpras.dashboard'
    ];

    public function __construct(DashboardServices $dashboard)
    {
        $this->dashboard = $dashboard;
    }

    public function main(){
        return view($this->pages['folder'].'.index', [
            'pages'             => $this->pages,
            'all'               => $this->dashboard->countByStatus('all'),
            'open'              => $this->dashboard->countByStatus('open'),
            'process'           => $this->dashboard->countByStatus('process'),
            'finish'            => $this->dashboard->countByStatus('finish'),
            'troubleshooting'   => $this->dashboard->countByType('troubleshooting'),
            'monitoring'        => $this->dashboard->countByType('monitoring'),
            'server'            => $this->dashboard->countByType('server'),
        ]);
    }
}
