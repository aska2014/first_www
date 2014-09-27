<?php namespace Aska\Drive\Validators;

use Aska\Exceptions\ValidationException;
use Aska\ValidatorInterface;
use Validator;

class FileValidator implements ValidatorInterface {

    /**
     * @param array $inputs
     * @return \Illuminate\Validation\Validator
     */
    public function make(array $inputs)
    {
        return Validator::make($inputs, [
            // Maximum of 2 MB is allowed
            'file' => 'required'
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