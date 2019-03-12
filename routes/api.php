<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
// Login
Route::post('login', 'apiLogin@login');
// register
Route::post('register', 'registerApi@index');
// parking
Route::post('parking', 'parkingApi@index');
Route::post('parking/view', 'parkingApi@viewAll');
Route::post('parking/view/{id}', 'parkingApi@view');
Route::post('parking/edit/{id}', 'parkingApi@edit');
Route::post('parking/delete/{id}', 'parkingApi@delete');
// complaints
Route::post('complaints', 'complaintsApi@index');
Route::post('complaints/view', 'complaintsApi@viewAll');
Route::post('complaints/view/{id}', 'complaintsApi@view');
Route::post('complaints/edit/{id}', 'complaintsApi@edit');
Route::post('complaints/delete/{id}', 'complaintsApi@delete');
// logout
Route::post('logout', 'apiLogout@logout');
// profile
Route::post('profile', 'apiProfile@profile');
// profile update
Route::post('profile/edit','apiProfile@profileUpdate' );
//Verify Registration Email
Route::get('mails/demo_plain', function(){
    return view('mails/demo_plain');
});
Route::get('mails/demo', function(){
    return view('mails/demo');
});