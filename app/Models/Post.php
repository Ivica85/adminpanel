<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    public function sluggable(){
        return ['slug'=>[
            'source'=>'title',

        ]];
    }

    protected $fillable = [
        'user_id',
        'category_id',
        'photo_id',
        'title',
        'body'
    ];

    public function user(){
       return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function photo(){
        return $this->belongsTo('App\Models\Photo', 'photo_id');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment','post_id');
    }

    public function photoPlaceholder(){
        return "https://via.placeholder.com/500x400";
    }

}
