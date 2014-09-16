<?php namespace Cane\Models\Drive;

use Cane\Models\BaseModel;
use Cane\Models\Membership\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class Drive extends BaseModel {

    /**
     * @var string
     */
    protected $table = 'drives';

    /**
     * @var array
     */
    protected $fillable = array('slug', 'user_id');

    /**
     * @param $inputs
     */
    public function setFiles($inputs)
    {
        return $this->syncManyToMany($this->files(), $inputs);
    }

    /**
     * @param $query
     * @param \Cane\Models\Membership\User $user
     * @return
     */
    public function scopeByUser($query, User $user)
    {
        return $query->where('user_id', $user->id);
    }

    /**
     * Get main drive
     *
     * @param User $user
     * @return static
     */
    public static function getMain(User $user)
    {
        return static::firstOrCreate(array(
            'user_id' => $user->id,
            'slug' => 'drive'.$user->id
        ));
    }

    /**
     * @param $slug
     */
    public function setSlugAttribute($slug)
    {
        $this->attributes['slug'] = Str::slug($slug, '-');
    }

    /**
     * @param File $file
     * @return bool
     */
    public function hasFile(File $file)
    {
        return $this->files()->where('files.id', $file->id)->count() > 0;
    }

    /**
     * @return Collection
     */
    public function getImages()
    {
        return $this->files->filter(function (File $file)
        {
            return $file->isImage();
        });
    }

    /**
     * @return Collection
     */
    public function getPdfs()
    {
        return $this->files->filter(function (File $file)
        {
            return $file->isPdf();
        });
    }

    /**
     * @return Collection
     */
    public function getDocs()
    {
        return $this->files->filter(function (File $file)
        {
            return $file->isDoc();
        });
    }

    /**
     * @return mixed
     */
    public function getDocuments()
    {
        return $this->files->filter(function (File $file)
        {
            return $file->isDoc() || $file->isPdf();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Cane\Models\Membership\User', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function files()
    {
        return $this->belongsToMany('Cane\Models\Drive\File', 'file_drive', 'drive_id', 'file_id');
    }
}