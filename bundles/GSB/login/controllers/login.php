<?php

use GSB\Login\LoginService;

class Login_Login_Controller extends Base_Controller
{
    public $restful = true;

    public function __construct()
    {
        $this->filter('before', 'csrf')->on('post');
    }

    public function get_index()
    {
        if (Cookie::get('gsb_remember_me') && LoginService::check_remember_me()) {
            return Redirect::to('/dashboard');
        }

        if (!Auth::guest()) {
            return Redirect::to('/dashboard');
        }

        return View::make('login::index');
    }

    public function post_login()
    {
        $credentials = array(
            'username' => Input::get('login'),
            'password' => Input::get('password')
        );

        if (!LoginService::attempt($credentials)) {
            return Redirect::to_route('login');
        }

        if (Input::get('remember_me')) {
            LoginService::set_remember_me();
        }

        LoginService::set_session();

        // Fire the login.login event so listeners know that an account has been
        // logged in.
        $ep = array(
            'profile_id' => Auth::user()->id,
            'success' => true,
            'timestamp' => time(),
        );
        Event::fire('login.login', array($ep));

        return Redirect::to('/dashboard');
    }

    public function get_logout()
    {
        // Set the $profile_id before we kill the session so we can fire the logout
        // event and still track the profile.
        $profile_id = Auth::user()->id;

        LoginService::logout();
        // Fire the login.logout event so listeners know that an account has been
        // logged out.
        $ep = array(
            'profile_id' => $profile_id,
            'success' => true,
            'timestamp' => time(),
        );
        Event::fire('login.logout', array($ep));

        return Redirect::to_route('home');
    }
}
