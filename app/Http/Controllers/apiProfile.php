<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;

class apiProfile extends Controller
{
    public function profile(Request $request) {

        $validator = Validator::make($request->all(), [
            'remember_token' => 'required'
            ]);
            if ($validator->fails()) {
                return response()->json(['data' => ['remember_token'=>'The remember token field is required']]);
            } else {

                $token = request('remember_token');
                $output = User::where(['remember_token' => $token])->first();
                if ($output != null) {
                    return response()->json(['data' => $output]);
                } else {
                    $success['error'] =  'Token not Valid';
                    return response()->json(['data' => $success]);
                }
            }
    }
    public function profileUpdate(Request $request) {
        $validator = Validator::make($request->all(), [
            'remember_token' => 'required'
            ]);

        if ($validator->fails()) {
            return response()->json(['data' => ['remember_token'=>'The remember token field is required']]);
        } else {
            $token = request('remember_token');
    
            $output = User::where(['remember_token' => $token])->first();
            if ($output != null) {
                $nutzung = request('nutzung');
                $anrede = request('anrede');
                $firma = request('firma');
                $vorname = request('vorname');
                $nachname = request('nachname');
                $strabe = request('strabe');
                $haus = request('haus');
                $plz = request('plz');
                $ort = request('ort');
                $telefon = request('telefon');
    
    
                $profile = User::where(['remember_token' => $token])->first();
                $profile->nutzung = $nutzung;
                $profile->anrede = $anrede;
                $profile->firma = $firma;
                $profile->vorname = $vorname;
                $profile->nachname = $nachname;
                $profile->strabe = $strabe;
                $profile->haus = $haus;
                $profile->plz = $plz;
                $profile->ort = $ort;
                $profile->telefon = $telefon;
                $profile->save();
    
                $output = User::where(['remember_token' => $token])->first();
                return response()->json(['data' => $output]);
            } else {
                $success['error'] =  'Token not Valid';
                return response()->json(['data' => $success]);
            }
        }
    }
}
