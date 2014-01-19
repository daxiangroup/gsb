<?php

namespace GSB\Groups;

use \GSB\Groups\ProfileRepository;
use \GSB\Base\Entity\Entity;

class GroupsEntity extends Entity
{
    protected $id = null;
    protected $name = null;
    protected $graduating_year = null;
    protected $admin_id = null;
    protected $admin_name = null;
    protected $co_admin_id = null;
    protected $co_admin_name = null;
    protected $max_size = null;
    protected $headline = null;
    protected $description = null;
    protected $meetings = null;
    protected $buddies = null;

    private $fields = array();

    const FLD_ID = 'id';
    const FLD_NAME = 'name';
    const FLD_GRADUATING_YEAR = 'graduating_year';
    const FLD_ADMIN_ID = 'admin_id';
    const FLD_ADMIN_NAME = 'admin_name';
    const FLD_CO_ADMIN_ID = 'co_admin_id';
    const FLD_CO_ADMIN_NAME = 'co_admin_name';
    const FLD_MAX_SIZE = 'max_size';
    const FLD_HEADLINE = 'headline';
    const FLD_DESCRIPTION = 'description';
    const FLD_MEETINGS = 'meetings';
    const FLD_BUDDIES = 'buddies';

    public function __construct($id, $hydrate = false)
    {
        $this->id = $id;
        $this->fields = array(
            self::FLD_ID,
            self::FLD_NAME,
            self::FLD_GRADUATING_YEAR,
            self::FLD_ADMIN_ID,
            self::FLD_ADMIN_NAME,
            self::FLD_CO_ADMIN_ID,
            self::FLD_CO_ADMIN_NAME,
            self::FLD_MAX_SIZE,
            self::FLD_HEADLINE,
            self::FLD_DESCRIPTION,
            self::FLD_MEETINGS,
            self::FLD_BUDDIES,
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

    public function get_name()
    {
        return $this->{self::FLD_NAME};
    }

    public function set_name($name)
    {
        $this->{self::FLD_NAME} = $name;
    }

    public function get_graduating_year()
    {
        return $this->{self::FLD_GRADUATING_YEAR};
    }

    public function set_graduating_year($year)
    {
        $this->{self::FLD_GRADUATING_YEAR} = $year;
    }

    public function get_admin_id()
    {
        return $this->{self::FLD_ADMIN_ID};
    }

    public function set_admin_id($admin_id)
    {
        $this->{self::FLD_ADMIN_ID} = $admin_id;
    }

    public function get_admin_name()
    {
        return $this->{self::FLD_ADMIN_NAME};
    }

    public function set_admin_name($admin_name)
    {
        $this->{self::FLD_ADMIN_NAME} = $admin_name;
    }

    public function get_co_admin_id()
    {
        return $this->{self::FLD_CO_ADMIN_ID};
    }

    public function set_co_admin_id($co_admin_id)
    {
        $this->{self::FLD_CO_ADMIN_ID} = $co_admin_id;
    }

    public function get_co_admin_name()
    {
        return $this->{self::FLD_CO_ADMIN_NAME};
    }

    public function set_co_admin_name($co_admin_name)
    {
        $this->{self::FLD_CO_ADMIN_NAME} = $co_admin_name;
    }

    public function get_max_size()
    {
        return $this->{self::FLD_MAX_SIZE};
    }

    public function set_max_size($max_size)
    {
        $this->{self::FLD_MAX_SIZE} = $max_size;
    }

    public function get_headline()
    {
        return $this->{self::FLD_HEADLINE};
    }

    public function set_headline($headline)
    {
        $this->{self::FLD_HEADLINE} = $headline;
    }


    public function get_description()
    {
        return $this->{self::FLD_DESCRIPTION};
    }

    public function set_description($description)
    {
        $this->{self::FLD_DESCRIPTION} = $description;
    }

    public function set_meetings($meetings)
    {
        foreach ($meetings as $meeting) {
            $this->{self::FLD_MEETINGS}[$meeting->day] = (array) $meeting;
        }
    }

    public function set_buddies($buddies)
    {
        foreach ($buddies as $buddy) {
            $this->{self::FLD_BUDDIES}[] = $buddy;
        }
    }

    public function get_buddy_count()
    {
        return count($this->{self::FLD_BUDDIES});
    }

    public function has_spots()
    {
        return ($this->get_max_size() - $this->get_buddy_count());
    }

    public function hydrate()
    {
        $group = GroupsRepository::get_group($this->id);
        $group_meetings = GroupsRepository::get_group_meetings($this->id);
        $group_buddies = GroupsRepository::get_group_buddies($this->id);

        $this->set_name($group['name']);
        $this->set_graduating_year($group['graduating_year']);
        $this->set_admin_id($group['admin_id']);
        $this->set_admin_name($group['full_name']);
        $this->set_co_admin_id($group['co_admin_id']);
        $this->set_co_admin_name($group['co_full_name']);
        $this->set_max_size($group['max_size']);
        $this->set_headline($group['headline']);
        $this->set_description($group['description']);

        $this->set_meetings($group_meetings);

        $this->set_buddies($group_buddies);
    }

    /*
    public function fields_as_array($includeId = false, $includeNull = false)
    {
        if ($includeId) {
            $output[self::FLD_ID] = $this->get_id();
        }

        $output[self::FLD_USERNAME] = $this->getUsername();
        if (!$includeNull && is_null($output[self::FLD_USERNAME])) {
            unset($output[self::FLD_USERNAME]);
        }

        $output[self::FLD_EMAIL] = $this->getEmail();
        if (!$includeNull && is_null($output[self::FLD_EMAIL])) {
            unset($output[self::FLD_EMAIL]);
        }

        $output[self::FLD_PASSWORD] = $this->getPassword();
        if (!$includeNull && is_null($output[self::FLD_PASSWORD])) {
            unset($output[self::FLD_PASSWORD]);
        }

        $output[self::FLD_FULL_NAME] = $this->getFullName();
        if (!$includeNull && is_null($output[self::FLD_FULL_NAME])) {
            unset($output[self::FLD_FULL_NAME]);
        }

        $output[self::FLD_GRADUATING_YEAR] = $this->get_graduating_year();
        if (!$includeNull && is_null($output[self::FLD_GRADUATING_YEAR])) {
            unset($output[self::FLD_GRADUATING_YEAR]);
        }

        $output[self::FLD_BIO] = $this->getBio();
        if (!$includeNull && is_null($output[self::FLD_BIO])) {
            unset($output[self::FLD_BIO]);
        }

        return $output;
    }
    */
}
