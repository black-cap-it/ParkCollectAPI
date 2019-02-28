<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Auth;
class apiLogin extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = auth()->user();
            $email['email'] =  $user->email;
            $Token = User::where(['email' => $email])->first();
            $tokenGenerate = Str::random(60);
            $Token->remember_token = $tokenGenerate;
            $Token->save();
            $success['remember_token'] =  $tokenGenerate;
            return response()->json(['data' => $success]);
        }
        return response()->json(['data' => [
            'error' => 'Unauthenticated User',
            'code' => 401,
        ]], 401);
    }
}
