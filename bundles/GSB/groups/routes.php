<?php

Route::group(array('before' => 'auth'), function() {
    /*
    Route::get('(:bundle)', array('as' => 'groups', 'uses' => 'groups::groups@index'));
    Route::post('(:bundle)', 'groups::groups@index');
    */
    Router::register(array('GET', 'POST'), '(:bundle)', array('as' => 'groups', 'uses' => 'groups::groups@index'));

    Route::get('(:bundle)/my-groups', array('as' => 'groups.my_groups', 'uses' => 'groups::groups@my_groups'));
    // Group view
    Route::get('(:bundle)/(:num)', array('as' => 'groups.view', 'uses' => 'groups::groups@group_view'));
    // Redirecting GETs to the join group route back to the view group route
    Route::get('(:bundle)/(:num)/join', function($group_id) { return Redirect::to_route('groups.view', array($group_id)); });
    Route::post('(:bundle)/(:num)/join', array('as' => 'groups.join', 'uses' => 'groups::groups@group_join'));
    // Redirecting GETs to the part group route back to the view group route
//    Route::get('(:bundle)/(:num)/part', function($group_id) { return Redirect::to_route('groups.view', array($group_id)); });
    Route::post('(:bundle)/part', array('as' => 'groups.part', 'uses' => 'groups::groups@group_part'));

    Route::get('(:bundle)/(:any?)/(:any?)/(:any?)/(:any?)', 'groups::groups@(:1)');
});
