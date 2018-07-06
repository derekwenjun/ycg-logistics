<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * 一个运单属于一个网点
     */
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
}
