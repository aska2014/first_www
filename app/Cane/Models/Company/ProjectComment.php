<?php namespace Cane\Models\Company;

use Cane\Models\BaseModel;

class ProjectComment extends BaseModel {

    /**
     * @var string
     */
    protected $table = 'project_comments';

    /**
     * @var array
     */
    protected $fillable = array('body', 'project_id');

    /**
     * @param $query
     * @param $projectId
     * @return mixed
     */
    public function scopeByProjectId($query, $projectId)
    {
        return $query->where('project_id', $projectId);
    }

    /**
     * @param $inputs
     */
    public function setFiles($inputs)
    {
        $this->syncManyToMany($this->files(), $inputs);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function files()
    {
        return $this->belongsToMany('Cane\Models\Drive\File', 'project_comment_file', 'project_comment_id', 'file_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Cane\Models\Membership\User', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('Cane\Models\Company\Project', 'project_id');
    }

} 