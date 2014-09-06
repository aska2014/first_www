<?php

class ProjectStageValidator implements ValidatorInterface {

    /**
     * @param array $inputs
     * @return \Illuminate\Validation\Validator
     */
    public function make(array $inputs)
    {
        return Validator::make($inputs, [
            'end_date' => 'required|date'
        ]);
    }
}