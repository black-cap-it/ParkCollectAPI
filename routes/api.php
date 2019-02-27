<?php

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

Route::middleware('auth:api')->post('/user', function (Request $request) {
    return $request->user();
});
// Route::post('/login', 'apiController@index');

Route::post('register', 'registerApi@index');

Route::post('parking', 'parkingApi@index');

Route::post('complaints', 'complaintsApi@index');

Route::post('login', function (Request $request) {

    // if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
    //     // Authentication passed...
    //     $user = auth()->user();
    //     // $user->remember_token = str_random(60);
    //     $user->save();
    //     return $user;
    // }


    if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
        $user = auth()->user();
        $success['remember_token'] =  $user->remember_token;
        $output = User::where(['remember_token' => $user->remember_token])->first();
        // return response()->json(['success' => $success]);
        return response()->json([$output]);
    }

    return response()->json([
        'error' => 'Unauthenticated user',
        'code' => 401,
    ], 401);
});

Route::post('profile', function (Request $request) {
    $token = request('remember_token');
    $output = User::where(['remember_token' => $token])->first();
    if ($output != null) {
        return response()->json($output->toArray());
    } else {
        return response()->json(['error'=>'data not found']);
    }
});

Route::post('profile-update', function (Request $request) {
    $token = request('remember_token');

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

    $output = User::all();
    return response()->json($output->toArray());
});
