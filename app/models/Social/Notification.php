<?php namespace Social;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model {
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
        return $this->belongsTo('Membership\User', 'user_id');
    }
} 