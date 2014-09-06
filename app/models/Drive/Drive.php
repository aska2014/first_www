<?php namespace Drive;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Membership\User;

class Drive extends Model {

    /**
     * @var string
     */
    protected $table = 'drives';

    /**
     * @var array
     */
    protected $fillable = array('slug', 'user_id');

    /**
     * @var array
     */
    protected $with = array('files');

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
        return $this->belongsTo('Membership\User', 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function files()
    {
        return $this->belongsToMany('Drive\File', 'file_drive', 'drive_id', 'file_id');
    }
}