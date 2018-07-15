<?php

namespace App\Services;

use App\Flyer;
use App\Photo;
use App\Thumbnail;
use Illuminate\Http\UploadedFile;

/**
 * Class PhotoAttacher
 * @package App\Services
 */
class PhotoUploader
{
    /**
     * @var Flyer
     */
    protected $flyer;

    /**
     * @var UploadedFile
     */
    protected $file;

    /**
     * @var Thumbnail
     */
    protected $thumbnail;

    /**
     * PhotoAttacher constructor.
     *
     * @param Flyer $flyer
     * @param UploadedFile $file
     * @param Thumbnail|null $thumbnail
     */
    public function __construct(Flyer $flyer, UploadedFile $file, Thumbnail $thumbnail = null)
    {
        $this->flyer = $flyer;
        $this->file = $file;
        $this->thumbnail = $thumbnail ?: new Thumbnail;
    }

    /**
     *
     */
    public function save()
    {
        // attach photo to flyer
        $photo = $this->flyer->addPhoto($this->makePhoto());

        // move photo to the images folder
        $this->file->move($photo->baseDir(), $photo->name);

        // generate a thumbnail
        $this->thumbnail->make($photo->path, $photo->thumbnail_path);
    }

    /**
     * @return Photo
     */
    protected function makePhoto()
    {
        return new Photo(['name' => $this->fileName()]);
    }

    /**
     * @return string
     */
    protected function fileName()
    {
        $name = sha1(
            time() . $this->file->getClientOriginalName()
        );

        $extension = $this->file->getClientOriginalExtension();

        return "{$name}.{$extension}";
    }
}