<?php

namespace Slack\Laravel\Objects\BlockElements;

use Slack\Laravel\Objects\BlockElements\Concerns;
use Slack\Laravel\Objects\CompositionObjects\ConfirmationDialog;
use Slack\Laravel\Objects\CompositionObjects\Option;

/**
 * A radio button group that allows a user to choose one item from a
 * list of possible options.
 * @link(https://api.slack.com/reference/block-kit/block-elements#radio, more)
 *
 * @package Slack\Laravel\Objects\BlockElements
 */
class RadioButtonGroup extends InteractiveBlockElement
{

    use Concerns\HasConfirm,
        Concerns\HasOptions;

    /**
     * RadioButtonGroup constructor.
     *
     * @param string $action_id
     * @param array $options
     * @param \Slack\Laravel\Objects\CompositionObjects\Option|null $initial
     * @param \Slack\Laravel\Objects\CompositionObjects\ConfirmationDialog|null $confirm
     */
    public function __construct(string $action_id,
                                array $options = [],
                                Option $initial = null,
                                ConfirmationDialog $confirm = null)
    {
        parent::__construct(InteractiveBlockElement::RadioButton, $action_id);
        $this->options = $options;
        $this->initial_option = $initial;
        $this->confirm = $confirm;
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
            'initial_option' => $this->initial_option,
            'confirm' => $this->confirm
        ], function($val) {
            return !empty($val);
        }));
    }

}
