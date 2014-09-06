<?php namespace Company;

use Illuminate\Database\Eloquent\Model;

class ProjectComment extends Model {

    use \FileAttachments;

    /**
     * @var string
     */
    protected $table = 'project_comments';

    /**
     * @var array
     */
    protected $fillable = array('body', 'files');

    /**
     * @var array
     */
    protected $with = array('user', 'files');

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function files()
    {
        return $this->belongsToMany('Drive\File', 'project_comment_file', 'project_comment_id', 'file_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Membership\User', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo('Company\Project', 'project_id');
    }

} 