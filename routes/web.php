<?php


Route::get('/', 'HomeController@index');

Route::get('mails/demo_plain', function(){
    return view('mails/demo_plain');
});
Route::get('mails/demo', function(){
    return view('mails/demo');
});

Route::get('confirm-email/{token}', 'confirmToken@index');

Route::get('confirm', function(){
    return view('confirm');
});

// auth routes
Auth::routes();
