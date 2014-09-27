<?php namespace SharedApi;

use Aska\Membership\Auth\SessionUser;
use Aska\Membership\Models\User;
use Aska\Membership\Validators\UserValidator;
use BaseController;
use Input, Response, Auth;

class SessionController extends BaseController {

    /**
     * @param SessionUser $sessionUser
     * @param UserValidator $userValidator
     * @param User $users
     */
    public function __construct(SessionUser $sessionUser, UserValidator $userValidator, User $users)
    {
        $this->sessionUser = $sessionUser;
        $this->userValidator = $userValidator;
        $this->users = $users;
    }

    /**
     * Login user with email and password
     */
    public function login()
    {
        // First check if the user was active (this is required because any user must be accepted first by administrators)
        $email = Input::get('email');
        $password = Input::get('password');

        $user = $this->users->byEmail($email)->first();

        // If no user
        if(is_null($user)) {

            return Response::make(['message' => 'We can\'t find this email in our database.'], 401);
        }

        if(! $user->checkPassword($password)) {

            return Response::make(['message' => 'Password is incorrect.'], 401);
        }

        if(! $user->active) {

            return Response::make(['message' => 'You haven\'t been accepted to login to the app yet.'], 401);
        }

        if(! $user->email_validated) {

            return Response::make(['message' => 'You have to validate your email first.'], 401);
        }

        Auth::login($user, Input::get('remember_me', false));

        return Auth::user();
    }

    /**
     * Logout user from application
     */
    public function logout()
    {
        Auth::logout();
    }

}
