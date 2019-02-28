<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\parking;
use Validator;
use File;
use Image;

class parkingApi extends Controller
{
    public function index(request $request)
    {
        $validator = Validator::make($request->all(), [
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1048',
            'xcord' => 'required',
            'ycord' => 'required',
            'parkplatz' => 'required',
            'strab' => 'required',
            'haus' => 'required',
            'plz' => 'required',
            'ort' => 'required',
            'image' => 'required',
            'remember_token' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['data' => $validator->messages()], 200);
        } else {
            $token = request('remember_token');
            $output = User::where(['remember_token' => $token])->first();

            if ($output != null) {
                $emailget = $output['email'];

                $file = $request->file('image');
                $folder_name = date('Ymd') . '_' . mt_rand(1000, 990000);
                File::makeDirectory(public_path() . '/parking_images/' . $folder_name, 0777, true);
                $destinationPath = ('parking_images/' . $folder_name);
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
                $parkplatz = $request->input('parkplatz');
                $strab = $request->input('strab');
                $haus = $request->input('haus');
                $plz = $request->input('plz');
                $ort = $request->input('ort');
                $image = $destinationPath.'/'.$imagename;
           
                $parking = new parking;
                $parking->userid = $emailget;
                $parking->xcord = $xcord;
                $parking->ycord = $ycord;
                $parking->parkplatz = $parkplatz;
                $parking->strab = $strab;
                $parking->haus = $haus;
                $parking->plz = $plz;
                $parking->ort = $ort;
                $parking->image = $destinationPath.'/'.$imagename;
                $parking->save();
            
                return response()->json(['data' => [
                'userid' => $emailget,
                'xcord' => $xcord ,
                'ycord' => $ycord,
                'parkplatz' => $parkplatz,
                'strab' => $strab,
                'haus' => $haus,
                'plz' => $plz,
                'ort' => $ort,
                'image' => $image,
                'response' => '1'
         ]]);
            } else {
                $success['error'] =  'Token not Valid';
                return response()->json(['data' => $success]);
            }
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
                $output = parking::where(['userid' => $emailget])->get();
       
                //Parking data check
                if ($output != null) {
                    return response()->json(['data' => $output]);
                } else {
                    return response()->json(['data' => ['error'=>'Data not found']]);
                }
                // parking end
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
                $output = parking::where(['id' => $id])->first();
       
                //Parking data check
                if ($output != null) {
                    return response()->json(['data' => $output]);
                } else {
                    return response()->json(['data' => ['error'=>'Data not found']]);
                }
                // parking end
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
            'parkplatz' => 'required',
            'strab' => 'required',
            'haus' => 'required',
            'plz' => 'required',
            'ort' => 'required',
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
                $output = parking::where(['id' => $id])->first();
       
                //Parking data check
                if ($output != null) {
                    $emailget = $output['email'];
                    if ($request->has('image')) {
                        $file = $request->file('image');
                        $folder_name = date('Ymd') . '_' . mt_rand(1000, 990000);
                        File::makeDirectory(public_path() . '/parking_images/' . $folder_name, 0777, true);
                        $destinationPath = ('parking_images/' . $folder_name);
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
                        $parkplatz = $request->input('parkplatz');
                        $strab = $request->input('strab');
                        $haus = $request->input('haus');
                        $plz = $request->input('plz');
                        $ort = $request->input('ort');
                        $image = $destinationPath.'/'.$imagename;
           
                        $parking = parking::where(['id' => $id])->first();
                        $parking->userid = $emailget;
                        $parking->xcord = $xcord;
                        $parking->ycord = $ycord;
                        $parking->parkplatz = $parkplatz;
                        $parking->strab = $strab;
                        $parking->haus = $haus;
                        $parking->plz = $plz;
                        $parking->ort = $ort;
                        $parking->image = $destinationPath.'/'.$imagename;
                        $parking->save();
            
                        return response()->json(['data' => [
                            'userid' => $emailget,
                'xcord' => $xcord ,
                'ycord' => $ycord,
                'parkplatz' => $parkplatz,
                'strab' => $strab,
                'haus' => $haus,
                'plz' => $plz,
                'ort' => $ort,
                'image' => $image,
                'response' => '1'
         ]]);
                    } else {
                        $xcord = $request->input('xcord');
                        $ycord = $request->input('ycord');
                        $parkplatz = $request->input('parkplatz');
                        $strab = $request->input('strab');
                        $haus = $request->input('haus');
                        $plz = $request->input('plz');
                        $ort = $request->input('ort');
               
           
                        $parking = parking::where(['id' => $id])->first();
                        $parking->userid = $emailget;
                        $parking->xcord = $xcord;
                        $parking->ycord = $ycord;
                        $parking->parkplatz = $parkplatz;
                        $parking->strab = $strab;
                        $parking->haus = $haus;
                        $parking->plz = $plz;
                        $parking->ort = $ort;
                        $parking->save();
            
                        return response()->json(['data' => [
                            'userid' => $emailget,
                'xcord' => $xcord ,
                'ycord' => $ycord,
                'parkplatz' => $parkplatz,
                'strab' => $strab,
                'haus' => $haus,
                'plz' => $plz,
                'ort' => $ort,
                'response' => '1'
         ]]);
                    }
                } else {
                    return response()->json(['data' => ['error'=>'Data not found']]);
                }
                // parking end
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
                $output = parking::where(['id' => $id])->first();

                if ($output != null) {
                    $output->delete();
                    return response()->json(['data' => ['responce'=>'Data Deleted Successfully']]);
                } else {
                    return response()->json(['data' => ['error'=>'Data not Found']]);
                }
                // parking end
            } else {
                $success['error'] =  'Token not Valid';
                return response()->json(['data' => $success]);
            }
            // token end
        }
    }
}
