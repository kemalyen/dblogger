<?php

Route::group(
    [
        'prefix' => Config::get("glog.route-prefix"),

    ],
    function () {
        Route::get('/', ['uses' => 'GlogController@index']);
        Route::get('/clear-logs', ['uses' => 'ResetController@index']);
    }

);