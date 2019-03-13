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
            $status['status'] =  $user->status;
            $status_j = $status['status'];

            if ($status['status'] != '0') {
                $Token = User::where(['email' => $email,'status' => '1'])->first();
                $tokenGenerate = Str::random(60);
                $Token->remember_token = $tokenGenerate;
                $Token->save();
                $success['remember_token'] =  $tokenGenerate;
                return response()->json(['data' => $success]);
            } else {
                return response()->json(['data' => [
                    'error' => 'Account not verified yet',
                    'status' => $status_j
                ]]);
            }
        }
        return response()->json(['data' => [
            'error' => 'Unauthenticated User',
            'code' => 401,
        ]], 401);
    }
}
