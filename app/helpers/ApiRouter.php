<?php

class ApiRouter
{
    protected $prefix = '';

    protected $route = array(
        'method' => '',
        'action' => '',
        'path' => '',
        'permissions' => '',
        'controller' => ''
    );

    /**
     * @param $prefix
     */
    public function prefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * Reset route parameters to register a new one
     */
    public function reset()
    {
        $this->route['method'] = '';
        $this->route['action'] = '';
        $this->route['path'] = '';
        $this->route['permissions'] = '';
    }

    /**
     * Register current route parameters
     */
    public function register()
    {
        $permissions = is_array($this->route['permissions']) ? implode(',',$this->route['permissions']) : $this->route['permissions'];
        $method = $this->route['method'];
        $path = $this->route['path'];
        $controller = $this->route['controller'];
        $action = $this->route['action'];

        $options = ['uses' => $controller.'@'.$action];

        if ($permissions == 'authenticated') {
            $options['before'] = 'auth';
        } else if($permissions != '') {
            $options['before'] = 'permissions:' . $permissions;
        }

        Route::$method($this->prefix . '/' . ltrim($path,'/'),$options);

        $this->reset();
    }

    /**
     * @param $action
     * @return $this
     */
    public function action($action)
    {
        $this->route['action'] = $action;
        return $this;
    }

    /**
     * @param $controller
     * @return $this
     */
    public function controller($controller)
    {
        $this->route['controller'] = $controller;
        return $this;
    }

    /**
     * @param $permissions
     * @return $this
     */
    public function permissions($permissions)
    {
        $this->route['permissions'] = $permissions;
        return $this;
    }

    /**
     * @param $path
     * @return $this
     */
    public function get($path)
    {
        $this->route['path'] = $path;
        $this->route['method'] = 'get';
        return $this;
    }

    /**
     * @param $path
     * @return $this
     */
    public function post($path)
    {
        $this->route['path'] = $path;
        $this->route['method'] = 'post';
        return $this;
    }

    /**
     * @param $path
     * @return $this
     */
    public function put($path)
    {
        $this->route['path'] = $path;
        $this->route['method'] = 'put';
        return $this;
    }

    /**
     * @param $path
     * @return $this
     */
    public function delete($path)
    {
        $this->route['path'] = $path;
        $this->route['method'] = 'delete';
        return $this;
    }
}