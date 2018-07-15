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

    /**
     * Get price of a flyer.
     *
     * @param $price
     * @return string
     */
    public function getPriceAttribute($price)
    {
        return '$' . $price;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    /**
     * Save a related photo.
     *
     * @param Photo $photo
     * @return false|Model
     */
    public function addPhoto(Photo $photo)
    {
        return $this->photos()->save($photo);
    }
}
