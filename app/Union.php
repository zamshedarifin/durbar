<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    public function upazila()
    {
            return $this->belongsTo('App\Upazila');
    }
}
