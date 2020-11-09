<?php

namespace Slack\Objects\BlockElements\SelectMenu;

use Slack\Objects\BlockElements\Menu;

/**
 * A multi-select menu allows a user to select multiple items from a list of options.
 * Just like regular select menus, multi-select menus also include type-ahead functionality,
 * where a user can type a part or all of an option string to filter the list.
 *
 * https://api.slack.com/reference/block-kit/block-elements#multi_select
 */
abstract class MultiSelectMenu extends Menu
{

    const Static = 'multi_static_select';
    const External = 'multi_external_select';
    const User = 'multi_users_select';
    const Conversation = 'multi_conversations_select';
    const Channel = 'multi_channels_select';

    /**
     * Specifies the maximum number of items that can be selected in the menu.
     * Minimum number is 1.
     *
     * @var integer|null
     */
    private $max_selected_items;

    /**
     * Build a new instance.
     *
     * @param string $type          the type of BlockElement
     * @param string $action_id     the action id
     * @param string $placeholder   the placeholder
     */
    public function __construct(string $type,
                                string $action_id,
                                string $placeholder,
                                int $max_selected_items = null)
    {
        parent::__construct($type, $action_id, $placeholder);
        $this->max_selected_items = $max_selected_items;
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
            'max_selected_items' => $this->max_selected_items;
        ], function($val) {
            return !empty($val);
        }));
    }

}
