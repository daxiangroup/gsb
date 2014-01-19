<?php

namespace GSB\Base\Filter;

/**
 * Base Filter for all other system filters
 *
 * @author Tyler Schwartz <ts@daxiangroup.com>
 */

class Filter
{

    protected function process_input($filter)
    {
        foreach ($this->fields as $field) {
            if (false === isset($filter[$field])) {
                continue;
            }
            
            if ('' !== $filter[$field]) {
                $this->$field = $filter[$field];
            }
        }
    }


}
