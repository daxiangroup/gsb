<?php

Route::group(array('before' => 'auth'), function() {
    Route::get('(:bundle)', array('as' => 'profile', 'uses' => 'profile::profile@index'));
    Route::post('(:bundle)', 'profile::profile@account_submit');
    Route::get('(:bundle)/password', array('as' => 'profile.password', 'uses' => 'profile::profile@password'));
    Route::post('(:bundle)/password', 'profile::profile@password_submit');
    Route::get('(:bundle)/settings', array('as' => 'profile.settings', 'uses' => 'profile::profile@settings'));
    Route::get('(:bundle)/(:num)', array('as' => 'profile.view', 'uses' => 'profile::profile@index'));
    Route::get('(:bundle)/(:any?)/(:any?)/(:any?)/(:any?)', 'profile::profile@(:1)');
});
