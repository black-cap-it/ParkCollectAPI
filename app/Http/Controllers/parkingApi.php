<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\parking;
use Validator;
use File;
use Image;
use Auth;

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
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        } else {
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
            $parking->userid = '112';
            $parking->xcord = $xcord;
            $parking->ycord = $ycord;
            $parking->parkplatz = $parkplatz;
            $parking->strab = $strab;
            $parking->haus = $haus;
            $parking->plz = $plz;
            $parking->ort = $ort;
            $parking->image = $destinationPath.'/'.$imagename;
            $parking->save();
            
            return response()->json([
                'xcord' => $xcord ,
                'ycord' => $ycord,
                'parkplatz' => $parkplatz,
                'strab' => $strab,
                'haus' => $haus,
                'plz' => $plz,
                'ort' => $ort,
                'image' => $image,
                'response' => '1'
         ]);
        }
    }
}
