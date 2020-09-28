<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function store(Request $request)
    {
    	$data = $request->validate([
    		'categoria' => 'required',
    		'titulo' => 'required',
    		'url' => 'required'
    	]);

    	Video::create([
    		'titulo' => $data['titulo'],
    		'url' => $data['url'],
    		'categoria_id' => $data['categoria'],
            'user_id' => auth('api')->user()->id
    	]);

    	return response()->json(null,201);
    }
}
