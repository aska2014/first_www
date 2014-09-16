<?php

App::error(function(\Symfony\Component\HttpKernel\Exception\HttpException $exception, $code) {

    if($code == 401) {

        return Response::make(['message' => $exception->getMessage()], 401);

    } else if($code == 403) {

        return Response::make(['message' => $exception->getMessage()], 403);
    }
});


App::error(function(\Cane\Exceptions\AccessDeniedException $exception) {

    return Response::make(['message' => $exception->getMessage()], 403);
});

App::error(function(\Cane\Exceptions\ValidationException $exception) {

    return Response::make($exception->getAllMessages()->all(), 400);
});


