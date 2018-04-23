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

    public function member() {
        return $this->belongsTo('App\Member');
    }

    public function question() {
        return $this->belongsTo('App\Question');
    }

    public function members() {
        return $this->belongsToMany('App\Member', 'ratings', 'answer_id', 'user_id')->withPivot('id');
    }
}
