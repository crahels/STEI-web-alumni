<?php

namespace App;


use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use Notifiable;
    //protected $guard = 'member';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nim','name', 'email', 'phone_number', 'interest', 'company',
    ];

    public function accounts(){
        return $this->hasMany('App\LinkedSocialAccount');
    }

    protected $hidden = [
        'remember_token',
    ];

    public function verifyToken(){
        return $this->hasOne('App\VerifyToken');
    }   

    public function rate_answers() {
        return $this->belongsToMany('App\Answer', 'ratings', 'user_id', 'answer_id')->withPivot('id');
    }

    public function questions() {
        return $this->hasMany('App\Question');
    }

    public function answers() {
        return $this->hasMany('App\Answer');
    }
}
