<?php

class Dashboard_Dashboard_Controller extends Base_Controller {

    public $restful = true;

    public function get_index()
    {
        return View::make('dashboard::index')
            ->with('active_link', '');
    }
}