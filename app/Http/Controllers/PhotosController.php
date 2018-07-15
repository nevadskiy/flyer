<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Flyer;
use App\Services\PhotoUploader;

class PhotosController extends Controller
{
    /**
     * Add a photo to a given flyer.
     *
     * @param Requests\FlyerPhotoRequest $request
     * @param Flyer $flyer
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function store(Requests\FlyerPhotoRequest $request, Flyer $flyer)
    {
        $photo = $request->file('photo');

        (new PhotoUploader($flyer, $photo))->save();

        return response('success', 200);
    }
}
