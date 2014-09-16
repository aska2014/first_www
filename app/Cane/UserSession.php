<?php namespace Cane;

use Auth;
use Cane\Models\Membership\User;

class UserSession {

    /**
     * @return User
     */
    public function user()
    {
        return Auth::user();
    }

} 