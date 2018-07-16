<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function flyer()
    {
        return $this->belongsTo(Flyer::class);
    }

    /**
     * @param $name
     */
    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;

        $this->path = $this->baseDir() . '/' . $name;

        $this->thumbnail_path = $this->baseDir() . '/tn-' . $name;
    }

    /**
     * Base photos directory.
     *
     * @return string
     */
    public function baseDir()
    {
        return 'photos/flyers';
    }

    public function delete()
    {
        \File::delete([
            $this->path,
            $this->thumbnail_path
        ]);

        parent::delete();
    }
}
