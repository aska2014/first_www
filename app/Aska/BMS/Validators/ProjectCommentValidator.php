<?php namespace Aska\BMS\Validators;

use Aska\Exceptions\ValidationException;
use Aska\ValidatorInterface;
use Validator;

class ProjectCommentValidator implements ValidatorInterface {

    /**
     * @param array $inputs
     * @return \Illuminate\Validation\Validator
     */
    public function make(array $inputs)
    {
        return Validator::make($inputs, [
            'body' => 'required',
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