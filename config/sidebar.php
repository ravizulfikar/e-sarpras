<?php
// Sidebar Menu

use Illuminate\Support\Facades\Route;
use App\Mixins\CountData;

return [

    'items' => [
        [
            'type'        => 'main',
            'badge'       => ['type' => 'danger', 'data' => CountData::getCount()],
            'icon'        => 'home',
            'title'       => 'Dashboard',
            'route'       => 'index',
            'group'       => 'index',
            'role'        => ['superadmin']
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
            'title'         => 'Ticketing',
            'description'   => 'Local, Region, Server, Monitoring',
            'role'          => ['superadmin'],
        ],

            [
                'type'        => 'main',
                'badge'       => ['type' => 'warning', 'data' => CountData::getCount()],
                'icon'        => 'inbox',
                'title'       => 'Entry',
                'route'       => 'ticket.entry',
                'group'       => 'ticket.entry',
                'role'        => ['superadmin']
            ],

            [
                'type'        => 'main',
                'badge'       => ['type' => 'warning', 'data' => CountData::getCount()],
                'icon'        => 'list',
                'title'       => 'Process',
                'route'       => 'ticket.process',
                'group'       => 'ticket.process',
                'role'        => ['superadmin']
            ],

            [
                'type'        => 'main',
                'badge'       => ['type' => 'warning', 'data' => CountData::getCount()],
                'icon'        => 'check-circle',
                'title'       => 'Finish',
                'route'       => 'ticket.finish',
                'group'       => 'ticket.finish',
                'role'        => ['superadmin']
            ],
        
        //Reporting
        [
            'type'          => 'header',
            'title'         => 'Reporting',
            'description'   => 'Report of Ticketing',
            'role'          => ['superadmin'],
        ],
            [
                'type'        => 'main',
                'badge'       => ['type' => 'warning', 'data' => CountData::getCount()],
                'icon'        => 'edit',
                'title'       => 'Daily',
                'route'       => 'report.daily',
                'group'       => 'report.daily',
                'role'        => ['superadmin']
            ],

            [
                'type'        => 'main',
                'badge'       => ['type' => 'warning', 'data' => CountData::getCount()],
                'icon'        => 'image',
                'title'       => 'Picture',
                'route'       => 'report.pictures',
                'group'       => 'report.pictures',
                'role'        => ['superadmin']
            ],

            [
                'type'        => 'main',
                'badge'       => ['type' => 'success', 'data' => CountData::getCount()],
                'icon'        => 'download',
                'title'       => 'Download',
                'route'       => 'report.download',
                'group'       => 'report.download',
                'role'        => ['superadmin']
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
                'route'       => 'user.index',
                'group'       => 'user',
                'role'        => ['superadmin']
            ],

            [
                'type'        => 'main',
                // 'badge'       => ['type' => 'info', 'data' => CountData::getCount()],
                'icon'        => 'command',
                'title'       => 'Role',
                'route'       => 'role.index',
                'group'       => 'role',
                'role'        => ['superadmin']
            ],

            [
                'type'        => 'main',
                // 'badge'       => ['type' => 'success', 'data' => CountData::getCount()],
                'icon'        => 'target',
                'title'       => 'Regional Unit',
                'route'       => 'region.index',
                'group'       => 'region',
                'role'        => ['superadmin']
            ],

            [
                'type'        => 'main',
                'badge'       => ['type' => 'warning', 'data' => CountData::getCount()],
                'icon'        => 'calendar',
                'title'       => 'Holiday',
                'route'       => 'holiday.index',
                'group'       => 'holiday',
                'role'        => ['superadmin']
            ],
    ]


];
