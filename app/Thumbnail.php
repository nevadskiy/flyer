<?php

namespace App;

use Image;

/**
 * Class Thumbnail
 * @package App
 */
class Thumbnail
{
    /**
     * @param $source
     * @param $destination
     * @param int $fit
     */
    public function make($source, $destination, $fit = 200)
    {
        Image::make($source)
            ->fit($fit)
            ->save($destination);
    }
}