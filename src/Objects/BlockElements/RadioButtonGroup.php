<?php

namespace Slack\Objects\BlockElements;

use Slack\Objects\BlockElements\InteractiveBlockElement;
use Slack\Objects\BlockElements\Concerns;
use Slack\Objects\CompositionObjects\ConfirmationDialog;
use Slack\Objects\CompositionObjects\Option;

/**
 * A radio button group that allows a user to choose one item from a
 * list of possible options.
 *
 * https://api.slack.com/reference/block-kit/block-elements#radio
 */
class RadioButtonGroup extends InteractiveBlockElement
{

    use Concerns\HasConfirm,
        Concerns\HasOptions;

    /**
     * Build a new Instance.
     *
     * @param string                  $action_id [description]
     * @param array                   $options   [description]
     * @param Option|null             $initial   [description]
     * @param ConfirmationDialog|null $confirm   [description]
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
            'initial_option' => $this->initial_option,
            'confirm' => $this->confirm
        ], function($val) {
            return !empty($val);
        }));
    }

}
