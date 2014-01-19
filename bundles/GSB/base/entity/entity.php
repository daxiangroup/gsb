<?php

namespace GSB\Base\Entity;

/**
 * Base Entity for all other system entities
 *
 * @author Tyler Schwartz <ts@daxiangroup.com>
 */
class Entity
{
    protected $created;
    protected $updated;

    CONST FLD_CREATED = 'created';
    const FLD_UPDATED = 'updated';

    /**
     * Get the created date.
     *
     * @return DateTime
     */
    public function get_created()
    {
        return $this->{self::FLD_CREATED};
    }

    public function set_created($created)
    {
        $this->{self::FLD_CREATED} = $created;
    }

    /**
     * Get the updated date.
     *
     * @return DateTime
     */
    public function get_updated()
    {
        return $this->{self::FLD_UPDATED};
    }

    public function set_updated($updated)
    {
        $this->{self::FLD_UPDATED} = $updated;
    }
}
