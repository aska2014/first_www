<?php


use Cane\Models\Membership\User;

App::before(function($request)
{
});


App::after(function($request, $response)
{
});

/**
 * Make sure user is authenticated
 */
Route::filter('auth', function()
{
	if (Auth::guest())
	{
        App::abort(401, 'You must login to make this request.');
	}

    // Check if user is active. This is necessary because admins can block users after they are logged in
    // Blocking a user means to set active to 0
    if(! Auth::user()->active) {

        Auth::logout();
        App::abort(401, 'You must login to make this request.');
    }
});


/**
 * Check user in to the application
 */
Route::filter('checkIn', function()
{
    Auth::user()->checkIn();
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
