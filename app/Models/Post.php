<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

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

}
