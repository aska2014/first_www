<?php

use Aska\Exceptions\ForbiddenException;
use Aska\Exceptions\ValidationException;

class BaseController extends \Illuminate\Routing\Controller {

    /**
     * @param $name
     */
    public function setPage($name)
    {
        if(Lang::has('pages.'.$name)) {

            $page = new StdClass();

            $page->title = Lang::get('pages.'.$name.'.title');
            $page->sub_title = Lang::get('pages.'.$name.'.sub_title');

            View::share('page', $page);
        }
    }

    /**
     * @param $inputs
     * @param $rules
     * @throws ValidationException
     * @return \Illuminate\Validation\Validator
     */
    protected function validateOrFail($inputs, $rules)
    {
        $validator = Validator::make($inputs, $rules);

        if($validator->fails()) {

            throw new ValidationException($validator->messages());
        }

        return $validator;
    }

    /**
     * @param $message
     * @throws ForbiddenException
     */
    public function forbidden($message)
    {
        throw new ForbiddenException($message);
    }

    /**
     * @return bool
     */
    public function isLocalEnvironment()
    {
        return App::environment() == 'local';
    }

} 