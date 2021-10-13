<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class CampaignStory extends Model
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

    public function campaign()
    {
        return $this->belongsTo('App\Campaign');
    }
}
