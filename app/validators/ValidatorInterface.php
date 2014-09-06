<?php

use Illuminate\Validation\Validator;

interface ValidatorInterface {

    /**
     * @param array $inputs
     * @return Validator
     */
    public function make(array $inputs);

} 