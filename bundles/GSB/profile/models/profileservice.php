<?php

namespace GSB\Profile;

use \Validator;
use \Input;
use \Session;
use \Hash;
use \Base\Exception\RTException;

class ProfileService
{
    public static function validate($form = null)
    {
        if (is_null($form)) {
            RTException::invalidArgument('$form cannot be a null value');
        }

        if (!is_string($form)) {
            RTException::invalidArgument('$form is expected to be a string, '.gettype($form).' supplied');
        }

        if ($form == '') {
            RTException::invalidArgument('$form cannot be an empty string');
        }

        $input = Input::all();

        if (!is_array($input)) {
            RTException::invalidArgument('$input is expected to be an array, '.gettype($input).' supplied');
        }

        $rules = ProfileService::get_rules($form);

        if (!is_array($rules)) {
            RTException::invalidArgument('$rules is expected to be an array, '.gettype($input).' supplied');
        }

        $messages = ProfileService::get_messages($form);

        if (!is_array($messages)) {
            RTException::invalidArgument('$messages is expected to be an array, '.gettype($messages).' supplied');
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
            RTException::invalidArgument('$form cannot be a null value');
        }

        if (!is_string($form)) {
            RTException::invalidArgument('$form is expected to be a string, '.gettype($form).' supplied');
        }

        if ($form == '') {
            RTException::invalidArgument('$form cannot be an empty string');
        }

        Validator::register('password_correct', function($attribute, $value, $parameters) {
            $current_password = Session::get('gsb_profile');

            return (Hash::check($value, $current_password['password']));
        });

        $rules = array(
            'account' => array(
                'account_username' => 'required',
                'account_email' => 'required',
            ),
            'password' => array(
                'password_current' => 'required|password_correct',
                'password_new'     => 'required|different:password_current',
                'password_verify'  => 'required|same:password_new',
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
            RTException::invalidArgument('$form cannot be a null value');
        }

        if (!is_string($form)) {
            RTException::invalidArgument('$form is expected to be a string, '.gettype($form).' supplied');
        }

        if ($form == '') {
            RTException::invalidArgument('$form cannot be an empty string');
        }

        $messages = array(
            'account' => array(
                '',
            ),
            'password' => array(
                'password_correct' => 'You must enter your current password',
                'different' => 'Your new password must be different from your current password',
                'same' => 'You must verify your new password',
            ),
        );

        return $messages[$form];
    }
}
