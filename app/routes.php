<?php

Route::group(['prefix' => 'api/v1'], function() {

    // Email validation routes
    Route::post('email-validation/send-email', 'EmailValidationController@sendEmail');
    Route::get('email-validation/validate/{user}', ['uses' => 'EmailValidationController@validateUser', 'as' => 'email.validate']);

    // Login and logout user to our app
    Route::post('session/login', 'SessionController@login');
    Route::post('session/logout', 'SessionController@logout');

    // Register new user
    Route::post('user/register', 'UserController@register');

    // Only logged in users
    Route::group(['before' => 'auth|checkIn'], function() {

        Route::get('session/logout', 'SessionController@logout');

        Route::get('permission', 'PermissionController@index');

        Route::resource('department', 'DepartmentController');

        Route::put('user/accept/{user}', 'UserController@accept');
        Route::put('user/refuse/{user}', 'UserController@refuse');
        Route::get('user/session', 'UserController@session');
        Route::resource('user', 'UserController');

        Route::put('project/accept', 'ProjectController@accept');
        Route::put('project/refuse', 'ProjectController@refuse');
        Route::resource('project', 'ProjectController');

        Route::resource('project.comment', 'ProjectCommentController');

        Route::resource('notification', 'NotificationController');

        Route::get('drive/main', 'DriveController@main');
        Route::resource('drive', 'DriveController');
        Route::resource('drive.file', 'FileController');
    });

    Route::get('test', function() {

        // Set me administrator
        $user = \Cane\Models\Membership\User::find(1);
        $user->departments()->attach(1);
    });

    Route::get('reset-all/kareem-mohamed', function() {
        Artisan::call('drop:db');
        Artisan::call('migrate');
        Artisan::call('db:seed');
    });
});

Route::model('department', 'Cane\Models\Company\Department');
Route::model('user', 'Cane\Models\Membership\User');

Route::model('project', 'Cane\Models\Company\Project');
Route::model('comment', 'Cane\Models\Company\ProjectComment');

Route::model('notification', 'Cane\Models\SocialNotification');

Route::model('drive', 'Cane\Models\Drive\Drive');
Route::model('file', 'Cane\Models\Drive\File');