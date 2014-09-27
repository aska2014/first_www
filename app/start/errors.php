<?php

use Aska\Exceptions\ForbiddenException;
use Aska\Exceptions\UnauthorizedException;
use Aska\Exceptions\ValidationException;

App::error(function(UnauthorizedException $exception) {

    if(Request::ajax() || Request::wantsJson()) {

        return Response::make(['message' => 'You need to login to make this request.'], 401);

    } else {

        return Redirect::route('login');
    }
});

App::error(function(ForbiddenException $exception) {

    if(Request::ajax() || Request::wantsJson()) {

        return Response::make(['message' => $exception->getMessage()], 403);

    } else {

        return Redirect::route('noaccess');
    }
});

App::error(function(ValidationException $exception) {

    if(Request::ajax() || Request::wantsJson()) {

        return Response::make($exception->getAllMessages()->all(), 400);

    } else {

        return Redirect::back()->with('errors', $exception->getAllMessages()->all());
    }
});
