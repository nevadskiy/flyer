<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function flyers()
    {
        return $this->hasMany(Flyer::class);
    }

    /**
     * If a user owns a given relation.
     *
     * @param Model $relation
     * @return bool
     */
    public function owns(Model $relation)
    {
        return $this->id === $relation->user_id;
    }

    /**
     * Publish a given flyer.
     *
     * @param Flyer $flyer
     * @return false|Model
     */
    public function publish(Flyer $flyer)
    {
        return $this->flyers()->save($flyer);
    }
}
