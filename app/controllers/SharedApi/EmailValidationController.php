<?php namespace SharedApi;

use Aska\Membership\Models\User;
use BaseController;
use Response, Input, URL, Mail, Config;

class EmailValidationController extends BaseController {

    /**
     * @param User $users
     */
    public function __construct(User $users)
    {
        $this->users = $users;
    }

    /**
     * Send email validation
     */
    public function sendEmail()
    {
        $user = $this->users->byEmail(Input::get('email'))->first();

        if(! $user) {

            return Response::make(400, ['message' => 'Invalid request.']);

        } else if($user->email_validated) {

            return Response::make(400, ['message' => 'You\'re email has already been validated']);
        }

        $token = $user->getValidateEmailToken();

        $validationLink = URL::route('email.validate', $user->id).'?token='.$token;

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
    public function validateUser(User $user)
    {
        if(! $user->validateEmail(Input::get('token'))) {

            return Response::make(400, ['message' => 'Invalid request.']);
        }

        return Redirect::to(Config::get('client.url'));
    }
} 