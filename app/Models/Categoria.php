<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ['titulo', 'cor', 'user_id'];

    public function videos(){
    	return $this->hasMany('App\Models\Video');
    }
}
