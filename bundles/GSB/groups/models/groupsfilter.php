<?php

namespace GSB\Groups;

use GSB\Base\Filter\Filter;
use GSB\Base\Exception\GSBException;

class GroupsFilter extends Filter
{
    protected $groups_filter_id = null;
    protected $groups_filter_name = null;
    protected $groups_filter_year = null;
    protected $groups_filter_size = null;

    protected $fields = array();

    const INPUT_ID = 'groups_filter_id';
    const INPUT_NAME = 'groups_filter_name';
    const INPUT_GRADUATING_YEAR = 'groups_filter_year';
    const INPUT_MAX_SIZE = 'groups_filter_size';

    public function __construct($filter = null)
    {
        // Setup
        $this->fields = array(
            self::INPUT_ID,
            self::INPUT_NAME,
            self::INPUT_GRADUATING_YEAR,
            self::INPUT_MAX_SIZE,
        );

        // If we're passed a null $filter, just return it straight away, we're
        // not creating a GroupsFilter.
        if (is_null($filter)) {
            return $filter;
        }

        // If we're passed a $filter and it's not an array, throw an exception
        if (!is_null($filter) && !is_array($filter)) {
            GSBException::invalidArgument('$filter must be an array');
        }

        // Process the $filter to setup this object
        $this->process_input($filter);

        return $this;
    }

    public function get_id()
    {
        $field = self::INPUT_ID;
        return $this->$field;
    }

    public function get_name()
    {
        $field = self::INPUT_NAME;
        return $this->$field;
    }

    public function get_graduating_year()
    {
        $field = self::INPUT_GRADUATING_YEAR;
        return $this->$field;
    }

    public function get_max_size()
    {
        $field = self::INPUT_MAX_SIZE;
        return $this->$field;
    }
}
