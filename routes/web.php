<?php
Auth::routes();

Route::get('/logout-user', function () {
    request()->session()->invalidate();
    //return redirect('/');
});
Route::get('/{any}', 'AppController@index')->where('any', ".*");
