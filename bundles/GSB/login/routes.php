<?php

Route::get('(:bundle)', array('as' => 'login', 'uses' => 'login::login@index'));
Route::get('(:bundle)/(:any?)/(:any?)/(:any?)/(:any?)', 'login::login@(:1)');
Route::post('(:bundle)', 'login::login@login');
