<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Flyer;
use App\Photo;
use App\Services\PhotoUploader;

class PhotosController extends Controller
{
    /**
     * Add a photo to a given flyer.
     *
     * @param Requests\FlyerPhotoRequest $request
     * @param Flyer $flyer
     */
    public function store(Requests\FlyerPhotoRequest $request, Flyer $flyer)
    {
        $photo = $request->file('photo');

        (new PhotoUploader($flyer, $photo))->save();
    }

    public function destroy(Photo $photo)
    {
        $photo->delete();

        return back();
    }
}
