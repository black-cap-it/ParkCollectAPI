<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Hash;
use Validator;
use App\Mail\regEmail;
use Illuminate\Support\Facades\Mail;

class registerApi extends Controller
{
    public function index(request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['data' => [
                'response' => '0',
                'message' => 'The email field is required OR already registered!'
                ]]);
        } else {
            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');
            $password = Hash::make($password);
            $remember_token = Str::random(60);


            // Email sending
            $objDemo = new \Swift_SendmailTransport();
            $objDemo->sender = 'Black Cap IT';
            $objDemo->receiver = $email;
            $objDemo->token = $remember_token;
 
            Mail::to($email)->send(new regEmail($objDemo));

            // Email sending
    
        
            $register = new User;
            $register->name = $name;
            $register->email = $email;
            $register->password = $password;
            $register->remember_token = $remember_token;
            $register->save();


            
            return response()->json([
                'data' => 
                [
                    'name' => $name ,
                     'email' => $email,
                      'remember_token' => $remember_token,
                      'response' => '1',
                      'message' => 'Registration Successful',
             ]]);
        }
    }
}
