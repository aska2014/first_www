<?php namespace Aska\Membership\Observers;

use Aska\Membership\Models\User;
use Aska\Membership\Auth\SessionUser;

class UserObserver {

    /**
     * @var User
     */
    protected $users;

    /**
     * @var SessionUser
     */
    protected $sessionUser;

    /**
     * @param User $users
     * @param SessionUser $sessionUser
     */
    public function __construct(User $users, SessionUser $sessionUser)
    {
        $this->users = $users;
        $this->sessionUser = $sessionUser;
    }

    /**
     * @param User $user
     */
    public function creating(User $user)
    {
        // Check if this was the first user to register in our application to accept him
        if($this->users->count() == 0) {

            $user->active = 1;
        }
    }

    /**
     * @param User $user
     */
    public function created(User $user)
    {
        // If this is the first user in our application then add him to administrative department
        if($this->users->count() == 1) {

            $user->departments()->attach(1);
        }
    }
}