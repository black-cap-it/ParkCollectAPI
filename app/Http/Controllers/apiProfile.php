<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Validator;

class apiProfile extends Controller
{
    public function profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'remember_token' => 'required'
            ]);
        if ($validator->fails()) {
            return response()->json(['data' => [
                'response' => '0',
                'message' => 'The remember token field is required'
                ]]);
        } else {
            $token = request('remember_token');
            $output = User::where(['remember_token' => $token])->first();
            if ($output != null) {
                $output['response'] =  '1';
                $output['message'] =  'Success';
                return response()->json(['data' => $output]);
            } else {
                $success['response'] =  '0';
                $success['message'] =  'Data not found';
                return response()->json(['data' => $success]);
            }
        }
    }
    public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'remember_token' => 'required'
            ]);

        if ($validator->fails()) {
            return response()->json(['data' => [
                'response' => '0',
                'message' => 'The remember token field is required'
                ]]);
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

                $account_holder = request('account_holder');
                $iban = request('iban');
                $signature = request('signature');

                // Agree check
                $agree = request('agree');

                $profiledata = User::where(['remember_token' => $token])->first();
                $agreeValue = $profiledata['agree'];

                if ($agreeValue == 0) {
                    if ($agree != null) {
                        $agree2 = request('agree');
                    } else {
                        $agree2 = '0';
                    }
                }
                // Agree check
    
    
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

                $profile->account_holder = $account_holder;
                $profile->iban = $iban;
                $profile->signature = $signature;
                // Agree check
                if ($agreeValue == 0) {
                    $profile->agree = $agree2;
                }
                // Agree check
                $profile->save();
    
                $output = User::where(['remember_token' => $token])->first();
                $output['response'] =  '1';
                $output['message'] =  'Profile updated';
                return response()->json(['data' => $output]);
            } else {
                $success['response'] =  '0';
                $success['message'] =  'Token not Valid';
                return response()->json(['data' => $success]);
            }
        }
    }
}
