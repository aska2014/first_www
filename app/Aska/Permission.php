<?php namespace Aska;

use Aska\Membership\Auth\SessionUser;

abstract class Permission {

    /**
     * @var SessionUser
     */
    protected $sessionUser;

    /**
     * @param SessionUser $sessionUser
     */
    public function __construct(SessionUser $sessionUser)
    {
        $this->sessionUser = $sessionUser;
    }

}
