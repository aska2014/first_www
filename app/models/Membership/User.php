<?php namespace Membership;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Hash;

class User extends Model implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait, \AcceptableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');

    /**
     * @var array
     */
    protected $fillable = array('full_name', 'email', 'password');

    /**
     * @var array
     */
    protected $with = array('departments');

    /**
     * @var array
     */
    protected $appends = array('permissions');

    /**
     * Update ip and online at before saving
     */
    public static function boot()
    {
        static::saving(function(User $user)
        {
            $user->ip = \Request::getClientIp();
            $user->online_at = new \DateTime();
        });
    }

    /**
     * @param $query
     * @param $email
     * @return mixed
     */
    public function scopeByEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    /**
     * Get token used in the validate email link
     *
     * @todo make more secure algorithm
     * @return string
     */
    public function getValidateEmailToken()
    {
        return md5($this->password.'.^$$fSD'.$this->id);
    }

    /**
     * Validate user email
     */
    public function validateEmail($token)
    {
        if($token === $this->getValidateEmailToken()) {
            $this->email_validated = true;
            return $this->save();
        }

        return false;
    }

    /**
     * Compare two users.
     *
     * @param User $user
     * @return bool
     */
    public function compare(User $user)
    {
        return $this->id == $user->id;
    }

    /**
     * Check this user in (update IP and online_at)
     */
    public function checkIn()
    {
        return $this->save();
    }

    /**
     * @param $query
     * @param User $user
     * @return mixed
     */
    public function scopeExcept($query, User $user)
    {
        return $query->where('id', '!=', $user->id);
    }

    /**
     * @param $image
     */
    public function setProfileImage($image)
    {
        $this->profile_image = $image;
        $this->save();
    }

    /**
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * @return Collection
     */
    public function getPermissionsAttribute()
    {
        $permissions = new Collection();

        foreach($this->departments as $department)
        {
            $permissions = $permissions->merge($department->permissions);
        }

        return $permissions;
    }

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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function approvedProjects()
    {
        return $this->hasMany('Company\Project', 'approved_by_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function createdProjects()
    {
        return $this->hasMany('Company\Project', 'created_by_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function files()
    {
        return $this->hasManyThrough('Drive\File', 'Drive\Drive', 'user_id', 'drive_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function drives()
    {
        return $this->hasMany('Drive\Drive', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function departments()
    {
        return $this->belongsToMany('Company\Department', 'user_department', 'user_id', 'department_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function projects()
    {
        return $this->belongsToMany('Company\Project', 'project_user', 'user_id', 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projectComments()
    {
        return $this->hasMany('Company\ProjectComment', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany('Scoail\Notification', 'user_id');
    }
}
