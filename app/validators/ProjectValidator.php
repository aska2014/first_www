<?php

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
}