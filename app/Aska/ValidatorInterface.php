<?php namespace Aska;

use Aska\Exceptions\ValidationException;

interface ValidatorInterface {

    /**
     * @param array $inputs
     * @return \Illuminate\Validation\Validator
     */
    public function make(array $inputs);

    /**
     * @param array $inputs
     * @throws ValidationException
     * @return mixed
     */
    public function validateOrFail(array $inputs);

} 