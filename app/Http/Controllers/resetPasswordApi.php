<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Validator;
use App\Mail\resetPasswordMail;
use Illuminate\Support\Facades\Mail;

class resetPasswordApi extends Controller
{
    public function reset(request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['data' => $validator->messages()], 200);
        } else {
            $email = $request->input('email');
            $password = $request->input('password');
            $userData = User::where(['email' => $email])->first();
            $remember_token['remember_token'] =  $userData->remember_token;
            $remember_token_j = $remember_token['remember_token'];

            // Email sending
            $objDemo = new \Swift_SendmailTransport();
            $objDemo->sender = 'Black Cap IT';
            $objDemo->receiver = $email;
            $objDemo->password = $password;
            $objDemo->token = $remember_token_j;
 
            Mail::to($email)->send(new resetPasswordMail($objDemo));
            // Email sending
      
            return response()->json(['data' => [
                'email' => $email,
                'remember_token' => $remember_token_j,
                'response' => '1' ]]);
        }
    }
    public function resetlink($token, $password)
    {
        $output = User::where(['remember_token' => $token])->first();
        if ($output != null) {
            $reset = User::where(['remember_token' => $token])->first();
            $reset->password = Hash::make($password);
            $reset->save();
            return redirect('http://parkcollect.draft-box.de/response/reset-success.html');
        } else {
            return redirect('http://parkcollect.draft-box.de/response/reset-fail.html');
        }
    }
}
