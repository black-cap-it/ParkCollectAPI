<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
class apiLogout extends Controller
{
    public function logout(request $request) {
       
        $validator = Validator::make($request->all(), [
            'remember_token' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['data' => ['remember_token'=>'The remember token field is required']]);
            } else {
                $token = request('remember_token');
                $outputUser = User::where(['remember_token' => $token])->first();
                // Token check
                if ($outputUser != null) {
                    $data = User::where(['remember_token' => $token])->first();
                    $data->remember_token = ""; 
                    $data->save(); 
                    return response()->json(['data' => [
                 'response' => 'Logout Successfully',
                  ]]);
                }
                else {
                    $success['error'] =  'Token not Valid';
                    return response()->json(['data' => $success]);
                }
                // token end
            }
    }
}
