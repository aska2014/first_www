<?php namespace Aska\Drive\Models;

use Aska\BMS\Models\ProjectComment;
use Aska\BMS\Models\ProjectStage;
use URL;
use Aska\BaseModel;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class File extends BaseModel {

    /**
     * @var string
     */
    protected $table = 'files';

    /**
     * @var array
     */
    protected $fillable = array('url');

    /**
     * @param Drive $drive
     * @param UploadedFile $file
     * @return static
     */
    public static function uploadAndCreate(Drive $drive, UploadedFile $file)
    {
        // Upload file to drive with a unique name (don't overwrite)
        $path = public_path('drives/'.$drive->slug);
        $name = static::getUniqueFileName($file, $path);
        $file->move($path, $name);

        // Save file url in the database
        $url = URL::asset('drives/'.$drive->slug.'/'.$name);

        return $drive->files()->create(compact('url'));
    }

    /**
     * @param UploadedFile $file
     * @param $path
     * @return string
     */
    public static function getUniqueFileName(UploadedFile $file, $path)
    {
        $name = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $withoutExtension = str_replace('.'.$extension, '', $name);

        while(file_exists($path.'/'.$withoutExtension.'.'.$extension)) {

            $withoutExtension .= rand(1, 1000);
        }

        return $withoutExtension.'.'.$extension;
    }

    /**
     * Get path attribute
     */
    public function getPathAttribute()
    {
        return str_replace(URL::asset('public'), public_path(), $this->url);
    }

    /**
     * @param $query
     * @param $driveId
     * @return mixed
     */
    public function scopeByDriveId($query, $driveId)
    {
        return $query->where('drive_id', $driveId);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function drives()
    {
        return $this->belongsToMany(Drive::getClass(), 'file_drive', 'file_id', 'drive_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projectComments()
    {
        return $this->belongsToMany(ProjectComment::getClass(), 'project_comment_file', 'file_id', 'project_comment_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projectStages()
    {
        return $this->belongsToMany(ProjectStage::getClass(), 'project_stage_file', 'file_id', 'project_stage_id');
    }
}