<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class apiController extends Controller
{
    public function index(request $request)
    {
        $email = $request->input('email');
        // $password = $request->input('password');

        $loginR = User::where('email', $email)
                // ->where('password', $password)
          ->get();

        if (count($loginR)) {
            echo "ok report";
            print_r($loginR);
        } else {
            echo "wrong 234234";
        }
    }
}
