<?php

namespace App;

use Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

/**
 * Class Photo
 * @package App
 */
class Photo extends Model
{
    /**
     * @var string
     */
    protected $table = 'flyer_photos';

    /**
     *
     * @var array
     */
    protected $fillable = [
        'path',
        'thumbnail_path',
        'name',
    ];

    protected $file;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flyer()
    {
        return $this->belongsTo(Flyer::class);
    }

    /**
     * Named constructor from given file.
     *
     * @param UploadedFile $file
     * @return Photo
     */
    public static function fromFile(UploadedFile $file)
    {
        $photo = new static;

        $photo->file = $file;

        return $photo->fill([
            'name' => $photo->fileName(),
            'path' => $photo->filePath(),
            'thumbnail_path' => $photo->thumbnailPath(),
        ]);
    }

    /**
     * Filename builder.
     *
     * @return string
     */
    protected function fileName()
    {
        $name = sha1(time() . $this->file->getClientOriginalName());
        $extension = $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }

    /**
     * Photo path.
     *
     * @return string
     */
    protected function filePath()
    {
        return $this->baseDir() . '/' . $this->fileName();
    }

    /**
     * Thumbnail path.
     *
     * @return string
     */
    protected function thumbnailPath()
    {
        return $this->baseDir() . '/tn-' . $this->fileName();
    }

    /**
     * Base photos directory.
     *
     * @return string
     */
    protected function baseDir()
    {
        return 'photos/flyers';
    }

    /**
     * Move file to a set destination.
     *
     * @return $this
     */
    public function upload()
    {
        $this->file->move($this->baseDir(), $this->fileName());

        $this->makeThumbnail();

        return $this;
    }

    /**
     * Make thumbnail for given photo.
     * TODO: grab to separate thumbnail model.
     */
    protected function makeThumbnail()
    {
        Image::make($this->filePath())
            ->fit(200)
            ->save($this->thumbnailPath());
    }
}
