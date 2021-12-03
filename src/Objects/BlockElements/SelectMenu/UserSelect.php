<?php

namespace Slack\Laravel\Objects\BlockElements\SelectMenu;

/**
 * This select menu will populate its options with a list of Slack users
 * visible to the current user in the active workspace.
 * @link(https://api.slack.com/reference/block-kit/block-elements#users_select, more)
 *
 * @package Slack\Laravel\Objects\BlockElements\SelectMenu
 */
class UserSelect extends SelectMenu
{

    /**
     * The user ID of any valid user to be pre-selected when the menu loads.
     *
     * @var string|null
     */
    private $initial_user;

    /**
     * UserSelect constructor.
     *
     * @param string $action_id
     * @param string $placeholder
     * @param string|null $initialUser
     */
    public function __construct(string $action_id,
                                string $placeholder = 'Select a user',
                                string $initialUser = null)
    {
        parent::__construct(SelectMenu::User, $action_id, $placeholder);
        $this->initial_user = $initialUser;
    }

    /**
     * Set the initial user ID.
     *
     * @param string $userID$
     * @return $this
     */
    public function initialUser(string $userID)
    {
        $this->initial_user = $userID;
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
            'initial_user' => $this->initial_user
        ], function($val) {
            return !empty($val);
        }));
    }

}
