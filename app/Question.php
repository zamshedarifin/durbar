<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded=[];
    protected $table="questions";

    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }
}
