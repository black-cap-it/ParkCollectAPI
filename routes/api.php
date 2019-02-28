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


Route::group(['middleware' => ['api']], function () {
    // parking
    Route::post('parking', 'parkingApi@index');
    Route::get('parking-view/{id}', 'parkingApi@view');
    Route::post('parking/edit/{id}', 'parkingApi@edit');
    Route::get('parking/delete/{id}', 'parkingApi@delete');

    // complaints
    Route::post('complaints', 'complaintsApi@index');
    Route::get('complaints-view/{id}', 'complaintsApi@view');
    Route::post('complaints/edit/{id}', 'complaintsApi@edit');
    Route::get('complaints/delete/{id}', 'complaintsApi@delete');
});


Route::group(['middleware' => ['api']], function () {
    Route::get('logout', 'apiLogout@logout');
});

Route::post('login', function (Request $request) {

    if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
        $user = auth()->user();
        $email['email'] =  $user->email;
        $Token = User::where(['email' => $email])->first();
        $tokenGenerate = Str::random(60);
        $Token->remember_token = $tokenGenerate;
        $Token->save();
        $success['remember_token'] =  $user->remember_token;
        return response()->json($success);
    }
    return response()->json([
        'error' => 'Unauthenticated User',
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
