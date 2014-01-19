<?php

namespace GSB\Groups;

use \DB;
use \Base\Exception\RTException;
use GSB\Groups\GroupsBuddyEntity;

class GroupsRepository
{
    public static function get_groups($filter = null)
    {
        $query = DB::table('groups');

        if (!is_null($filter->get_id())) {
            $data = $query->find($filter->get_id());

            return (count($data) ? array((object) $data) : false);
        }

        if (!is_null($filter->get_name())) {
            $query->where('name', 'LIKE', '%'.$filter->get_name().'%');
        }

        if (!is_null($filter->get_graduating_year())) {
            $query->where('graduating_year', '=', $filter->get_graduating_year());
        }

        if (!is_null($filter->get_max_size())) {
            $query->where('max_size', '=', $filter->get_max_size());
        }

        $data = $query->get();

        if (count($data)) {
            return (array) $data;
        }

        return false;
    }

    public static function get_group($id)
    {
        $data = DB::table('groups')
            ->left_join('profiles AS p1', 'groups.admin_id', '=', 'p1.id')
            ->left_join('profiles AS p2', 'groups.co_admin_id', '=', 'p2.id')
            ->where('groups.id', '=', $id)
            ->get(array(
                'groups.*',
                'p1.full_name',
                'p2.full_name AS co_full_name',
            ));

        return (array) $data[0];
    }

    public static function get_my_groups($profile_id)
    {
        $data = DB::connection('app_r')
            ->table('groups')
            ->join('groups_buddies', 'groups.id', '=', 'groups_buddies.group_id')
            ->where('groups_buddies.profile_id', '=', $profile_id)
            ->get(array('groups.*'));

        return (array) $data;
    }

    public static function get_group_meetings($id)
    {
        $data = DB::table('groups_meetings')
            ->where('group_id', '=', $id)
            ->get();

        return (array) $data;
    }

    public static function get_group_buddies($id)
    {
        $data = DB::table('groups_buddies')
            ->where('group_id', '=', $id)
            ->get();

        return (array) $data;
    }

    public static function save_buddy(GroupsBuddyEntity $buddy)
    {
        try {
            $affected = DB::connection('app_w')
                ->table('groups_buddies')
                ->insert($buddy->fields_as_array());
            return true;
        } catch (\Exception $e) {
            GSBException::database('Database problem');
        }

        return false;
    }

    public static function delete_buddy(GroupsBuddyEntity $buddy)
    {
        try {
            $affected = DB::connection('app_w')
                ->table('groups_buddies')
                ->where('group_id', '=', $buddy->get_group_id())
                ->where('profile_id', '=', $buddy->get_profile_id())
                ->delete();
            return true;
        } catch (\Exception $e) {
            GSBException::database('Database problem');
        }

        return false;
    }



    /*
    public static function save(ProfileEntity $profile)
    {
        try {
            $affected = DB::connection('app_w')
                ->table('profiles')
                ->where('id', '=', $profile->getId())
                ->update($profile->fields_as_array());
            return true;
        } catch (\Exception $e) {
            RTException::database('Database problem');
        }

        return false;
    }

    */
}
