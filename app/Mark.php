<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    protected $guarded = [];
    protected $table = "marks";

    public function quiz()
    {
        return $this->belongsTo('App\Quiz');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
