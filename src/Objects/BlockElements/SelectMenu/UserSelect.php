<?php

namespace Slack\Objects\BlockElements\SelectMenu;

use Slack\Objects\BlockElements\SelectMenu\SelectMenu;

/**
 * This select menu will populate its options with a list of Slack users
 * visible to the current user in the active workspace.
 *
 * https://api.slack.com/reference/block-kit/block-elements#users_select
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
     * Build a new instance.
     *
     * @param string      $action_id
     * @param string      $placeholder
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
     * @param  string $userID$
     * @return Slack\Objects\BlockElements\SelectMenu\UserSelect
     */
    public function initialUser(string $userID)
    {
        $this->initial_user = $userID;
        return $this;
    }

    /**
     * @override
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
