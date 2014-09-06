<?php

//16
$tables = [

    'users',
    'departments',
    'user_department',
    'department_permissions',
    'user_personal_info',
    'user_work_info',
    'user_contact_info',
    'drives',
    'files',
    'file_drive',
    'projects',
    'project_stages',
    'project_comments',
    'project_comment_file',
    'project_stage_file',
    'project_user'
];


foreach($tables as $table) {

    exec('php artisan migrate:make create_'.$table.'_table --create='.$table);
}