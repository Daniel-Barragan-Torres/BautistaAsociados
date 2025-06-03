<?php

return [
    'Admin' => [
        'can_view_users' => true,
        'can_edit_users' => true,
        'can_delete_users' => true,
        'can_view_citas' => true,
        'can_edit_citas' => true,
        'can_manage_settings' => true,
    ],

    'Asistente' => [
        'can_view_users' => false,
        'can_edit_users' => false,
        'can_delete_users' => false,
        'can_view_citas' => true,
        'can_edit_citas' => true,
        'can_manage_settings' => false,
    ],

    'Empleado' => [ // solo si lo usas
        'can_view_users' => false,
        'can_edit_users' => false,
        'can_delete_users' => false,
        'can_view_citas' => false,
        'can_edit_citas' => false,
        'can_manage_settings' => false,
    ],
];
