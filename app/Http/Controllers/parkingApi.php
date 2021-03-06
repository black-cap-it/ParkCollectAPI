<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\parking;
use Validator;
use File;

class parkingApi extends Controller
{
    public function index(request $request)
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
                $emailget = $output['email'];

                // $file = $request->file('image');
                $folder_name = date('Ymd') . '_' . mt_rand(1000, 990000);
                File::makeDirectory(public_path() . '/parking_images/' . $folder_name, 0777, true);
                $destinationPath = ('parking_images/' . $folder_name);
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                $pin = mt_rand(1000000, 9999999)
                    . mt_rand(1000000, 9999999)
                        . $characters[rand(0, strlen($characters) - 1)];

                $string = str_shuffle($pin);
                // $imagename = $string . '.' . $file->getClientOriginalExtension();
                // $thumb_img = Image::make($file->getRealPath());
                // $thumb_img->save($destinationPath . '/' . $imagename, 100);
            
                $xcord = $request->input('xcord');
                $ycord = $request->input('ycord');
                $parkplatz = $request->input('parkplatz');
                $strab = $request->input('strab');
                $haus = $request->input('haus');
                $plz = $request->input('plz');
                $ort = $request->input('ort');
                // $image = $destinationPath.'/'.$imagename;

                // Base 64 image Operation
                $data = $request->input('image');
                $data = str_replace('data:image/png;base64,', '', $data);
                $data = str_replace(' ', '+', $data);
                $string2 = $string .''. str_random(10).'.'.'png';
                $pathImage = $destinationPath.'/'. $string2;
                File::put(public_path(). '/'.$destinationPath .'/'. $string2, base64_decode($data));
                // Base 64 End
           
                $parking = new parking;
                $parking->userid = $emailget;
                $parking->xcord = $xcord;
                $parking->ycord = $ycord;
                $parking->parkplatz = $parkplatz;
                $parking->strab = $strab;
                $parking->haus = $haus;
                $parking->plz = $plz;
                $parking->ort = $ort;
                $parking->image = $pathImage;
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
                'image' => $pathImage,
                'response' => '1',
                'message' => 'Success'
         ]]);
            } else {
                $success['response'] =  '0';
                $success['message'] =  'Token not Valid';
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
            return response()->json(['data' => [
                'response' => '0',
                'message' => 'The remember token field is required'
                ]]);
        } else {
            $token = request('remember_token');
            $outputUser = User::where(['remember_token' => $token])->first();
            // Token check
            if ($outputUser != null) {
                $emailget = $outputUser['email'];
                $output = parking::where(['userid' => $emailget])->get();
       
                //Parking data check
                if ($output != null) {
                    $response['response'] =  '1';
                    $response['message'] =  'Success';
                    return response()->json(['data' => $output,'response' => $response]);
                } else {
                    $success['response'] =  '0';
                    $success['message'] =  'Data not found';
                    return response()->json(['data' => $success]);
                }
                // parking end
            } else {
                $success['response'] =  '0';
                $success['message'] =  'Token not Valid';
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
            return response()->json(['data' => [
                'response' => '0',
                'message' => 'The remember token field is required'
                ]]);
        } else {
            $token = request('remember_token');
            $outputUser = User::where(['remember_token' => $token])->first();
        
            // Token check
            if ($outputUser != null) {
                $output = parking::where(['id' => $id])->first();
       
                //Parking data check
                if ($output != null) {
                    $output['response'] =  '1';
                    $output['message'] =  'Success';
                    return response()->json(['data' => $output]);
                } else {
                    $success['response'] =  '0';
                    $success['message'] =  'Data not found';
                    return response()->json(['data' => $success]);
                }
                // parking end
            } else {
                $success['response'] =  '0';
                $success['message'] =  'Token not Valid';
                return response()->json(['data' => $success]);
            }
            // token end
        }
    }
    public function edit(request $request, $id)
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
            $outputUser = User::where(['remember_token' => $token])->first();
            // Token check
            if ($outputUser != null) {
                $output = parking::where(['id' => $id])->first();
       
                //Parking data check
                if ($output != null) {
                    $emailget = $outputUser['email'];
                    if ($request->has('image')) {
                        // $file = $request->file('image');
                        $folder_name = date('Ymd') . '_' . mt_rand(1000, 990000);
                        File::makeDirectory(public_path() . '/parking_images/' . $folder_name, 0777, true);
                        $destinationPath = ('parking_images/' . $folder_name);
                        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                        $pin = mt_rand(1000000, 9999999)
                    . mt_rand(1000000, 9999999)
                        . $characters[rand(0, strlen($characters) - 1)];

                        $string = str_shuffle($pin);
                        // $imagename = $string . '.' . $file->getClientOriginalExtension();
                        // $thumb_img = Image::make($file->getRealPath());
                        // $thumb_img->save($destinationPath . '/' . $imagename, 100);
            
                        $xcord = $request->input('xcord');
                        $ycord = $request->input('ycord');
                        $parkplatz = $request->input('parkplatz');
                        $strab = $request->input('strab');
                        $haus = $request->input('haus');
                        $plz = $request->input('plz');
                        $ort = $request->input('ort');
                        // $image = $destinationPath.'/'.$imagename;

                        // Base 64 image Operation
                        $data = $request->input('image');
                        $data = str_replace('data:image/png;base64,', '', $data);
                        $data = str_replace(' ', '+', $data);
                        $string2 = $string .''. str_random(10).'.'.'png';
                        $pathImage = $destinationPath.'/'. $string2;
                        File::put(public_path(). '/'.$destinationPath .'/'. $string2, base64_decode($data));
                        // Base 64 End
           
                        $parking = parking::where(['id' => $id])->first();
                        $parking->userid = $emailget;
                        $parking->xcord = $xcord;
                        $parking->ycord = $ycord;
                        $parking->parkplatz = $parkplatz;
                        $parking->strab = $strab;
                        $parking->haus = $haus;
                        $parking->plz = $plz;
                        $parking->ort = $ort;
                        $parking->image = $pathImage;
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
                'image' => $pathImage,
                'response' => '1',
                'message' => 'Success'
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
                'response' => '1',
                'message' => 'Success'
         ]]);
                    }
                } else {
                    $success['response'] =  '0';
                    $success['message'] =  'Data not found';
                    return response()->json(['data' => $success]);
                }
                // parking end
            } else {
                $success['response'] =  '0';
                $success['message'] =  'Token not Valid';
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
            return response()->json(['data' => [
                'response' => '0',
                'message' => 'The remember token field is required'
                ]]);
        } else {
            $token = request('remember_token');
            $outputUser = User::where(['remember_token' => $token])->first();
        
            // Token check
            if ($outputUser != null) {
                $output = parking::where(['id' => $id])->first();

                if ($output != null) {
                    $output->delete();
                    return response()->json(['data' => [
                        'response' => '1',
                        'message'=>'Data Deleted Successfully'
                       ]]);
                } else {
                    return response()->json(['data' => [
                        'response' => '0',
                        'message'=>'Data not found'
                        ]]);
                }
                // parking end
            } else {
                $success['response'] =  '0';
                $success['message'] =  'Token not Valid';
                return response()->json(['data' => $success]);
            }
            // token end
        }
    }
}
