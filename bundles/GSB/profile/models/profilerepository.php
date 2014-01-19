<?php

namespace GSB\Profile;

use \DB;
use \Base\Exception\RTException;

class ProfileRepository
{
    public static function save(ProfileEntity $profile)
    {
        try {
            $affected = DB::connection('app_w')
                ->table('profiles')
                ->where('id', '=', $profile->getId())
                ->update($profile->fieldsAsArray());
            return true;
        } catch (\Exception $e) {
            RTException::database('Database problem');
        }

        return false;
    }

    public static function get_profile($id)
    {
        $data = DB::table('profiles')
            ->find($id);

        return (array) $data;
    }
}
