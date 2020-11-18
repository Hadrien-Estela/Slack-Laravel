<?php

namespace Slack\Objects\BlockElements;

use Slack\Objects\BlockElements\Concerns;
use Slack\Objects\CompositionObjects\ConfirmationDialog;

/**
 * A checkbox group that allows a user to choose multiple items from a
 * list of possible options.
 *
 * @link(https://api.slack.com/reference/block-kit/block-elements#checkboxes, more)
 */
class CheckboxGroup extends InteractiveBlockElement
{

    use Concerns\HasConfirm,
        Concerns\HasOptions;

    /**
     * Build a new instance.
     *
     * @param string                  $action_id      [description]
     * @param array                   $options        [description]
     * @param array                   $initialOptions [description]
     * @param ConfirmationDialog|null $confirm        [description]
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
            'initial_options' => $this->initialOptions(),
            'confirm' => $this->confirm
        ], function($val) {
            return !empty($val);
        }));
    }

}
