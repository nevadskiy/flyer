<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Photo extends Model
{
    protected $table = 'flyer_photos';

    protected $baseDir = 'photos/flyers';

    protected $fillable = [
        'path'
    ];

    public function flyer()
    {
        return $this->belongsTo(Flyer::class);
    }

    public static function fromForm(UploadedFile $file)
    {
        $photo = new static;

        $name = time() . $file->getClientOriginalName();

        $photo->path = $photo->baseDir . '/' . $name;

        $file->move($photo->baseDir, $name);

        return $photo;
    }
}
