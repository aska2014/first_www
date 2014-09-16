<?php namespace Cane\Permissions;

use Cane\UserSession;

abstract class Permission {

    /**
     * @var \Cane\UserSession
     */
    protected $userSession;

    /**
     * @param UserSession $userSession
     */
    public function __construct(UserSession $userSession)
    {
        $this->userSession = $userSession;
    }

}
