<?php namespace Cane\Models\Membership;

use Cane\Models\AcceptableTrait;
use Cane\Models\BaseModel;
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\Collection;
use Hash, App, URL, Image, Request, DateTime;

class User extends BaseModel implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait, AcceptableTrait;

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
    protected $fillable = array('full_name', 'email', 'password', 'profile_image');

    /**
     * @var array
     */
    protected $dates = array('online_at');

    /**
     * @param $query
     * @param $id
     * @return mixed
     */
    public function scopeByDepartmentId($query, $id)
    {
        return $query->join('user_department', 'user_department.user_id', '=', 'users.id')
            ->where('user_department.department_id', $id)
            ->distinct()
            ->select('users.*');
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
     * @param $query
     * @param User $user
     * @return mixed
     */
    public function scopeExcept($query, User $user)
    {
        return $query->where('id', '!=', $user->id);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * @param $inputs
     */
    public function setDepartments($inputs)
    {
        $this->syncManyToMany($this->departments(), $inputs);
    }

    /**
     * @todo Make another class to handle image profile
     *
     * @param $url
     */
    public function setProfileImageAttribute($url)
    {
        // Fit image and move to profile images path then set profile image attribute
        $image = Image::make($url);
        $image->fit(400, 400);
        $image->save($this->getProfileImagePath());


        $this->attributes['profile_image'] = $this->getProfileImageUrl();
    }

    /**
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * @param $password
     * @return bool
     */
    public function checkPassword($password)
    {
        return Hash::check($password, $this->password);
    }

    /**
     * @param $name
     */
    public function setFullNameAttribute($name)
    {
        $this->attributes['full_name'] = ucwords(strtolower($name));
    }

    /**
     * @return mixed
     */
    public function getProfileImageUrl()
    {
        return URL::asset('public/albums/profile/user'.$this->id.'.jpg');
    }

    /**
     * @return string
     */
    public function getProfileImagePath()
    {
        return public_path('albums/profile/user'.$this->id.'.jpg');
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
    public function same($user)
    {
        return ! is_null($user) && $this->id == $user->id;
    }

    /**
     * Check this user in (update IP and online_at)
     */
    public function checkIn()
    {
        $this->ip = Request::getClientIp();
        $this->online_at = new DateTime();

        return $this->save();
    }

    /**
     * @param $resource
     * @param $action
     * @return bool
     */
    public function hasPermission($resource, $action)
    {
        foreach($this->getPermissions() as $permission)
        {
            if($permission->check($resource, $action))
            {
                return true;
            }
        }

        return false;
    }

    /**
     * @return Collection
     */
    public function getPermissions()
    {
        $permissions = new Collection();

        foreach($this->departments()->with('permissions')->get() as $department)
        {
            $permissions = $permissions->merge($department->permissions);
        }

        return $permissions;
    }

    /**
     * @return $this
     */
    public function withPermissions()
    {
        $this->attributes['permissions'] = $this->getPermissions();

        return $this;
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
        return $this->hasMany('Cane\Models\Company\Project', 'approved_by_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function createdProjects()
    {
        return $this->hasMany('Cane\Models\Company\Project', 'created_by_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function files()
    {
        return $this->hasManyThrough('Cane\Models\Drive\File', 'Cane\Models\Drive\Drive', 'user_id', 'drive_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function drives()
    {
        return $this->hasMany('Cane\Models\Drive\Drive', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function departments()
    {
        return $this->belongsToMany('Cane\Models\Company\Department', 'user_department', 'user_id', 'department_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function projects()
    {
        return $this->belongsToMany('Cane\Models\Company\Project', 'project_user', 'user_id', 'project_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projectComments()
    {
        return $this->hasMany('Cane\Models\Company\ProjectComment', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany('Cane\Models\Social\Notification', 'user_id');
    }
}
