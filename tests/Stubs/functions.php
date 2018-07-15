<?php

/**
 * Stub functions.
 */

namespace App\Services;

function time() {
    return 'now';
}

function sha1($path) {
    return $path;
}

namespace App\Providers;

function date() {
    return 'today';
}