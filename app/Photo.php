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
     * Base photos directory.
     *
     * @var string
     */
    protected $baseDir = 'photos/flyers';

    /**
     *
     * @var array
     */
    protected $fillable = [
        'path',
        'thumbnail_path',
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flyer()
    {
        return $this->belongsTo(Flyer::class);
    }

    /**
     * Constructor for a photo with given name.
     *
     * @param string $name
     * @return Photo
     */
    public static function withName(string $name)
    {
        return (new static)->saveAs($name);
    }

    /**
     * Setting a photo fields base on given name.
     *
     * @param $name
     * @return $this
     */
    protected function saveAs($name)
    {
        $this->name = sprintf('%s-%s', time(), $name);
        $this->path = sprintf('%s/%s', $this->baseDir, $this->name);
        $this->thumbnail_path = sprintf('%s/tn-%s', $this->baseDir, $this->name);

        return $this;
    }

    /**
     * Move file to a set destination.
     *
     * @param UploadedFile $file
     * @return $this
     */
    public function move(UploadedFile $file)
    {
        $file->move($this->baseDir, $this->name);

        $this->makeThumbnail();

        return $this;
    }

    /**
     * Make thumbnail for given photo.
     * TODO: grab to separate thumbnail model.
     */
    protected function makeThumbnail()
    {
        Image::make($this->path)
            ->fit(200)
            ->save($this->thumbnail_path);
    }
}
