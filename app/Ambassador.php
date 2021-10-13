<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ambassador extends Model
{
    protected $guarded = [];
    protected $table = 'ambassadors';

    public function district()
    {
        return $this->belongsTo('App\District');
    }

    public function upazila()
    {
        return $this->belongsTo('App\Upazila');
    }
    public function union()
    {
        return $this->belongsTo('App\Union');
    }
}
