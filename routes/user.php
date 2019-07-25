<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('user')->user();

    //dd($users);

    return view('user.home');
})->name('home');

Route::get('/my_profile','UserAuth\UsersController@index')->name('profile');

Route::get('/my_profile/edit/{user}','UserAuth\UsersController@edit')->name('edit.profile');
Route::post('/my_profile/edit/{user}','UserAuth\UsersController@update')->name('update.profile');

Route::get('/bookings','UserAuth\Bookings@index')->name('bookings');

Route::get('/oldbookings','UserAuth\Bookings@oldbookings')->name('oldbookings');

Route::get('/penalties','UserAuth\Bookings@penalties')->name('penalties');

Route::get('/book/{book_id}','UserAuth\BooksController@show')->name('show');

Route::get('/changepassword/{user}','UserAuth\UsersController@changepassword')->name('changepassword');
Route::post('/changepassword/{user}','UserAuth\UsersController@updatepassword')->name('updatepassword');

Route::get('/delete/{user}','UserAuth\UsersController@delete')->name('delete');
Route::post('/delete/{user}','UserAuth\UsersController@confirmdelete')->name('confirmdelete');
