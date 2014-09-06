<?php namespace Drive;

use Illuminate\Database\Eloquent\Model;
use MimeType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class File extends Model {

    const DOC_TYPE = 'doc';
    const IMAGE_TYPE = 'image';
    const PDF_TYPE = 'pdf';

    /**
     * @var string
     */
    protected $table = 'files';

    /**
     * @var array
     */
    protected $fillable = array('url', 'type');

    /**
     * Register before saving handler
     */
    public static function boot()
    {
        static::saving(function(File $file)
        {
            $file->type = $file->getTypeFromUrl();
        });
    }

    /**
     * @param Drive $drive
     * @param $basePath
     * @param $baseUrl
     * @param UploadedFile $file
     * @return static
     */
    public static function uploadAndCreate(Drive $drive, $basePath, $baseUrl, UploadedFile $file)
    {
        $path = $basePath.'/'.$drive->slug;
        $name = static::getUniqueFileName($file, $path);

        // Move file
        $file->move($path, $name);

        $url = $baseUrl.'/'.$drive->slug.'/'.$name;

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
     * @return bool
     */
    public function isImage()
    {
        return $this->type == self::IMAGE_TYPE;
    }

    /**
     * @return bool
     */
    public function isDoc()
    {
        return $this->type == self::DOC_TYPE;
    }

    /**
     * @return bool
     */
    public function isPdf()
    {
        return $this->type == self::PDF_TYPE;
    }

    /**
     * @return string
     */
    public function getTypeFromUrl()
    {
        if(MimeType::isImage($this->url)) {
            return self::IMAGE_TYPE;
        } else if(MimeType::isDoc($this->url)) {
            return self::DOC_TYPE;
        } else if(MimeType::isPdf($this->url)) {
            return self::PDF_TYPE;
        }
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function drives()
    {
        return $this->belongsToMany('Drive\Drive', 'file_drive', 'file_id', 'drive_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projectComments()
    {
        return $this->belongsToMany('Company\ProjectComment', 'project_comment_file', 'file_id', 'project_comment_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function projectStages()
    {
        return $this->belongsToMany('Company\ProjectStage', 'project_stage_file', 'file_id', 'project_stage_id');
    }
}