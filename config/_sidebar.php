<?php
// Sidebar Menu

use Illuminate\Support\Facades\Route;
use App\Mixins\CountData;

return [

    'items' => [
        [
            'type'        => 'main-link',
            'badge'       => ['type' => 'danger', 'data' => CountData::getCount()],
            'icon'        => 'home',
            'title'       => 'Dashboard',
            'route'       => 'index',
            'role'        => ['superadmin']
        ],
        // Custom
        [
            'type'          => 'header',
            'title'         => 'General',
            'description'   => 'General Seetings',
            'role'          => ['superadmin'],
            'menu'          => [
                [
                    'type'        => 'main',
                    'badge'       => ['type' => 'danger', 'data' => CountData::getCount()],
                    'icon'        => 'home',
                    'title'       => 'Dashboard',
                    'route'       => 'index',
                    'role'        => ['superadmin']
                ],
                [
                    'type'        => 'submenu',
                    'badge'       => ['type' => 'success', 'data' => CountData::getKlasifikasi()],
                    'icon'        => 'home',
                    'title'       => 'Dashboard',
                    'prefix'      => 'dashboard',
                    'role'        => ['superadmin'],
                    'submenu'     => [
                        [
                            'title'       => 'Dashboard',
                            'route'       => 'index',
                            'role'        => ['superadmin'],
                        ],
                    ]
                ],
            ]
        ],
        [
            'type'          => 'header',
            'title'         => 'Superadmin Config',
            'description'   => 'Master, Module, User dan Role',
            'role'          => ['superadmin'],
            'menu'          => [
                [
                    'type'        => 'main',
                    'icon'        => 'user',
                    'title'       => 'Users',
                    'route'       => 'users.index',
                    'role'        => ['superadmin']
                ],
            ]
        ]
    ]

];
