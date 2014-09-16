<?php namespace Cane\Validators;

use Cane\Exceptions\ValidationException;
use Validator;

class DriveValidator implements ValidatorInterface {

    /**
     * @param array $inputs
     * @return \Illuminate\Validation\Validator
     */
    public function make(array $inputs)
    {
        return Validator::make($inputs, [
            'slug' => 'required|unique:drives'
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