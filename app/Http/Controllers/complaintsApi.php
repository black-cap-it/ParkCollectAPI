<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\complaints;
use Validator;
use File;
use Image;
use Auth;

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
            $zeitpunkt = $request->input('zeitpunkt');
            $parkplatz = $request->input('parkplatz');
            $grund = $request->input('grund');
            $tarif = $request->input('tarif');
            $telefon = $request->input('telefon');
            $image = $destinationPath.'/'.$imagename;
           
            $parking = new complaints;
            $parking->userid = '112';
            $parking->xcord = $xcord;
            $parking->ycord = $ycord;
            $parking->zeitpunkt = $zeitpunkt;
            $parking->parkplatz = $parkplatz;
            $parking->grund = $grund;
            $parking->tarif = $tarif;
            $parking->telefon = $telefon;
            $parking->image = $destinationPath.'/'.$imagename;
            $parking->save();
            
            return response()->json([
                'xcord' => $xcord ,
                'ycord' => $ycord,
                'zeitpunkt' => $zeitpunkt,
                'parkplatz' => $parkplatz,
                'grund' => $grund,
                'tarif' => $tarif,
                'telefon' => $telefon,
                'image' => $image,
                'response' => '1'
         ]);
        }
    }
}
