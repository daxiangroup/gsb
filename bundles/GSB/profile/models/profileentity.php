<?php

namespace GSB\Profile;

use \GSB\Profile\ProfileRepository;
use \GSB\Base\Entity\Entity;
use \Hash;

class ProfileEntity extends Entity
{
    protected $id = null;
    protected $username = null;
    protected $email = null;
    protected $password = null;
    protected $full_name = null;
    protected $graduating_year = null;
    protected $bio = null;

    private $fields = array();

    const FLD_ID = 'id';
    const FLD_USERNAME = 'username';
    const FLD_EMAIL = 'email';
    const FLD_PASSWORD = 'password';
    const FLD_FULL_NAME = 'full_name';
    const FLD_GRADUATING_YEAR = 'graduating_year';
    const FLD_BIO = 'bio';

    public function __construct($id, $hydrate = false)
    {
        $this->id = $id;
        $this->fields = array(
            self::FLD_ID,
            self::FLD_USERNAME,
            self::FLD_EMAIL,
            self::FLD_PASSWORD,
            self::FLD_FULL_NAME,
            self::FLD_GRADUATING_YEAR,
            self::FLD_BIO,
        );

        if ($hydrate === true) {
            $this->hydrate();
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = Hash::make($password);
    }

    public function getFullName()
    {
        return $this->full_name;
    }

    public function setFullName($full_name)
    {
        $this->full_name = $full_name;
    }

    public function getGraduatingYear()
    {
        return $this->graduating_year;
    }

    public function setGraduatingYear($year)
    {
        $this->graduating_year = $year;
    }

    public function getBio()
    {
        return $this->bio;
    }

    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    public function hydrate()
    {
        $profile = ProfileRepository::get_profile($this->id);

        $this->setUsername($profile['username']);
        $this->setEmail($profile['email']);
        $this->setPassword($profile['password']);
        $this->setFullName($profile['full_name']);
        $this->setGraduatingYear($profile['graduating_year']);
        $this->setBio($profile['bio']);
    }

    public function fieldsAsArray($includeId = false, $includeNull = false)
    {
        if ($includeId) {
            $output[self::FLD_ID] = $this->getId();
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

        $output[self::FLD_GRADUATING_YEAR] = $this->getGraduatingYear();
        if (!$includeNull && is_null($output[self::FLD_GRADUATING_YEAR])) {
            unset($output[self::FLD_GRADUATING_YEAR]);
        }

        $output[self::FLD_BIO] = $this->getBio();
        if (!$includeNull && is_null($output[self::FLD_BIO])) {
            unset($output[self::FLD_BIO]);
        }

        return $output;
    }
}
