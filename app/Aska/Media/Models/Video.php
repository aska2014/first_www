<?php namespace Aska\Media\Models;

use Aska\BaseModel;

class Video extends BaseModel {

    /**
     * @var string
     */
    protected $table = 'videos';

    /**
     * @var array
     */
    protected $fillable = array('type', 'url', 'provider', 'videoable_id', 'videoable_type');

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function videoable()
    {
        return $this->morphTo();
    }
} 