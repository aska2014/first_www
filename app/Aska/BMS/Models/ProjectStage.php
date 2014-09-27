<?php namespace Aska\BMS\Models;

use Aska\BaseModel;
use Aska\Drive\Models\File;

class ProjectStage extends BaseModel {

    /**
     * @var string
     */
    protected $table = 'bms_project_stages';

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
        return $this->belongsTo(Project::getClass(), 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function files()
    {
        return $this->belongsToMany(File::getClass(), 'project_stage_file', 'project_stage_id', 'file_id');
    }
}