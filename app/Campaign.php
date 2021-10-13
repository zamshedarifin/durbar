<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;


class Campaign extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ],
            'slug_bn'=>[
                'source'=>'title_bn'
            ]
        ];
    }
    public function stories()
    {
        return $this->hasMany('App\CampaignStory');
    }

    public function competitions()
    {
        // return $this->hasMany('App\Competition')->where('end_date', '>=', date('Y-m-d H:i:s'))->orderBy('id', 'asc')->where('status',1);
        return $this->hasMany('App\Competition')->orderBy('id', 'asc')->where('status',1);
    }

    public function enrolls()
    {
        return $this->hasMany('App\CampaignEnroll');
    }

    public function quiz()
    {
        return $this->hasMany('App\Quiz')->where('status',1);
    }

}
