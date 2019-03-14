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
            // Token check
            if ($output != null) {
                $emailget = $output['email'];

                // $file = $request->file('image');
                $folder_name = date('Ymd') . '_' . mt_rand(1000, 990000);
                File::makeDirectory(public_path() . '/complaints_images/' . $folder_name, 0777, true);
                $destinationPath = ('complaints_images/' . $folder_name);
                $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                $pin = mt_rand(1000000, 9999999)
                    . mt_rand(1000000, 9999999)
                        . $characters[rand(0, strlen($characters) - 1)];

                $string = str_shuffle($pin);
                // $imagename = $string . '.' . $file->getClientOriginalExtension();
                // $thumb_img = Image::make($file->getRealPath());
                // $thumb_img->save($destinationPath . '/' . $imagename, 100);
            
             
                $zeitpunkt = $request->input('zeitpunkt');
                $park_id = $request->input('park_id');
                $park_platz = $request->input('park_platz');
                $grund = $request->input('grund');
                $tarif = $request->input('tarif');
                $telefon = $request->input('telefon');
                $status = $request->input('status');
                // $image = $destinationPath.'/'.$imagename;

                // Base 64 image Operation
                $data = $request->input('image');
                $data = str_replace('data:image/png;base64,', '', $data);
                $data = str_replace(' ', '+', $data);
                $string2 = $string .''. str_random(10).'.'.'png';
                $pathImage = $destinationPath.'/'. $string2;
                File::put(public_path(). '/'.$destinationPath .'/'. $string2, base64_decode($data));
                // Base 64 End
           
                $complaints = new complaints;
                $complaints->userid = $emailget;
                $complaints->park_id = $park_id;
                $complaints->park_platz = $park_platz;
                
                $complaints->zeitpunkt = $zeitpunkt;
               
                $complaints->grund = $grund;
                $complaints->tarif = $tarif;
                $complaints->telefon = $telefon;
                $complaints->image = $pathImage;
                $complaints->status = $status;

                
                $complaints->save();
            
                return response()->json(['data' => [
                'userid' => $emailget,
                'park_id' => $park_id,
                'park_platz' => $park_platz,
                'zeitpunkt' => $zeitpunkt,
                'grund' => $grund,
                'tarif' => $tarif,
                'telefon' => $telefon,
                'image' => $pathImage,
                'status' => $status,
                'response' => '1',
                'message' => 'Success'
         ]]);
            } else {
                $success['response'] =  '0';
                $success['message'] =  'Token not Valid';
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
                $output = complaints::where(['userid' => $emailget])->get();
                if ($output != null) {
                    $response['response'] =  '1';
                    $response['message'] =  'Success';
                    return response()->json(['data' => $output,'response' => $response]);
                } else {
                    $success['response'] =  '0';
                    $success['message'] =  'Data not found';
                    return response()->json(['data' => $success]);
                }
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
                $output = complaints::where(['id' => $id])->first();
                if ($output != null) {
                    $output['response'] =  '1';
                    $output['message'] =  'Success';
                    return response()->json(['data' => $output]);
                } else {
                    $success['response'] =  '0';
                    $success['message'] =  'Data not found';
                    return response()->json(['data' => $success]);
                }
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
                $output = complaints::where(['id' => $id])->first();

                //complaints data check
                if ($output != null) {
                    $emailget = $outputUser['email'];
                    if ($request->has('image')) {
                        // $file = $request->file('image');
                        $folder_name = date('Ymd') . '_' . mt_rand(1000, 990000);
                        File::makeDirectory(public_path() . '/complaints_images/' . $folder_name, 0777, true);
                        $destinationPath = ('complaints_images/' . $folder_name);
                        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

                        $pin = mt_rand(1000000, 9999999)
                    . mt_rand(1000000, 9999999)
                        . $characters[rand(0, strlen($characters) - 1)];

                        $string = str_shuffle($pin);
                        // $imagename = $string . '.' . $file->getClientOriginalExtension();
                        // $thumb_img = Image::make($file->getRealPath());
                        // $thumb_img->save($destinationPath . '/' . $imagename, 100);
            
                      
                        $zeitpunkt = $request->input('zeitpunkt');
                        $park_id = $request->input('park_id');
                        $park_platz = $request->input('park_platz');
                        
                        $grund = $request->input('grund');
                        $tarif = $request->input('tarif');
                        $telefon = $request->input('telefon');
                        $status = $request->input('status');
                        // $image = $destinationPath.'/'.$imagename;

                        // Base 64 image Operation
                        $data = $request->input('image');
                        $data = str_replace('data:image/png;base64,', '', $data);
                        $data = str_replace(' ', '+', $data);
                        $string2 = $string .''. str_random(10).'.'.'png';
                        $pathImage = $destinationPath.'/'. $string2;
                        File::put(public_path(). '/'.$destinationPath .'/'. $string2, base64_decode($data));
                        // Base 64 End
           
                        $complaints = complaints::where(['id' => $id])->first();
                        $complaints->userid = $emailget;
                        $complaints->park_id = $park_id;
                        $complaints->park_platz = $park_platz;
                      
                        $complaints->zeitpunkt = $zeitpunkt;
                       
                        $complaints->grund = $grund;
                        $complaints->tarif = $tarif;
                        $complaints->telefon = $telefon;
                        $complaints->image = $pathImage;
                        $complaints->status = $status;
                        
                        $complaints->save();
            
                        return response()->json(['data' => [
                            'userid' => $emailget,
               
                'zeitpunkt' => $zeitpunkt,
                'park_id' => $park_id,
                'park_platz' =>$park_platz,
                'grund' => $grund,
                'tarif' => $tarif,
                'telefon' => $telefon,
                'image' => $pathImage,
                'status' => $status,
                'response' => '1',
                'message' => 'Success'
         ]]);
                    } else {
                        $zeitpunkt = $request->input('zeitpunkt');
                        $park_id = $request->input('park_id');
                        $park_platz = $request->input('park_platz');
                        $grund = $request->input('grund');
                        $tarif = $request->input('tarif');
                        $telefon = $request->input('telefon');
                        $status = $request->input('status');
               
                        $complaints = complaints::where(['id' => $id])->first();
                        $complaints->userid = $emailget;
                        $complaints->park_id = $park_id;
                        $complaints->park_platz = $park_platz;
                      
                        $complaints->zeitpunkt = $zeitpunkt;
                       
                        $complaints->grund = $grund;
                        $complaints->tarif = $tarif;
                        $complaints->telefon = $telefon;
                        $complaints->status = $status;
                        $complaints->save();
            
                        return response()->json(['data' => [
                            'userid' => $emailget,
              
                'zeitpunkt' => $zeitpunkt,
                'park_id' => $park_id,
                'park_platz' => $park_platz,
                'grund' => $grund,
                'tarif' => $tarif,
                'telefon' => $telefon,
                'status' => $status,
                'response' => '1',
                'message' => 'Success'
         ]]);
                    }
                } else {
                    $success['response'] =  '0';
                    $success['message'] =  'Data not found';
                    return response()->json(['data' => $success]);
                }
                // complaints end
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
                $output = complaints::where(['id' => $id])->first();
                //complaints data check
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
                //complaints end
            } else {
                $success['response'] =  '0';
                $success['message'] =  'Token not Valid';
                return response()->json(['data' => $success]);
            }
            // token end
        }
    }
}
