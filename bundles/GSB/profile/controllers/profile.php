<?php

use GSB\Profile\ProfileEntity;
use GSB\Profile\ProfileService;
use GSB\Profile\ProfileRepository;

class Profile_Profile_Controller extends Base_Controller
{
    /**
     * Setting this controller to be RESTful
     */
    public $restful = true;

    /**
     * Constructor for the profile controller.
     * Setting all post actions to apply the csrf filtering by default
     *
     * @return void
     */
    public function __construct()
    {
        $this->filter('before', 'csrf')->on('post');
    }

    /**
     * Displaying the index of the profile section to the user. Before we show the
     * form, we have to create a ProfileEntity and populate the form_values.
     *
     * @return void
     */
    public function get_index()
    {
        $profile = new ProfileEntity(Auth::user()->id, true);

        $form_values['account_username'] = Input::old('account_username') != '' ? Input::old('account_username') : $profile->getUsername();
        $form_values['account_email'] = Input::old('account_email') != '' ? Input::old('account_email') : $profile->getEmail();
        $form_values['account_full_name'] = Input::old('account_full_name') != '' ? Input::old('account_full_name') : $profile->getFullName();
        $form_values['account_graduating_year'] = Input::old('account_graduating_year') != '' ? Input::old('account_graduating_year') : $profile->getGraduatingYear();
        $form_values['account_bio'] = Input::old('account_bio') != '' ? Input::old('account_bio') : $profile->getBio();

        return View::make('profile::index')
            ->with('active_link', 'profile')
            ->with('form_values', $form_values);
    }

    /**
     * account_submit()
     * Saves the POSTed fields for the main account information
     *
     * @method post
     * @return redirect
     */
    public function post_account_submit()
    {
        $validation = ProfileService::validate('account');

        $profile_id = Auth::user()->id;

        // If the form validation fails, we want to flash the Input values so we
        // have them when re-displaying the form to the user, then Redirect.
        if ($validation->fails()) {
            Input::flash();

            return Redirect::to_route('profile')
                ->with('success', false)
                ->with_errors($validation->errors);
        }

        // Create a ProfileEntity and populate the POSTed fields.
        $profile = new ProfileEntity($profile_id);
        $profile->setUsername(Input::get('account_username'));
        $profile->setEmail(Input::get('account_email'));
        $profile->setFullName(Input::get('account_full_name'));
        $profile->setGraduatingYear(Input::get('account_graduating_year'));
        $profile->setBio(Input::get('account_bio'));

        // Save the ProfileEntity
        $success = ProfileRepository::save($profile);

        // Fire the profile.account_save event so listeners know that an account
        // has been saved.
        $ep = array(
            'profile_id' => $profile_id,
            'success' => $success,
            'timestamp' => time(),
        );
        Event::fire('profile.account_save', array($ep));

        // Redirect the user to the profile form with a success flag.
        return Redirect::to_route('profile')
            ->with('success', $success);
    }

    /**
     * Displaying the change password form to the user
     *
     * @return void
     */
    public function get_password()
    {
        return View::make('profile::password')
            ->with('active_link', 'profile.password');
    }

    public function post_password_submit()
    {
        $profile_id = Auth::user()->id;

        $validation = ProfileService::validate('password');

        if ($validation->fails()) {
            return Redirect::to_route('profile.password')
                ->with('success', false)
                ->with_errors($validation->errors);
        }

        $profile = new ProfileEntity($profile_id);
        $profile->setPassword(Input::get('password_new'));

        $success = ProfileRepository::save($profile);

        // Fire the profile.password_save event so listeners know that an account
        // has saved their password.
        $ep = array(
            'profile_id' => $profile_id,
            'success' => $success,
            'timestamp' => time(),
        );
        Event::fire('profile.password_save', array($ep));

        return Redirect::to_route('profile.password')
            ->with('success', $success);
    }

    /**
     * Displaying the settings form to the user
     *
     * @return void
     */
    public function get_settings()
    {
        return View::make('profile::settings')
            ->with('active_link', 'profile.settings');
    }
}
