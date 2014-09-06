<?php


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
});


/**
 * Authorize that the authenticated user has the following permission
 */
Route::filter('permissions', function()
{
    $permissions = func_get_args();

    // Leave first two objects (route and request)
    array_shift($permissions);
    array_shift($permissions);

    // Check if user is authenticated
    if(! Auth::check())
    {
        App::abort(401, 'You must login to make this request.');
    }
    // Check if he has permission
    else if(! empty($permissions) && ! App::make('Permission\Permission')->hasAll($permissions))
    {
        App::abort(403, 'You don\'t have permission to this resource.');
    }
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
