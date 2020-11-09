<?php

namespace Slack\Objects\BlockElements\SelectMenu;

use Slack\Objects\BlockElements\Concerns;
use Slack\Objects\BlockElements\MutliSelectMenu\MutliSelectMenu;

/**
 * This is the simplest form of select menu, with a static list of options
 * passed in when defining the element.
 *
 * https://api.slack.com/reference/block-kit/block-elements#static_multi_select
 */
class StaticMultiSelect extends MutliSelectMenu
{

    use Concerns\HasOptions;

    /**
     * Build a new instance.
     *
     * @param string       $type               [description]
     * @param string       $action_id          [description]
     * @param string       $placeholder        [description]
     * @param integer|null $max_selected_items [description]
     * @param array        $options            [description]
     * @param array        $groups             [description]
     * @param array        $initialOptions     [description]
     */
    public function __construct(string $action_id,
                                string $placeholder = 'Select an option',
                                int $max_selected_items = null,
                                array $options = [],
                                array $groups = [],
                                array $initialOptions = [])
    {
        parent::__construct(MutliSelectMenu::Static, $action_id, $placeholder, $max_selected_items);
        $this->options = $options;
        $this->groups = $groups;
        $this->initial_options = $initialOptions;
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
            'options' => $this->options()
        ], array_filter([
            'option_groups' => $this->groups(),
            'initial_options' => $this->initialOptions()
        ], function($val) {
            return !empty($val);
        }));
    }

}
