<?php

namespace Slack\Objects\BlockElements\MultiSelectMenu;

use Slack\Objects\BlockElements\Concerns;

/**
 * This is the simplest form of select menu, with a static list of options
 * passed in when defining the element.
 * @link(https://api.slack.com/reference/block-kit/block-elements#static_multi_select, more)
 *
 * @package Slack\Objects\BlockElements\MultiSelectMenu
 */
class StaticMultiSelect extends MultiSelectMenu
{

    use Concerns\HasOptions;

    /**
     * StaticMultiSelect constructor.
     *
     * @param string $action_id
     * @param string $placeholder
     * @param int|null $max_selected_items
     * @param array $options
     * @param array $groups
     * @param array $initialOptions
     */
    public function __construct(string $action_id,
                                string $placeholder = 'Select an option',
                                int $max_selected_items = null,
                                array $options = [],
                                array $groups = [],
                                array $initialOptions = [])
    {
        parent::__construct(MultiSelectMenu::Static, $action_id, $placeholder, $max_selected_items);
        $this->options = $options;
        $this->option_groups = $groups;
        $this->initial_options = $initialOptions;
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [
            'options' => $this->options()
        ], array_filter([
            'option_groups' => $this->groups(),
            'initial_options' => $this->initial_options()
        ], function($val) {
            return !empty($val);
        }));
    }

}
