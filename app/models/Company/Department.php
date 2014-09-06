<?php namespace Company;

use Illuminate\Database\Eloquent\Model;

class Department extends Model {

    /**
     * @var string
     */
    protected $table = 'departments';

    /**
     * @var array
     */
    protected $fillable = array('name');

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('Membership\User', 'user_department', 'department_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function permissions()
    {
        return $this->hasMany('Permission\DepartmentPermission', 'department_id');
    }
} 