<?php

namespace GSB\Groups;

use GSB\Groups\GroupsRepository;
use GSB\Groups\GroupsEntity;
use GSB\Base\Exception\GSBException;
use \Validator;
use \Input;

class GroupsService
{
    /**
     * Gets all of the groups from the repository. This function receives an optional
     * $filter array, which will pare down the result set, based on what is passed
     * into the function (usually from the Group listing filter).
     *
     * @param  array    $filter
     * @return array
     */
    public static function get_groups($filter = null)
    {
        // Throw execption if $filter was passed in and not an array.
        if (!is_null($filter) && !is_array($filter)) {
            GSBException::invalidArgument('$filter must be an array');
        }

        // Create a Filter.
        $filter = new GroupsFilter($filter);

        // Grab groups from the repository, passing in a filter if provided.
        $groups = GroupsRepository::get_groups($filter);

        // Return the empty array if we didn't get any results from the
        // repository matching our filter.
        if (false === $groups) {
            return array();
        }

        // Loop through what was returned from the repository, creating an array
        // of GroupsEntity'ies.
        foreach ($groups as $group) {
            $output[] = new GroupsEntity($group->id, true);
        }

        return $output;
    }

    /**
     * Gets all of the groups that a $profile_id is a member of. This is usually
     * used for viewing the groups that the logged in user is connected to, but
     * not explicitly for that... The function receives a mandatory $profile_id,
     * which should be an integer.
     *
     * @param  int      $profile_id
     * @return array
     */
    public static function get_my_groups($profile_id = null)
    {
        // Throw an exception if $profile_id is null.
        if (is_null($profile_id)) {
            GSBException::invalidArgument('$profile_id cannot be a null value');
        }

        // Throw an exception if $profile_id is not an integer. The passed in
        // $profile_id should be type-casted to an integer.
        if (!is_int($profile_id)) {
            GSBException::invalidArgument('$profile_id must be numeric');
        }

        // The $profile_id value cannot be 0 or false.
        if (false == $profile_id) {
            GSBException::invalidArgument('$profile_id cannot be false');
        }

        // Get the groups from the repository that $profile_id is a memeber of.
        $groups = GroupsRepository::get_my_groups($profile_id);

        // Return an empty array if we didn't get any results from the repository
        // that our $profile_id is a member of.
        if (false === $groups) {
            return array();
        }

        foreach ($groups as $group) {
            $output[] = new GroupsEntity($group->id, true);
        }

        return $output;
    }

    /**
     * Validates the form that is being processed. This is an accessor function
     * that takes a $form and an $input and builds the rules based on the $form
     * string that is passed in. Both $form and $input are required and, generally
     * speaking, $input will usually be Input::all(), but not necessarily. 
     *
     * @param  string   $form
     * @param  string   $input
     * @return object (\Validator)
     */
    public static function validate($form = null, $input = null)
    {
        if (is_null($form)) {
            GSBException::invalidArgument('$form cannot be a null value');
        }

        if (!is_string($form)) {
            GSBException::invalidArgument('$form is expected to be a string, '.gettype($form).' supplied');
        }

        if ($form == '') {
            GSBException::invalidArgument('$form cannot be an empty string');
        }

        if (is_null($input)) {
            GSBException::invalidArgument('$input cannot be a null value');
        }

        if (!is_array($input)) {
            GSBException::invalidArgument('$input is expected to be an array, '.gettype($input).' supplied');
        }

        $rules = self::get_rules($form);

        if (!is_array($rules)) {
            GSBException::invalidArgument('$rules is expected to be an array, '.gettype($input).' supplied');
        }

        $messages = self::get_messages($form);

        if (!is_array($messages)) {
            GSBException::invalidArgument('$messages is expected to be an array, '.gettype($messages).' supplied');
        }

        $validation = Validator::make($input, $rules, $messages);

        return $validation;
    }

    /**
     * Gets validation rules based on the form being validated.
     *
     * @param   string    $form
     * @return  array
     */
    public static function get_rules($form = null)
    {
        if (is_null($form)) {
            GSBException::invalidArgument('$form cannot be a null value');
        }

        if (!is_string($form)) {
            GSBException::invalidArgument('$form is expected to be a string, '.gettype($form).' supplied');
        }

        if ($form == '') {
            GSBException::invalidArgument('$form cannot be an empty string');
        }

        $rules = array(
            'group-join' => array(
                'group_id' => 'required|integer',
                'profile_id' => 'required|integer',
            ),
            'group-part' => array(
                'group_id' => 'required|integer',
                'profile_id' => 'required|integer',
            ),
        );

        return $rules[$form];
    }

    /**
     * Gets validation messages based on the form being validated.
     *
     * @param   string    $form
     * @return  array
     */
    public static function get_messages($form = null)
    {
        if (is_null($form)) {
            GSBException::invalidArgument('$form cannot be a null value');
        }

        if (!is_string($form)) {
            GSBException::invalidArgument('$form is expected to be a string, '.gettype($form).' supplied');
        }

        if ($form == '') {
            GSBException::invalidArgument('$form cannot be an empty string');
        }

        $messages = array(
            'group-join' => array(
                '',
            ),
            'group-part' => array(
                '',
            ),
        );

        return $messages[$form];
    }

}
