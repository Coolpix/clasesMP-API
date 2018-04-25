<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = [
        'name',
        'latitude',
        'longitude'
    ];

    public function groups()
    {
        return $this->hasMany('App\Group');
    }

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'zones';
}