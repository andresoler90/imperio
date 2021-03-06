<?php

return [
    'activated'        => true, // active/inactive all logging
    'middleware'       => ['web', 'auth','role:Administrador'],
    'route_path'       => 'admin/user-activity',
    'admin_panel_path' => '/',
    //'delete_limit'     => 7, // default 7 days

    'model' => [
        'user' => "App\User"
    ],

    'log_events' => [
        'on_create'     => false,
        'on_edit'       => true,
        'on_delete'     => true,
        'on_login'      => true,
        'on_lockout'    => true
    ]
];
