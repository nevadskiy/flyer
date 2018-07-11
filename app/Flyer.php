<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Flyer extends Model
{
    protected $fillable = [
        'street',
        'zip',
        'city',
        'country',
        'state',
        'price',
        'description',
    ];

    /**
     * Scope query to those located at a given address.
     *
     * @param Builder $query
     * @param string $zip
     * @param string $street
     * @return Builder
     */
    public function scopeLocatedAt(Builder $query, string $zip, string $street)
    {
        $street = str_replace('-', ' ', $street);

        return $query->where(compact('zip', 'street'));
    }

    public function getPriceAttribute($price)
    {
        return '$' . $price;
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    public function addPhoto(Photo $photo)
    {
        return $this->photos()->save($photo);
    }
}
