<?php

namespace Slack\Objects\BlockElements\SelectMenu;

use Slack\Objects\BlockElements\Concerns;
use Slack\Objects\CompositionObjects\Option;

/**
 * This is the simplest form of select menu, with a static list
 * of options passed in when defining the element.
 *
 * @link(https://api.slack.com/reference/block-kit/block-elements#static_select, more)
 */
class StaticSelect extends SelectMenu
{

    use Concerns\HasOptions;

    /**
     * Build a new instance.
     *
     * @param string $action_id      [description]
     * @param string $placeholder    [description]
     * @param array  $options        [description]
     * @param array  $groups         [description]
     * @param Option  $initialOptions [description]
     */
    public function __construct(string $action_id,
                                string $placeholder = 'Select an option',
                                array $options = [],
                                array $groups = [],
                                Option $initialOption = null)
    {
        parent::__construct(SelectMenu::Static, $action_id, $placeholder);

        if ($options)
            $this->options = $options;

        if ($groups)
            $this->groups = $groups;

        $this->initial_option = $initialOption;
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
            'options' => $this->options(), // Must be Options or groups not both
            'option_groups' => $this->groups(),
            'initial_option' => $this->initial_option
        ], function($val) {
            return !empty($val);
        }));
    }

}
