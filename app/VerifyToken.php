<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyToken extends Model
{
    protected $fillable = [
        'token',
    ];

    public function member()
    {
        return $this->belongsTo('App\Member');
    }

    public function getRouteKeyName()
    {
        return 'token';
    }
}
