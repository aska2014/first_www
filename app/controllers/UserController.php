<?php

use Membership\User;

class UserController extends APIController
{

    /**
     * @param User $users
     * @param UserValidator $userValidator
     */
    public function __construct(User $users, UserValidator $userValidator)
    {
        $this->users = $users;
        $this->userValidator = $userValidator;
    }

    /**
     * Get all users
     */
    public function getAll()
    {
        return $this->users->all();
    }

    /**
     * @return User
     */
    public function getMe()
    {
        return $this->me();
    }

    /**
     * Check user in (update IP and online date)
     */
    public function checkUserIn()
    {
        $this->me()->checkIn();
    }

    /**
     * @return mixed
     */
    public function getNew()
    {
        return $this->users->newerThan($this->me()->online_at)->get();
    }

    /**
     * Register new user
     */
    public function register()
    {
        $inputs = Input::all();

        $validator = $this->userValidator->make($inputs);

        if($validator->fails()) {

            return Response::make($validator->messages(), 400);
        }

        // Accept all users for now
        $user = $this->users->create($inputs);
        $user->accept();
        return $user;
    }

    /**
     * Login user
     */
    public function login()
    {
        $login = ['email' => Input::get('email'), 'password' => Input::get('password'), 'active' => 1];

        if (! Auth::validate($login)) {

            App::abort(401, 'Given credentials are incorrect.');
        }

        // Check now with the email validated
        $login['email_validated'] = 1;

        if (! Auth::attempt($login, Input::get('remember_me', false))) {

            return Response::make(['message' => 'You must validate your email first to login.'], 400);
        }

        return Auth::user();
    }

    /**
     * Send email validation
     */
    public function sendEmailValidation()
    {
        $user = $this->users->byEmail(Input::get('email'))->first();

        if(! $user) {
            return Response::make(400, ['message' => 'Invalid request.']);
        }

        $token = $user->getValidateEmailToken();

        $validationLink = URL::to('/api/users/validate-email/'.$user->id.'?token='.$token);

        Mail::send('emails.auth.validate', compact('validationLink'), function($message) {
            $message->to(Input::get('email'))->subject('Validate your FirstChoice account');
        });

        // Validate email for local environment
        if($this->isLocalEnvironment()) {

            $user->validateEmail($token);
        }
    }

    /**
     * Validate user email
     */
    public function validateEmail(User $user)
    {
        if(! $user->validateEmail(Input::get('token'))) {
            return Response::make(400, ['message' => 'Invalid request.']);
        }

        return Redirect::to(Config::get('client.url'));
    }

    /**
     * Logout user
     */
    public function logout()
    {
        Auth::logout();
    }

    /**
     * Accept user
     */
    public function accept(User $user)
    {
        $user->accept();

        return ['message' => 'User accepted successfully'];
    }

    /**
     * Refuse user
     */
    public function refuse(User $user)
    {
        $user->refuse();

        return ['message' => 'User refused successfully'];
    }

    /**
     * Update personal information
     */
    public function updatePersonalInfo()
    {
    }

    /**
     * Update work information
     */
    public function updateWorkInfo()
    {
    }

    /**
     * Update contact information
     */
    public function updateContactInfo()
    {
    }

    /**
     * Update user profile image
     */
    public function updateProfileImage()
    {
        // Get base path
        $oldPath = str_replace(URL::to('public'), '', Input::get('image'));
        $newPath = 'albums/profile/user'.$this->me()->id.'.jpg';

        // open file a image resource
        $img = Image::make(public_path($oldPath));

        // crop the best fitting 5:3 (600x360) ratio and resize to 600x360 pixel
        $img->fit(400, 400);

        $fullDir = dirname(public_path($newPath));
        if(! file_exists($fullDir)) {
            mkdir($fullDir, 0777, true);
        }

        $img->save(public_path($newPath));

        $this->me()->setProfileImage(URL::to('public/'.$newPath));
    }

    /**
     * Set departments for this user
     */
    public function setDepartments()
    {
        $this->me()->departments()->sync(Input::get('departments', []));
    }

    /**
     * Soft delete a user by id
     */
    public function destroy(User $user)
    {
        $user->delete();

        return ['message' => 'User deleted successfully'];
    }
}