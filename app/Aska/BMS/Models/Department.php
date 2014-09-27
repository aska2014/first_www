<?php namespace Aska\BMS\Models;

use Aska\BaseModel;
use Aska\Membership\Models\User;

class Department extends BaseModel {

    /**
     * @var string
     */
    protected $table = 'bms_departments';

    /**
     * @var array
     */
    protected $fillable = array('name');

    /**
     * @param $inputs
     */
    public function setUsers($inputs)
    {
        $this->syncManyToMany($this->users(), $inputs);
    }

    /**
     * @param $inputs
     */
    public function setPermissions($inputs)
    {
        $this->syncMany($this->permissions(), $inputs);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::getClass(), 'user_department', 'department_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions()
    {
        return $this->hasMany(DepartmentPermission::getClass(), 'department_id');
    }
} 