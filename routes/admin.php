<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    //dd($users);
    return view('admin.home');
})->name('home');



Route::group([
    'middleware' => 'administrator',
],function() {

    Route::get('/admins','AdminAuth\AdminsController@index')->name('index.admin');
Route::get('/admins/add','AdminAuth\AdminsController@create')->name('add.admin');
Route::post('/admins/add','AdminAuth\AdminsController@store')->name('create.admin');

Route::get('/admins/edit/{admin}','AdminAuth\AdminsController@edit')->name('edit.admin');
Route::post('/admins/edit/{admin}','AdminAuth\AdminsController@update')->name('update.admin');

Route::delete('/admins/delete/{admin}','AdminAuth\AdminsController@destroy')->name('delete.admin');
});


Route::group([
    'middleware' => 'librarian',
], function(){

    Route::get('/library', function () {
        return view('admin.auth.librarian.index');
    })->name('index.library');


    Route::get('/library/add','AdminAuth\BooksController@create')->name('add.book');
    Route::post('/library/add','AdminAuth\BooksController@store')->name('create.book');

    Route::get('/library/list','AdminAuth\BooksController@index')->name('list.book');

    Route::get('/library/edit/{book}','AdminAuth\BooksController@edit')->name('edit.book');
    Route::post('/library/edit/{book}','AdminAuth\BooksController@update')->name('update.book');
    //delete boook dodać!!!


    //dodawanie użytkownika
    Route::get('/library/adduser','AdminAuth\UsersController@create')->name('add.user');
    Route::post('/library/adduser','AdminAuth\UsersController@store')->name('create.user');

    //Akceptacja użytkoników
    Route::get('/library/acceptuser','AdminAuth\UsersController@index')->name('index.user');
    Route::post('/library/acceptuser/{user}','AdminAuth\UsersController@accept')->name('accept.user');

    //Edycja i usuwanie użytkowników
    Route::get('/library/users','AdminAuth\UsersController@index2')->name('index2.user');
    Route::get('/library/edituser/{user}','AdminAuth\UsersController@edit')->name('edit.user');
    Route::post('/library/edituser/{user}','AdminAuth\UsersController@update')->name('update.user');

    Route::delete('/library/refuse/{user}','AdminAuth\UsersController@destroy')->name('delete.user');

});



Route::group([
    'middleware' => 'viewer',
], function(){
    Route::get('/view','AdminAuth\LibraryController@index')->name('index.viewer');
});