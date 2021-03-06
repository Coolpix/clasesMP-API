<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model {
    protected $fillable = [
        'name','date_start','date_end', 'time_start','time_end'
    ];

    public function zone() {
        return $this->belongsTo('App\Zone');
    }

    public function students() {
        return $this->belongsToMany('App\Student');
    }

    public function lessons() {
        return $this->hasMany('App\Lesson');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'courses';

}