<?php

namespace Slack\Laravel\Objects\BlockElements\SelectMenu;

use Slack\Laravel\Objects\BlockElements\Concerns;
use Slack\Laravel\Objects\CompositionObjects\Option;

/**
 * This is the simplest form of select menu, with a static list
 * of options passed in when defining the element.
 * @link(https://api.slack.com/reference/block-kit/block-elements#static_select, more)
 *
 * @package Slack\Laravel\Objects\BlockElements\SelectMenu
 */
class StaticSelect extends SelectMenu
{

    use Concerns\HasOptions;

    /**
     * StaticSelect constructor.
     *
     * @param string $action_id
     * @param string $placeholder
     * @param array $options
     * @param array $groups
     * @param \Slack\Laravel\Objects\CompositionObjects\Option|null $initialOption
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
            $this->option_groups = $groups;

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
