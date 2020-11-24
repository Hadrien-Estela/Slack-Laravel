<?php

namespace Slack\Objects\BlockElements;

use Slack\Objects\BlockElements\Concerns;
use Slack\Objects\CompositionObjects\ConfirmationDialog;

/**
 * A checkbox group that allows a user to choose multiple items from a
 * list of possible options.
 * @link(https://api.slack.com/reference/block-kit/block-elements#checkboxes, more)
 *
 * @package Slack\Objects\BlockElements
 */
class CheckboxGroup extends InteractiveBlockElement
{

    use Concerns\HasConfirm,
        Concerns\HasOptions;

    /**
     * CheckboxGroup constructor.
     *
     * @param string $action_id
     * @param array $options
     * @param array $initialOptions
     * @param \Slack\Objects\CompositionObjects\ConfirmationDialog|null $confirm
     */
    public function __construct(string $action_id,
                                array $options = [],
                                array $initialOptions = [],
                                ConfirmationDialog $confirm = null)
    {
        parent::__construct(InteractiveBlockElement::Checkbox, $action_id);
        $this->options = $options;
        $this->initial_options = $initialOptions;
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
            'initial_options' => $this->initial_options(),
            'confirm' => $this->confirm
        ], function($val) {
            return !empty($val);
        }));
    }

}
