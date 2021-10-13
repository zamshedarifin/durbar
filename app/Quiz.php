<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function marks()
    {
        return $this->hasMany('App\Mark')->orderBy('mark','desc')
            ->orderBy('seconds','asc');
    }

    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }
}
