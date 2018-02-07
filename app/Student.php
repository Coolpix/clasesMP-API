<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name','phone_number','gender'
    ];

    public function groups() {
        return $this->belongsToMany('App\Group');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'students';


}