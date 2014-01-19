<?php

namespace GSB\Login;

use \DB;
use \Session;

class LoginRepository
{
    /**
     * Gets the username (email) from the users table, given an id.
     *
     * @param  int      $id
     * @return string
     */
    public static function get_username($id)
    {
        $user = DB::table('users')
            ->find($id);

        return $user->email;
    }

    /**
     * Gets the settings associated to a user, given an id. If the $clean parameter
     * is true, we will trim off the 'id' and 'user_id' elements from the array
     * before returning it.
     *
     * @param  int      $id
     * @param  boolean  $clean
     * @return array
     */
    public static function get_settings($id, $clean = true)
    {
        $settings = DB::table('settings')
            ->where('user_id', '=', $id)
            ->get();

        // Cast the results to an array for better easier usage
        $settings = (array) $settings[0];

        // If $clean is true, we want to trim off the 'id' and 'user_id' elements
        // from the array before we send it back to the calling function. When
        // storing settings in the session, we don't care about the two elements.
        if ($clean === true) {
            unset($settings['id']);
            unset($settings['user_id']);
        }

        return (array) $settings;
    }
}
