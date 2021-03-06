<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'date'
    ];

    public function students() {
        return $this->belongsToMany('App\Student');
    }

    protected $table = 'lessons';
}