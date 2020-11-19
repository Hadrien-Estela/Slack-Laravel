<?php

namespace Slack\Objects\BlockElements\MultiSelectMenu;

/**
 * This multi-select menu will populate its options with a list of
 * Slack users visible to the current user in the active workspace.
 * @link(https://api.slack.com/reference/block-kit/block-elements#users_multi_select, more)
 *
 * @package Slack\Objects\BlockElements\MultiSelectMenu
 */
class UserMultiSelect extends MultiSelectMenu
{

    /**
     * An array of user IDs of any valid users to be pre-selected when the menu loads.
     *
     * @var string[]
     */
    private $initial_users;

    /**
     * UserMultiSelect constructor.
     *
     * @param string $action_id
     * @param string $placeholder
     * @param array $initialUsers
     */
    public function __construct(string $action_id,
                                string $placeholder = 'Select a user',
                                array $initialUsers = [])
    {
        parent::__construct(MultiSelectMenu::User, $action_id, $placeholder);
        $this->initial_users = $initialUsers;
    }

    /**
     * Add an initial user.
     *
     * @param string $userID$
     * @return $this
     */
    public function initialUser(string $userID)
    {
        array_push($this->initial_users, $userID);
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [

        ], array_filter([
            'initial_users' => $this->initial_users
        ], function($val) {
            return !empty($val);
        }));
    }

}
