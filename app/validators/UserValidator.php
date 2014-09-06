<?php

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

} 