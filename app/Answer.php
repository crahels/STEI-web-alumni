<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function question() {
        return $this->belongsTo('App\Question');
    }

    public function users() {
        return $this->belongsToMany('App\User', 'ratings', 'answer_id', 'user_id')->withPivot('id');
    }
}
