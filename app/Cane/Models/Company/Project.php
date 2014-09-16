<?php namespace Cane\Models\Company;

use Cane\Models\AcceptableTrait;
use Cane\Models\BaseModel;
use Cane\Models\Membership\User;

class Project extends BaseModel
{
    use AcceptableTrait;

    /**
     * @var string
     */
    protected $table = 'projects';

    /**
     * @var array
     */
    protected $fillable = array('name', 'company', 'serial_number', 'start_date', 'end_date');

    /**
     * @param $inputs
     */
    public function setFiles($inputs)
    {
        $this->syncManyToMany($this->files(), $inputs);
    }

    /**
     * @param $inputs
     * @return array
     */
    public function setTeam($inputs)
    {
        $this->syncManyToMany($this->team(), $inputs);
    }

    /**
     * Synchronize stages in projects
     *
     * @refactor
     * @param $inputs
     */
    public function setStages($inputs)
    {
        $this->syncMany($this->stages(), $inputs);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isUserInTeam(User $user)
    {
        return $this->team()->where('project_user.user_id', $user->id)->count() > 0;
    }

    /**
     * @param $query
     * @param User $user
     * @return mixed
     */
    public function scopeInTeam($query, User $user)
    {
        return $query->join('project_user', 'project_user.project_id', '=', 'projects.id')
                     ->where('project_user.user_id', $user->id)
                     ->select('projects.*');
    }

    /**
     * @param $query
     * @param User $user
     */
    public function scopeByApprover($query, User $user)
    {
        return $query->where('approved_by_id', $user->id);
    }

    /**
     * @param $query
     * @param User $user
     */
    public function scopeByCreator($query, User $user)
    {
        return $query->where('created_by_id', $user->id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('Cane\Models\Company\ProjectComment', 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stages()
    {
        return $this->hasMany('Cane\Models\Company\ProjectStage', 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function team()
    {
        return $this->belongsToMany('Cane\Models\Membership\User', 'project_user', 'project_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo('Cane\Models\Membership\User', 'created_by_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function approver()
    {
        return $this->belongsTo('Cane\Models\Membership\User', 'approved_by_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function files()
    {
        return $this->belongsToMany('Cane\Models\Drive\File', 'project_file', 'project_id', 'file_id');
    }
}