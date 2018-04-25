<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name','phone_number','gender', 'email'
    ];

    public function groups() {
        return $this->belongsToMany('App\Group');
    }

    public function courses() {
        return $this->belongsToMany('App\Course');
    }

    public function lessons() {
        return $this->belongsToMany('App\Lesson');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'students';


}