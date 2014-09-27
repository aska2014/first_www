<?php namespace Aska\BMS\Validators;

use Aska\Exceptions\ValidationException;
use Aska\ValidatorInterface;
use Validator;

class ProjectValidator implements ValidatorInterface {

    /**
     * @param $inputs
     * @return \Illuminate\Validation\Validator
     */
    public function make(array $inputs)
    {
        return Validator::make($inputs, [
            'name' => 'required',
            'company' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date'
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