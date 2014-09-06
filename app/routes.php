<?php

/**
 * @var ApiRouter $api
 */
$api = App::make('ApiRouter');


Route::get('/api/asdf', function() {
    return Validator::make(array(
        'email' => 'kareem3d.a2'
    ), array(
        'email' => 'email'
    ))->messages();
});

Route::get('/api/kemo', function() {

    dd(\Drive\File::find(5)->save());

});

$api->prefix('/api');

$api->controller('UserController');
$api->get('users')->action('getAll')->permissions('authenticated')->register();
$api->get('users/me')->action('getMe')->permissions('authenticated')->register();
$api->get('users/new')->action('getNew')->permissions('authenticated')->register();
$api->put('users/check-in')->action('checkUserIn')->permissions('authenticated')->register();
$api->put('users/profile-image')->action('updateProfileImage')->permissions('authenticated')->register();
$api->put('users/set-departments')->action('setDepartments')->permissions('authenticated')->register();
$api->post('users/register')->action('register')->register();
$api->put('users/send-email')->action('sendEmailValidation')->register();
$api->get('users/validate-email/{user}')->action('validateEmail')->register();
$api->post('users/login')->action('login')->register();
$api->put('users/accept/{user}')->action('accept')->permissions('users.accept')->register();
$api->put('users/refuse/{user}')->action('refuse')->permissions('users.accept')->register();
$api->put('users/personal-info')->action('updatePersonalInfo')->permissions('authenticated')->register();
$api->put('users/work-info')->action('updateWorkInfo')->permissions('authenticated')->register();
$api->put('users/contact-info')->action('updateContactInfo')->permissions('authenticated')->register();
$api->put('users/logout')->action('logout')->permissions('authenticated')->register();
$api->delete('users/{user}')->action('destroy')->permissions('users.delete')->register();



$api->controller('PermissionController');
$api->get('permissions/{depart}')->action('getByDepartment')->permissions('authenticated')->register();
$api->put('permissions/{depart}')->action('updateDepartment')->permissions('permissions.update')->register();
$api->get('permissions/me')->action('getMe')->permissions('authenticated')->register();



$api->controller('ProjectController');
$api->get('projects')->action('getAll')->permissions('projects.all')->register();
$api->get('projects/me')->action('getMe')->permissions('authenticated')->register();
$api->get('projects/{project}')->action('show')->permissions('authenticated')->register(); // must be working on this project
$api->post('projects')->action('create')->permissions('projects.create')->register();
$api->put('projects/{project}')->action('update')->permissions('projects.update')->register();
$api->put('projects/accept')->action('accept')->permissions('projects.accept')->register();
$api->delete('projects/{project}')->action('destroy')->permissions('projects.delete')->register();
$api->put('projects/add-user/{project}/{user}')->action('addUser')->permissions('projects.users')->register();
$api->put('projects/remove-user/{project}/{user}')->action('removeUser')->permissions('projects.users')->register();
$api->put('projects/set-users/{project}/{user}')->action('setUsers')->permissions('projects.users')->register();


$api->controller('ProjectCommentController');
$api->get('comments/project/{project}')->action('getByProject')->permissions('authenticated')->register();
$api->post('comments/project/{project}')->action('create')->permissions('authenticated')->register();
$api->put('comments/{comment}')->action('update')->permissions('authenticated')->register();
$api->delete('comments/{comment}')->action('destroy')->permissions('authenticated')->register();



$api->controller('ProjectStageController');
$api->get('stages/{project}')->action('getByProject')->permissions('authenticated')->register();
$api->post('stages/{project}')->action('create')->permissions('stages.create')->register();
$api->post('stages/set/{project}')->action('setProjectStages')->permissions('stages.create')->register();
$api->put('stages/{stage}')->action('update')->permissions('stages.update')->register();
$api->delete('stages/{stage}')->action('destroy')->permissions('stages.delete')->register();


$api->controller('DriveController');
$api->get('drives/me')->action('getMe')->permissions('authenticated')->register();
$api->get('drives/main')->action('getMain')->permissions('authenticated')->register();
$api->post('drives')->action('create')->permissions('authenticated')->register();
$api->delete('drives/:drive')->action('destroy')->permissions('authenticated')->register();



$api->controller('FileController');
$api->get('files/{drive}')->action('getByDrive')->permissions('authenticated')->register();
$api->post('files/upload/{drive}')->action('uploadToDrive')->permissions('authenticated')->register();
$api->post('files/upload-to-main')->action('uploadToMainDrive')->permissions('authenticated')->register();
$api->get('files/images/{drive}')->action('getDriveImages')->permissions('authenticated')->register();
$api->get('files/documents/{drive}')->action('getDriveDocuments')->permissions('authenticated')->register();
$api->delete('files/:drive/{file}')->action('destroy')->permissions('authenticated')->register();



$api->controller('NotificationController');
$api->get('notifications/new')->action('getNew')->permissions('authenticated')->register();
$api->get('notifications/notify-all')->action('notifyAll')->permissions('authenticated')->register();
$api->get('notifications/notify-project-users/{project}')->action('notifyProjectUsers')->permissions('authenticated')->register();



$api->controller('DepartmentController');
$api->get('departments')->action('getAll')->register();


// Binding parameters to models
Route::model('user', 'Membership\User');
Route::model('drive', 'Drive\Drive');
Route::model('file', 'Drive\File');
Route::model('stage', 'Company\ProjectStage');
Route::model('project', 'Company\Project');
Route::model('comment', 'Company\ProjectComment');
Route::model('depart', 'Company\Department');