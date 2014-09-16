<?php namespace Cane\Models\Company;

use Cane\Models\BaseModel;

class ProjectStage extends BaseModel {

    /**
     * @var string
     */
    protected $table = 'project_stages';

    /**
     * @var array
     */
    protected $fillable = array('notes', 'end_date', 'project_id', 'files');

    /**
     * @var array
     */
    protected $with = array('files');

    /**
     * @refactor this
     * @param $inputs
     */
    public function setFilesAttribute($inputs)
    {
        if($this->exists) {

            $this->syncManyToMany($this->files(), $inputs);

        } else {

            $this->created(function() use ($inputs)
            {
                $this->syncManyToMany($this->files(), $inputs);
            });
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('Cane\Models\Company\Project', 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function files()
    {
        return $this->belongsToMany('Cane\Models\Drive\File', 'project_stage_file', 'project_stage_id', 'file_id');
    }
}