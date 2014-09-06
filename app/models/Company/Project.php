<?php namespace Company;

use AcceptableTrait;
use Illuminate\Database\Eloquent\Model;
use Membership\User;

class Project extends Model
{

    use AcceptableTrait, \FileAttachments;

    /**
     * @var string
     */
    protected $table = 'projects';

    /**
     * @var array
     */
    protected $fillable = array('name', 'company', 'serial_number', 'start_date', 'end_date', 'files', 'stages', 'users');

    /**
     * @var array
     */
    protected $with = array('files', 'stages', 'users', 'comments');

    /**
     * @param $users
     * @return array
     */
    public function setUsersAttribute($users)
    {
        $ids = [];

        // Extract ids from files objects
        foreach($users as $user) {

            if(isset($user['id'])) array_push($ids, $user['id']);
        }

        $this->users()->sync($ids);
    }

    /**
     * Synchronize stages in projects
     *
     * @refactor
     * @param $inputs
     */
    public function setStagesAttribute($inputs)
    {
        $ids = array();

        foreach($inputs as $stageInput)
        {
            // Update if id isset
            if(isset($stageInput['id'])) {
                // Update project stage..
                $stage = ProjectStage::find($stageInput['id']);
                $stage->update($stageInput);
            } else {
                //
                $stage = $this->stages()->create($stageInput);
            }

            array_push($ids, $stage->id);
        }

        // Delete all stages attached to this project
        if(empty($ids)) return $this->stages()->delete();

        // Delete other stages that are connected to this project
        return $this->stages()->whereNotIn('id', $ids)->delete();
    }

    /**
     * @param User $user
     * @return bool
     */
    public function inTeam(User $user)
    {
        return $this->users()
            ->where('users.id', $user->id)
            ->count() > 0;
    }

    /**
     * Check project team, creator or approved.
     *
     * @param User $user
     * @return bool
     */
    public function checkUserAccess(User $user)
    {
        return $this->inTeam($user) || $user->compare($this->createdBy) || $user->compare($this->approvedBy);
    }

    /**
     * @param $query
     * @param User $user
     * @return mixed
     */
    public function scopeByUser($query, User $user)
    {
        return $query->join('project_user', 'project_user.project_id', '=', 'projects.id')
                     ->where('project_user.user_id', $user->id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('Company\ProjectComment', 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stages()
    {
        return $this->hasMany('Company\ProjectStage', 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany('Membership\User', 'project_user', 'project_id', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo('Membership\User', 'created_by_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function approvedBy()
    {
        return $this->belongsTo('Membership\User', 'approved_by_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function files()
    {
        return $this->belongsToMany('Drive\File', 'project_file', 'project_id', 'file_id');
    }
}