<?php

namespace Hirel;

use Illuminate\Database\Eloquent\Model;

class posts extends Model
{
    public function user(){
    	return $this->belongsTo('Hirel\User');
    }
}
