<?php


use Aska\Exceptions\UnauthorizedException;

App::before(function($request)
{
    // Set locale language
    App::setLocale(App::make('Aska\Language')->get());

    //@refactor
    View::share('language', App::make('Aska\Language')->get());


    // If this was a request from a different domain
    if(isset($_SERVER['HTTP_REFERER'])) {

        $allowedOrigins = [
            'http://app.firstchoice.dev', 'http://admin.firstchoice.dev',
            'http://app.firstchoice.cc', 'http://admin.firstchoice.cc'
        ];

        foreach($allowedOrigins as $allowedOrigin) {

            if(strpos($_SERVER['HTTP_REFERER'], $allowedOrigin) === 0) {

                header('Access-Control-Allow-Origin: '.$allowedOrigin);
                header('Access-Control-Allow-Methods: POST, PUT, DELETE, GET, OPTIONS');
                header('Access-Control-Allow-Credentials: true');
                header('Access-Control-Allow-Headers: Content-Type');
            }
        }
    }
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
        throw new UnauthorizedException();
    }

    // Check if user is active. This is necessary because admins can block users after they are logged in
    // Blocking a user means to set active to 0
    if(! Auth::user()->active) {

        Auth::logout();

        throw new UnauthorizedException();
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
