<?php namespace Cane\Models\Social;

use Cane\Models\BaseModel;

class Notification extends BaseModel {

    /**
     * @var string
     */
    protected $table = 'notifications';

    /**
     * @var array
     */
    protected $fillable = array('body', 'url', 'user_id');


    /**
     * @param $query
     * @param $date
     * @return mixed
     */
    public function scopeNewerThan($query, $date)
    {
        return $query->where('created_at', '>', $date);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Cane\Models\Membership\User', 'user_id');
    }
} 