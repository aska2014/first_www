<?php

class APIController extends \Illuminate\Routing\Controller {

    /**
     * @param \Membership\User $user
     * @return bool
     */
    protected function isThisMe($user)
    {
        return $user != null && $this->me()->compare($user);
    }

    /**
     * Check environment
     */
    protected function isLocalEnvironment()
    {
        return App::environment();
    }

    /**
     * @return \Membership\User
     */
    protected function me()
    {
        return Auth::user();
    }
}