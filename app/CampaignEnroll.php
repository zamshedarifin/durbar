<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CampaignEnroll extends Model
{
    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
