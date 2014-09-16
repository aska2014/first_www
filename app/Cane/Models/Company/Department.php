<?php namespace Cane\Models\Company;

use Cane\Models\BaseModel;

class Department extends BaseModel {

    /**
     * @var string
     */
    protected $table = 'departments';

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
        return $this->belongsToMany('Cane\Models\Membership\User', 'user_department', 'department_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions()
    {
        return $this->hasMany('Cane\Models\Permission\DepartmentPermission', 'department_id');
    }
} 