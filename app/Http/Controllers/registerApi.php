<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Hash;
use Validator;

class registerApi extends Controller
{
    public function index(request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users'
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        } else {
            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');
            $password = Hash::make($password);
            $remember_token = Str::random(60);
        
            $register = new User;
            $register->name = $name;
            $register->email = $email;
            $register->password = $password;
            $register->remember_token = $remember_token;
            $register->save();
            
            return response()->json(['name' => $name , 'email' => $email, 'remember_token' => $remember_token,'response' => '1' ]);
        }
    }
}
