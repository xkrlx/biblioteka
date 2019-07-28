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

    Route::get('/library/delete','AdminAuth\UsersController@delete_accounts')->name('delete_accounts.user');
    Route::delete('/library/delete/{delete}','AdminAuth\UsersController@destroy_account')->name('destroy_account.user');

    //Wypożyczanie książek
    Route::get('/library/booking', 'AdminAuth\BookingController@index')->name('index.booking');
    Route::post('/library/booking','AdminAuth\BookingController@confirm')->name('confirm.booking');
    Route::post('/library/booking/{booking}','AdminAuth\BookingController@book')->name('book.booking');

    //Zwrot książki
    Route::get('/library/return-list', 'AdminAuth\ReturnController@index')->name('index.return_list');
    Route::get('/library/available-list', 'AdminAuth\ReturnController@available')->name('index.available');

    Route::get('/library/return', 'AdminAuth\ReturnController@index2')->name('index.return');
    Route::post('/library/return', 'AdminAuth\ReturnController@index_books')->name('index_books.return');
    Route::get('/library/return/{booking}', 'AdminAuth\ReturnController@confirm')->name('confirm.return');
    Route::post('/library/return/{booking}','AdminAuth\ReturnController@return')->name('return.return');

    Route::get('/library/bookings', 'AdminAuth\ReturnController@bookings')->name('bookings.return');

    //penalties
    Route::get('/library/unpaid','AdminAuth\ArrearsController@unpaid')->name('unpaid.penalties');
    Route::get('/library/paid','AdminAuth\ArrearsController@paid')->name('paid.penalties');
    Route::post('/library/pay/{penalty}','AdminAuth\ArrearsController@pay')->name('pay.penalties');

    Route::get('/library/arrears_set','AdminAuth\ArrearsController@show_arrears_set')->name('show.arrears_set');
    //Route::get('/library/edit_arrears_set','AdminAuth\ArrearsController@edit')->name('edit.arrears_set');
    Route::post('/library/arrears_set/{arrears_set}','AdminAuth\ArrearsController@update')->name('update.arrears_set');

});



Route::group([
    'middleware' => 'viewer',
], function(){
    Route::get('/viewer','AdminAuth\ViewerController@index')->name('index.viewer');

    Route::get('/viewer/books','AdminAuth\ViewerController@book_list')->name('book_list.viewer');

    Route::get('/viewer/available','AdminAuth\ViewerController@available')->name('available.viewer');

    Route::get('/viewer/return','AdminAuth\ViewerController@return_list')->name('return_list.viewer');

    Route::get('/viewer/bookings','AdminAuth\ViewerController@bookings')->name('bookings.viewer');

    Route::get('/viewer/unpaid','AdminAuth\ViewerController@unpaid')->name('unpaid.viewer');
    Route::get('/viewer/paid','AdminAuth\ViewerController@paid')->name('paid.viewer');


});