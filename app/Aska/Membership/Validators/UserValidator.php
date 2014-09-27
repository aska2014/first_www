<?php namespace Aska\Membership\Validators;

use Aska\Exceptions\ValidationException;
use Aska\ValidatorInterface;
use Validator;

class UserValidator implements ValidatorInterface {

    /**
     * @param $inputs
     * @return mixed
     */
    public function make(array $inputs)
    {
        return Validator::make($inputs, [
            'main_password' => 'required|exists:settings,main_password',
            'email'         => 'required|email|unique:users',
            'password'      => 'required|confirmed'
        ]);
    }

    /**
     * @param array $inputs
     * @throws ValidationException
     * @return mixed
     */
    public function validateOrFail(array $inputs)
    {
        $validator = $this->make($inputs);

        if($validator->fails()) {

            throw new ValidationException($validator->messages());
        }
    }

} 