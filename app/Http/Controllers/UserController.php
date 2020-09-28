<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
    	$data = $request->validate([
    		'email' => 'email|required|unique:users',
    		'password' => 'required|required_with:passwordconfirm|same:passwordconfirm|min:4',
            'passwordconfirm' => 'min:4'
    	]);

    	User::create([
    		'email' => $data['email'],
    		'password' => bcrypt($data['password'])
    	]);

    	return response()->json(null,201);
    }
}
