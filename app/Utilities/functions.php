<?php

function flyer_path(App\Flyer $flyer)
{
    return route('flyers.show', [
        $flyer->zip,
        str_replace(' ', '-', $flyer->street)
    ]);
}