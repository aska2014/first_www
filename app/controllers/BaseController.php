<?php

class BaseController extends \Illuminate\Routing\Controller {

    /**
     * @param $message
     * @throws Cane\Exceptions\AccessDeniedException
     */
    public function noAccess($message)
    {
        throw new \Cane\Exceptions\AccessDeniedException($message);
    }

    /**
     * @return bool
     */
    public function isLocalEnvironment()
    {
        return App::environment() == 'local';
    }

} 