<?php
return array(

    //////////////////////////////////////////////////////////////////////////////////////
    // Permissions for bms app
    //////////////////////////////////////////////////////////////////////////////////////
    'bms' => [
        [
            'name' => 'projects.all',
            'description' => 'Can see all projects'
        ],
        [
            'name' => 'projects.create',
            'description' => 'Create new project'
        ],
        [
            'name' => 'projects.update',
            'description' => 'Update projects'
        ],
        [
            'name' => 'departments.create',
            'description' => 'Create new departments'
        ],
        [
            'name' => 'departments.permissions',
            'description' => 'Update department permissions'
        ],
        [
            'name' => 'users.active',
            'description' => 'Accept and refuse users'
        ],
        [
            'name' => 'users.departments',
            'description' => 'Update user departments'
        ]
    ],


    //////////////////////////////////////////////////////////////////////////////////////
    // Permissions for site app
    //////////////////////////////////////////////////////////////////////////////////////
    'site' => [
        [
            'name' => 'site.all',
            'description' => 'Can edit site content'
        ]
    ]
);