<?php

namespace GSB\Groups;

use \GSB\Groups\ProfileRepository;
use \GSB\Base\Entity\Entity;
use \DB;

class GroupsBuddyEntity extends Entity
{
    protected $id = null;
    protected $group_id = null;
    protected $profile_id = null;
    protected $status = null;

    private $fields = array();

    const FLD_ID = 'id';
    const FLD_GROUP_ID = 'group_id';
    const FLD_PROFILE_ID = 'profile_id';
    const FLD_STATUS = 'status';

    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;

    public function __construct($id = null, $hydrate = false)
    {
        $this->id = $id;
        $this->fields = array(
            self::FLD_ID,
            self::FLD_GROUP_ID,
            self::FLD_PROFILE_ID,
            self::FLD_STATUS,
        );

        if ($hydrate === true) {
            $this->hydrate();
        }
    }

    public function get_id()
    {
        return $this->{self::FLD_ID};
    }

    public function set_id($id)
    {
        $this->{self::FLD_ID} = $id;
    }

    public function get_group_id()
    {
        return $this->{self::FLD_GROUP_ID};
    }

    public function set_group_id($group_id)
    {
        $this->{self::FLD_GROUP_ID} = $group_id;
    }

    public function get_profile_id()
    {
        return $this->{self::FLD_PROFILE_ID};
    }

    public function set_profile_id($profile_id)
    {
        $this->{self::FLD_PROFILE_ID} = $profile_id;
    }

    public function get_status()
    {
        return $this->{self::FLD_STATUS};
    }

    public function set_status($status)
    {
        $this->{self::FLD_STATUS} = $status;
    }

    public function hydrate()
    {
        $group_buddies = GroupsRepository::get_group_buddies($this->id);

        $this->set_group_id($group_buddies['group_id']);
        $this->set_profile_id($group_buddies['profile_id']);
        $this->set_status($group_buddies['status']);
        $this->set_created($group_buddies['created']);
        $this->set_updated($group_buddies['updated']);
    }

    public function fields_as_array($include_id = false, $include_null = false)
    {
        if ($include_id) {
            $output[self::FLD_ID] = $this->get_id();
        }

        $output[self::FLD_GROUP_ID] = $this->get_group_id();
        if (!$include_null && is_null($output[self::FLD_GROUP_ID])) {
            unset($output[self::FLD_GROUP_ID]);
        }

        $output[self::FLD_PROFILE_ID] = $this->get_profile_id();
        if (!$include_null && is_null($output[self::FLD_PROFILE_ID])) {
            unset($output[self::FLD_PROFILE_ID]);
        }

        $output[self::FLD_STATUS] = $this->get_status();
        if (!$include_null && is_null($output[self::FLD_STATUS])) {
            unset($output[self::FLD_STATUS]);
        }

        if (is_null($this->get_id())) {
            $output[self::FLD_CREATED] = DB::raw('NOW()');
        }

        return $output;
    }

}
