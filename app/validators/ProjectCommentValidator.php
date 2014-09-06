<?php

use Illuminate\Validation\Validator;

class ProjectCommentValidator implements ValidatorInterface {

    /**
     * @param array $inputs
     * @return Validator
     */
    public function make(array $inputs)
    {
        return Validator::make($inputs, [
            'body' => 'required',
        ]);
    }
}