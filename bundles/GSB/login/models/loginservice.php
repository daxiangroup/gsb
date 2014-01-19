<?php

namespace GSB\Login;

use \GSB\Profile\ProfileRepository;
use \Auth;
use \Session;
use \Cookie;

class LoginService
{
    /**
     * Attempts to log a user in given the pased credentials
     *
     * @param  array    $credentials
     * @return boolean
     */
    public static function attempt($credentials)
    {
        // If the attempt using the credentials passed in, through the Auth
        // library, succeeds... return true.
        if (Auth::attempt($credentials)) {
            return true;
        }

        // Duh...
        return false;
    }

    /**
     * Sets a cookie to remember the user so they don't have to login next time
     * they come to the site.
     *
     * @return void
     */
    public static function set_remember_me()
    {
        // Create the cookie array of the logged in user's id and a hash of
        // their email.
        $cookie = array(
            'id' => Auth::user()->id,
            'hash' => Hash::make(Auth::user()->email)
        );

        // Set a 'forever' cookie, serializing the array we created above.
        Cookie::forever('gsb_remember_me', serialize($cookie));
    }

    /**
     * Checks if the remember me cookie is set, uses it's data to automatically
     * log the user in if they have chosent to be remembered.
     *
     * @return boolean
     */
    public static function check_remember_me()
    {
        // Get the cookie and unserialize it.
        $cookie   = unserialize(Cookie::get('gsb_remember_me'));
        // Use the LoginRepository to get the username (email) associated with the
        // id stored in the cookie
        $username = LoginRepository::get_username($cookie['id']);

        // If a Hash of the username obtained from the database does not match the
        // hash stored in the cookie, we return false and the user is not auto-
        // matically logged in.
        if (!Hash::check($username, $cookie['hash'])) {
            return false;
        }

        // Since everything matches up, magically log the user in using the id
        // stored in the cookie.
        Auth::login($cookie['id']);

        return true;
    }

    /**
     * Logs the user out of the site.
     *
     * @return void
     */
    public static function logout()
    {
        // Delete the forever cookie
        Cookie::forget('gsb_remember_me');
        // Destroy their session.
        Auth::logout();
    }

    public static function set_session()
    {
        $profile  = ProfileRepository::get_profile(Auth::user()->id);
        //$settings = LoginRepository::get_settings(Auth::user()->id);
        $settings = array();

        Session::put('gsb_profile', $profile);
        Session::put('gsb_settings', $settings);
    }
}
