<?php namespace Aska\Membership\Auth;

use Aska\Membership\Models\User;
use Auth;

class SessionUser {

    /**
     * @return User
     */
    public function user()
    {
        return Auth::user();
    }

} 