<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_active',
        'role_id',
        'photo_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    public function role(){
        return $this->belongsTo('App\Models\Role','role_id');
    }

    public function photo(){
        return $this->belongsTo('App\Models\Photo','photo_id');
    }




    public function isAdmin(){
        if(Auth::user()->role_id != 0){
            if($this->role->name  == "administrator" && $this->is_active == 1 ){

                return true;
            }

            return false;

          }
        }


        public function posts(){
            return $this->hasMany('App\Models\Post','user_id');
        }


}
