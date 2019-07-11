<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    //dd($users);

    return view('admin.home');
})->name('home');

Route::get('/admins','AdminAuth\AdminsController@index')->name('index.admin');
Route::get('/admins/add','AdminAuth\AdminsController@create')->name('add.admin');
Route::post('/admins/add','AdminAuth\AdminsController@store')->name('create.admin');

Route::get('/admins/edit/{admin}','AdminAuth\AdminsController@edit')->name('edit.admin');
Route::post('/admins/edit/{admin}','AdminAuth\AdminsController@update')->name('update.admin');

Route::delete('/admins/delete/{admin}','AdminAuth\AdminsController@destroy')->name('delete.admin');
