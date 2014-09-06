<?php namespace Company;

use Illuminate\Database\Eloquent\Model;

class ProjectStage extends Model {

    use \FileAttachments;

    /**
     * @var string
     */
    protected $table = 'project_stages';

    /**
     * @var array
     */
    protected $fillable = array('notes', 'end_date', 'files', 'project_id');

    /**
     * @var array
     */
    protected $with = array('files');

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('Company\Project', 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function files()
    {
        return $this->belongsToMany('Drive\File', 'project_stage_file', 'project_stage_id', 'file_id');
    }
}