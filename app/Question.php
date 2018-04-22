<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';
    public $primaryKey = 'id';
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function member() {
        return $this->belongsTo('App\Member');
    }

    public function answers() {
        return $this->hasMany('App\Answer');
    }
}

