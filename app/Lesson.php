<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'date'
    ];

    public function group() {
        return $this->belongsTo('App\Group');
    }

    public function students() {
        return $this->belongsToMany('App\Student');
    }

    protected $table = 'lessons';
}