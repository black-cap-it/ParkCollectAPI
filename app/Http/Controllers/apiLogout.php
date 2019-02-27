<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
class apiLogout extends Controller
{
    public function logout() {
       $user = Auth::user();

        $email['email'] =  $user->email;

        $Token = User::where(['email' => $email])->first();
        $Token->remember_token = "";
        $Token->save();
        return response()->json([
            'response' => 'Logout Successfully',   
        ]);
    }
}
