<?php namespace Aska\Social;

use Aska\BaseModel;
use Aska\Membership\Models\User;

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
        return $this->belongsTo(User::getClass(), 'user_id');
    }
} 