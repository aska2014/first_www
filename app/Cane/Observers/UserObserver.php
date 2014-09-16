<?php namespace Cane\Observers;

use Cane\Exceptions\AccessDeniedException;
use Cane\Models\Membership\User;
use Cane\UserSession;

class UserObserver {

    /**
     * @var \Cane\Models\Membership\User
     */
    protected $users;

    /**
     * @var \Cane\UserSession
     */
    protected $userSession;

    /**
     * @param User $users
     * @param \Cane\UserSession $userSession
     */
    public function __construct(User $users, UserSession $userSession)
    {
        $this->users = $users;
        $this->userSession = $userSession;
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