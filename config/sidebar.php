<?php
// Sidebar Menu

use Illuminate\Support\Facades\Route;
use App\Mixins\CountData;
// use App\Models\Ticket;
// use App\Http\Services\ESarpras\TicketServices;

// $CountEntry = CountData::getCountDataByStatus('entry');
// $CountProcess = CountData::getCountDataByStatus('process');
// $CountFinish = CountData::getCountDataByStatus('finish');

// $CountEntry = TicketCount('entry');
// $CountProcess = TicketCount('process');
// $CountFinish = TicketCount('finish');

return [

    'items' => [
        [
            'type'        => 'main',
            // 'badge'       => ['type' => 'danger', 'data' => CountData::getCount()],
            'icon'        => 'home',
            'title'       => 'Dashboard',
            'route'       => ['name' => 'index'],
            'group'       => 'index',
            'role'        => ['superadmin', 'kabid', 'kasubbag', 'kasatpel', 'staff', 'ta-teknisi', 'ta-admin', 'ta-asisten']
        ],

        // [
        //     'type'        => 'submenu',
        //     'badge'       => ['type' => 'success', 'data' => CountData::getKlasifikasi()],
        //     'icon'        => 'home',
        //     'title'       => 'Dashboard',
        //     'group'      => 'dashboard',
        //     'role'        => ['superadmin'],
        //     'submenu'     => [
        //         [
        //             'title'       => 'Dashboard',
        //             'route'       => 'index',
        //             'role'        => ['superadmin'],
        //         ],
        //     ]
        // ],
        // Custom
        //Ticketing
        [
            'type'          => 'header',
            'title'         => 'Verification',
            'description'   => 'Ticketing and Reporting',
            'role'          => ['kasubbag', 'kasatpel'],
        ],
            [
                'type'        => 'main',
                // 'badge'       => ['type' => 'warning', 'data' => $CountEntry ],
                'icon'        => 'bookmark',
                'title'       => 'Ticketing',
                'route'       => ['name' => 'ticketing.verify'],
                'group'       => 'ticketing',
                'role'        => ['kasubbag', 'kasatpel'],
            ],

            [
                'type'        => 'main',
                // 'badge'       => ['type' => 'warning', 'data' => $CountEntry ],
                'icon'        => 'book',
                'title'       => 'Reporting',
                'route'       => ['name' => 'reporting.verify'],
                'group'       => 'reporting',
                'role'        => ['kasubbag', 'kasatpel'],
            ],


        //Ticketing
        [
            'type'          => 'header',
            'title'         => 'Ticketing',
            'description'   => 'Troubleshooting, Server, Monitoring',
            'role'          => ['superadmin', 'ta-teknisi', 'ta-admin', 'ta-asisten', 'kabid', 'kasubbag', 'kasatpel', 'staff'],
        ],

            [
                'type'        => 'main',
                // 'badge'       => ['type' => 'warning', 'data' => $CountEntry ],
                'icon'        => 'inbox',
                'title'       => 'Entry',
                'route'       => ['name' => 'entry.ticket'],
                'group'       => 'entry',
                'role'        => ['ta-teknisi', 'ta-admin', 'ta-asisten']
            ],

            [
                'type'        => 'main',
                // 'badge'       => ['type' => 'primary', 'data' => $CountProcess ],
                'icon'        => 'list',
                'title'       => 'Process',
                'route'       => ['name' => 'process.ticket'],
                'group'       => 'process',
                'role'        => ['ta-teknisi', 'ta-admin', 'ta-asisten']
            ],

            [
                'type'        => 'main',
                // 'badge'       => ['type' => 'success', 'data' => $CountFinish],
                'icon'        => 'check-circle',
                'title'       => 'Finish',
                'route'       => ['name' => 'ticket.index'],
                'group'       => 'ticket',
                'role'        => ['ta-teknisi', 'ta-admin', 'ta-asisten']
            ],

            //Admin
            [
                'type'        => 'main',
                // 'badge'       => ['type' => 'warning', 'data' => $CountEntry ],
                'icon'        => 'inbox',
                'title'       => 'On Process',
                'route'       => ['name' => 'entry.admin.ticket'],
                'group'       => 'entry',
                'role'        => ['superadmin', 'kabid', 'kasubbag', 'kasatpel', 'staff']
            ],

            [
                'type'        => 'main',
                // 'badge'       => ['type' => 'success', 'data' => $CountFinish],
                'icon'        => 'check-circle',
                'title'       => 'Data',
                'route'       => ['name' => 'ticket.index'],
                'group'       => 'ticket',
                'role'        => ['superadmin', 'kabid', 'staff']
            ],
        
        //Reporting
        [
            'type'          => 'header',
            'title'         => 'Reporting',
            'description'   => 'Report of Ticketing',
            'role'          => ['superadmin', 'ta-teknisi', 'ta-admin', 'ta-asisten'],
        ],
            [
                'type'        => 'main',
                // 'badge'       => ['type' => 'warning', 'data' => CountData::getCount()],
                'icon'        => 'edit',
                'title'       => 'Activity',
                // 'route'       => 'report.daily',
                'route'       => ['name' => 'report.index'],
                'group'       => 'report',
                'role'        => ['ta-teknisi', 'ta-admin', 'ta-asisten']
            ],

            // [
            //     'type'        => 'main',
            //     // 'badge'       => ['type' => 'warning', 'data' => CountData::getCount()],
            //     'icon'        => 'image',
            //     'title'       => 'Picture',
            //     // 'route'       => 'report.pictures',
            //     'route'       => ['name' => 'report.pictures'],
            //     'group'       => 'report.pictures',
            //     'role'        => ['ta-teknisi', 'ta-admin', 'ta-asisten']
            // ],

            [
                'type'        => 'main',
                // 'badge'       => ['type' => 'success', 'data' => CountData::getCount()],
                'icon'        => 'download',
                'title'       => 'Download',
                // 'route'       => 'report.download',
                'route'       => ['name' => 'download.report'],
                'group'       => 'download',
                'role'        => ['superadmin','ta-teknisi', 'ta-admin', 'ta-asisten']
            ],

        //Configuration
        [
            'type'          => 'header',
            'title'         => 'Configuration',
            'description'   => 'Users, Role, Region, Holiday',
            'role'          => ['superadmin'],
        ],

            [
                'type'        => 'main',
                // 'badge'       => ['type' => 'danger', 'data' => CountData::getCount()],
                'icon'        => 'users',
                'title'       => 'Users',
                'route'       => ['name' => 'user.index'],
                'group'       => 'user',
                'role'        => ['superadmin']
            ],

            [
                'type'        => 'main',
                // 'badge'       => ['type' => 'info', 'data' => CountData::getCount()],
                'icon'        => 'command',
                'title'       => 'Role',
                'route'       => ['name' => 'role.index'],
                'group'       => 'role',
                'role'        => ['superadmin']
            ],

            [
                'type'        => 'main',
                // 'badge'       => ['type' => 'success', 'data' => CountData::getCount()],
                'icon'        => 'target',
                'title'       => 'Regional Unit',
                'route'       => ['name' => 'region.index'],
                'group'       => 'region',
                'role'        => ['superadmin']
            ],

            [
                'type'        => 'main',
                // 'badge'       => ['type' => 'warning', 'data' => CountData::getCount()],
                'icon'        => 'calendar',
                'title'       => 'Holiday',
                'route'       => ['name' => 'holiday.index'],
                'group'       => 'holiday',
                'role'        => ['superadmin']
            ],
    ]


];
