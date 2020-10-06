<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
    	$categorias = Categoria::where('user_id',auth('api')->user()->id)->get();
    	return response()->json($categorias,200);
    }

    public function show()
    {
        $categorias = Categoria::where('user_id',auth('api')->user()->id)
        ->with('videos')->get();
        return response()->json($categorias,200);
    }

    public function store(Request $request)
    {
    	$data = $request->validate([
    		'nome' => 'required',
    		'cor' => 'required'
    	]);

    	Categoria::create([
    		'titulo' => $data['nome'],
    		'cor' => $data['cor'],
            'user_id' => auth('api')->user()->id
    	]);

    	return response()->json(null,201);
    }
}
