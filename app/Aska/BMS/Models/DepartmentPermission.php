<?php namespace Aska\BMS\Models;

use Aska\BaseModel;

class DepartmentPermission extends BaseModel {

    /**
     * @var string
     */
    protected $table = 'department_permissions';

    /**
     * @var array
     */
    protected $fillable = array('name', 'department_id');

    /**
     * @param $resource
     * @param $action
     * @return bool
     */
    public function check($resource, $action)
    {
        return $this->checkResource($resource) && $this->checkAction($action);
    }

    /**
     * @param $action
     * @return bool
     */
    public function checkAction($action)
    {
        return $this->action == '*' || $this->action == $action;
    }

    /**
     * @param $resource
     * @return bool
     */
    public function checkResource($resource)
    {
        return $this->resource == $resource;
    }

    /**
     * @return mixed
     */
    public function getResourceAttribute()
    {
        $arr = explode('.', $this->name);

        return $arr[0];
    }

    /**
     * @return mixed
     */
    public function getActionAttribute()
    {
        $arr = explode('.', $this->name);

        return $arr[1];
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function department()
    {
        return $this->belongsTo(Department::getClass(), 'department_id');
    }
}