<?php
Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        $view = \Session::get('loggedIn', false) !== true ? 'login' : 'index';

        return view($view);
    });
    Route::post('/login', 'SessionController@login');
    Route::get('/logout', 'SessionController@logout');

    Route::group(['prefix' => 'file'], function () {
        Route::get('/', 'FileController@show');
        Route::post('/', 'FileController@create');
        Route::put('/', 'FileController@update');
        Route::delete('/', 'FileController@destroy');
    });

    Route::group(['prefix' => 'directory'], function () {
        Route::get('/', 'DirectoryController@index');
        Route::post('/', 'DirectoryController@create');
        Route::delete('/', 'DirectoryController@destroy');
    });

    Route::get('/download/{zip}', 'DownloadController@download');
    Route::post('/download', 'DownloadController@generate');

    Route::post('/upload', 'UploadController@upload');
});