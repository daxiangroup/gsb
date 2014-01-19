<?php

use GSB\Groups\GroupsService;
use GSB\Groups\GroupsEntity;
use GSB\Groups\GroupsBuddyEntity;
use GSB\Groups\GroupsRepository;

class Groups_Groups_Controller extends Base_Controller
{
    /**
     * Setting this controller to be RESTful
     */
    public $restful = true;

    /**
     * Constructor for the groups controller.
     * Setting all post actions to apply the csrf filtering by default
     *
     * @return void
     */
    public function __construct()
    {
        $this->filter('before', 'csrf')->on('post');
        Asset::container('page-specific-js-footer')->bundle('groups');
    }

    public function get_index()
    {
        return $this->view_index(GroupsService::get_groups());
    }

    public function post_index()
    {
        $filter = Input::all();

        return $this->view_index(GroupsService::get_groups($filter));
    }

    public function get_my_groups()
    {
        Asset::container('page-specific-js-footer')->add('groups-main', 'js/groups.js');

        return View::make('groups::my_groups')
            ->with('active_link', 'groups.my_groups')
            ->with('groups', GroupsService::get_my_groups((int) Auth::user()->id));
    }

    private function view_index($groups = null)
    {
        Asset::container('page-specific-js-footer')->add('groups-main', 'js/groups.js');

        return View::make('groups::index')
            ->with('active_link', 'groups')
            ->with('groups', $groups);
    }

    public function get_group_view()
    {
        Asset::container('page-specific-js-footer')->add('groups-main', 'js/groups.js');

        $group = new GroupsEntity(URI::segment(2), true);

        return View::make('groups::view')
            ->with('active_link', 'groups')
            ->with('group', $group);
    }

    public function post_group_join()
    {
        $validation = GroupsService::validate('group-join', Input::all());

        // If the form validation fails, we want to flash the Input values so we
        // have them when re-displaying the form to the user, then Redirect.
        if ($validation->fails()) {
            Input::flash();

            // We're Redirect'ing to the 'groups.view' route, which is specific to
            // a group using a group_id value. If the group_id is not available
            // in the post, for whatever reason, this will end the user up on
            // 'groups' route by default.
            return Redirect::to_route('groups.view', array($group_id))
                ->with('success', false)
                ->with_errors($validation->errors);
        }

        $group_id = Input::get('group_id');
        $profile_id = Input::get('profile_id');
        $group = new GroupsEntity($group_id,true);

        // Create a GroupsBuddyEntity and populate the POSTed fields.
        $buddy = new GroupsBuddyEntity();
        $buddy->set_group_id($group_id);
        $buddy->set_profile_id($profile_id);
        $buddy->set_status(GroupsBuddyEntity::STATUS_PENDING);

        // If at this point when we try to save, there are no spots left in the
        // group (last one was taken BEFORE user tried to save themselves (race
        // condition)), Redirect user back to the group view
        if (!$group->has_spots()) {
            // Redirect the user to the profile form with a failure flag.
            return Redirect::to_route('groups.view', array($group_id))
                ->with('success', false);
        }

        // The Group still has spots, so we can save the GroupsBuddyEntity.
        $success = GroupsRepository::save_buddy($buddy);

        // Fire the groups.buddy_save event so listeners know that an account has
        // joined a study group.
        $ep = array(
            'profile_id' => $profile_id,
            'group_id' => $group_id,
            'success' => $success,
            'timestamp' => time(),
        );
        Event::fire('groups.buddy_save', array($ep));

        // Redirect the user to the profile form with a success flag.
        return Redirect::to_route('groups.view', array($group_id))
            ->with('success', $success);
    }

    public function post_group_part()
    {
        $validation = GroupsService::validate('group-part', Input::all());

        if ($validation->fails()) {
            // We're Redirect'ing to the 'groups.my_groups' route if we have a 
            // validation problem.
            return Redirect::to_route('groups.my_groups')
                ->with('success', false)
                ->with_errors($validation->errors);
        }

        $group_id = Input::get('group_id');
        $profile_id = Input::get('profile_id');

        // Create a GroupsBuddyEntity and populate the POSTed fields.
        $buddy = new GroupsBuddyEntity();
        $buddy->set_group_id($group_id);
        $buddy->set_profile_id($profile_id);

        // Remove the buddy from the Group.
        $success = GroupsRepository::delete_buddy($buddy);

        // Fire the groups.buddy_delete event so listeners know that an account has
        // parted a study group.
        $ep = array(
            'profile_id' => $profile_id,
            'group_id' => $group_id,
            'success' => $success,
            'timestamp' => time(),
        );
        Event::fire('groups.buddy_save', array($ep));

        // Redirect the user to the my_groups view with a success flag.
        return Redirect::to_route('groups.my_groups')
            ->with('success', $success);

    }
}
