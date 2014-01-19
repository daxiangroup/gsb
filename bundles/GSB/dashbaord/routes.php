<?php

Route::group(array('before' => 'auth'), function() {
    Route::get('(:bundle)', array('as' => 'dashboard', 'uses' => 'dashboard::dashboard@index'));
    Route::get('(:bundle)/(:any?)/(:any?)/(:any?)/(:any?)', 'dashboard::dashboard@(:1)');
});
