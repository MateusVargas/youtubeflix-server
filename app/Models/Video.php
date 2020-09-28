<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = ['titulo', 'url', 'categoria_id', 'user_id'];

    public function categorias(){
    	return $this->belongsTo('App\Models\Categoria');
    }
}
