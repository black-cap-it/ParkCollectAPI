<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\complaints;
use Validator;
use File;
use Image;

class complaintsApi extends Controller
{
    public function index(request $request)
    {
        $validator = Validator::make($request->all(), [
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1048',
            'xcord' => 'required',
            'ycord' => 'required',
            'zeitpunkt' => 'required',
            'parkplatz' => 'required',
            'grund' => 'required',
            'tarif' => 'required',
            'telefon' => 'required',
            'image' => 'required',
            'remember_token' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['data' => $validator->messages()], 200);
        } else {
            $token = request('remember_token');
            $output = User::where(['remember_token' => $token])->first();
            // Token check
            if ($output != null) {
                $emailget = $output['email'];

                $file = $request->file('image');
                $folder_name = date('Ymd') . '_' . mt_rand(1000, 990000);
                File::makeDirectory(public_path() . '/complaints_images/' . $folder_name, 0777, true);
                $destinationPath = ('complaints_images/' . $folder_name);
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                $pin = mt_rand(1000000, 9999999)
                    . mt_rand(1000000, 9999999)
                        . $characters[rand(0, strlen($characters) - 1)];

                $string = str_shuffle($pin);
                $imagename = $string . '.' . $file->getClientOriginalExtension();
                $thumb_img = Image::make($file->getRealPath());
                $thumb_img->save($destinationPath . '/' . $imagename, 100);
            
                $xcord = $request->input('xcord');
                $ycord = $request->input('ycord');
                $zeitpunkt = $request->input('zeitpunkt');
                $parkplatz = $request->input('parkplatz');
                $grund = $request->input('grund');
                $tarif = $request->input('tarif');
                $telefon = $request->input('telefon');
                $image = $destinationPath.'/'.$imagename;
           
                $complaints = new complaints;
                $complaints->userid = $emailget;
                $complaints->xcord = $xcord;
                $complaints->ycord = $ycord;
                $complaints->zeitpunkt = $zeitpunkt;
                $complaints->parkplatz = $parkplatz;
                $complaints->grund = $grund;
                $complaints->tarif = $tarif;
                $complaints->telefon = $telefon;
                $complaints->image = $destinationPath.'/'.$imagename;
                $complaints->save();
            
                return response()->json(['data' => [
                'userid' => $emailget,
                'xcord' => $xcord ,
                'ycord' => $ycord,
                'zeitpunkt' => $zeitpunkt,
                'parkplatz' => $parkplatz,
                'grund' => $grund,
                'tarif' => $tarif,
                'telefon' => $telefon,
                'image' => $image,
                'response' => '1'
         ]]);
            } else {
                $success['error'] =  'Token not Valid';
                return response()->json(['data' => $success]);
            }
            // token end
        }
    }
    public function viewAll(request $request)
    {
        $validator = Validator::make($request->all(), [
            'remember_token' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->messages()], 200);
        } else {
            $token = request('remember_token');
            $outputUser = User::where(['remember_token' => $token])->first();
            // Token check
            if ($outputUser != null) {
                $emailget = $outputUser['email'];
                $output = complaints::where(['userid' => $emailget])->get();
                if ($output != null) {
                    return response()->json(['data' => $output]);
                } else {
                    return response()->json(['data' => ['error'=>'data not found']]);
                }
            } else {
                $success['error'] =  'Token not Valid';
                return response()->json(['data' => $success]);
            }
            // token end
        }
    }
    public function view(request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'remember_token' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->messages()], 200);
        } else {
            $token = request('remember_token');
            $outputUser = User::where(['remember_token' => $token])->first();
            // Token check
            if ($outputUser != null) {
                $output = complaints::where(['id' => $id])->first();
                if ($output != null) {
                    return response()->json(['data' => $output]);
                } else {
                    return response()->json(['data' => ['error'=>'data not found']]);
                }
            } else {
                $success['error'] =  'Token not Valid';
                return response()->json(['data' => $success]);
            }
            // token end
        }
    }
    public function edit(request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1048',
            'xcord' => 'required',
            'ycord' => 'required',
            'zeitpunkt' => 'required',
            'parkplatz' => 'required',
            'grund' => 'required',
            'tarif' => 'required',
            'telefon' => 'required',
            'image' => 'required',
            'remember_token' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['data' => $validator->messages()], 200);
        } else {
            $token = request('remember_token');
            $outputUser = User::where(['remember_token' => $token])->first();
            // Token check
            if ($outputUser != null) {
                $output = complaints::where(['id' => $id])->first();

                //complaints data check
                if ($output != null) {
                    $emailget = $outputUser['email'];
                    if ($request->has('image')) {
                        $file = $request->file('image');
                        $folder_name = date('Ymd') . '_' . mt_rand(1000, 990000);
                        File::makeDirectory(public_path() . '/complaints_images/' . $folder_name, 0777, true);
                        $destinationPath = ('complaints_images/' . $folder_name);
                        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                        $pin = mt_rand(1000000, 9999999)
                    . mt_rand(1000000, 9999999)
                        . $characters[rand(0, strlen($characters) - 1)];

                        $string = str_shuffle($pin);
                        $imagename = $string . '.' . $file->getClientOriginalExtension();
                        $thumb_img = Image::make($file->getRealPath());
                        $thumb_img->save($destinationPath . '/' . $imagename, 100);
            
                        $xcord = $request->input('xcord');
                        $ycord = $request->input('ycord');
                        $zeitpunkt = $request->input('zeitpunkt');
                        $parkplatz = $request->input('parkplatz');
                        $grund = $request->input('grund');
                        $tarif = $request->input('tarif');
                        $telefon = $request->input('telefon');
                        $image = $destinationPath.'/'.$imagename;
           
                        $complaints = complaints::where(['id' => $id])->first();
                        $complaints->userid = $emailget;
                        $complaints->xcord = $xcord;
                        $complaints->ycord = $ycord;
                        $complaints->zeitpunkt = $zeitpunkt;
                        $complaints->parkplatz = $parkplatz;
                        $complaints->grund = $grund;
                        $complaints->tarif = $tarif;
                        $complaints->telefon = $telefon;
                        $complaints->image = $destinationPath.'/'.$imagename;
                        $complaints->save();
            
                        return response()->json(['data' => [
                            'userid' => $emailget,
                'xcord' => $xcord ,
                'ycord' => $ycord,
                'zeitpunkt' => $zeitpunkt,
                'parkplatz' => $parkplatz,
                'grund' => $grund,
                'tarif' => $tarif,
                'telefon' => $telefon,
                'image' => $image,
                'response' => '1'
         ]]);
                    } else {
                        $xcord = $request->input('xcord');
                        $ycord = $request->input('ycord');
                        $zeitpunkt = $request->input('zeitpunkt');
                        $parkplatz = $request->input('parkplatz');
                        $grund = $request->input('grund');
                        $tarif = $request->input('tarif');
                        $telefon = $request->input('telefon');
               
                        $complaints = complaints::where(['id' => $id])->first();
                        $complaints->userid = $emailget;
                        $complaints->xcord = $xcord;
                        $complaints->ycord = $ycord;
                        $complaints->zeitpunkt = $zeitpunkt;
                        $complaints->parkplatz = $parkplatz;
                        $complaints->grund = $grund;
                        $complaints->tarif = $tarif;
                        $complaints->telefon = $telefon;
                        $complaints->save();
            
                        return response()->json(['data' => [
                            'userid' => $emailget,
                'xcord' => $xcord ,
                'ycord' => $ycord,
                'zeitpunkt' => $zeitpunkt,
                'parkplatz' => $parkplatz,
                'grund' => $grund,
                'tarif' => $tarif,
                'telefon' => $telefon,
                'response' => '1'
         ]]);
                    }
                } else {
                    return response()->json(['data' => ['error'=>'Data not found']]);
                }
                // complaints end
            } else {
                $success['error'] =  'Token not Valid';
                return response()->json(['data' => $success]);
            }
            // token end
        }
    }
    public function delete(request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'remember_token' => 'required'
            ]);
        if ($validator->fails()) {
            return response()->json(['data' => $validator->messages()], 200);
        } else {
            $token = request('remember_token');
            $outputUser = User::where(['remember_token' => $token])->first();
            // Token check
            if ($outputUser != null) {
                $output = complaints::where(['id' => $id])->first();
                //complaints data check
                if ($output != null) {
                    $output->delete();
                    return response()->json(['data' => ['responce'=>'Data Deleted Successfully']]);
                } else {
                    return response()->json(['data' => ['error'=>'Data not found']]);
                }
                //complaints end
            } else {
                $success['error'] =  'Token not Valid';
                return response()->json(['data' => $success]);
            }
            // token end
        }
    }
}
