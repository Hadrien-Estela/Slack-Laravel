<?php

namespace Slack\Objects\BlockElements;

use Slack\Objects\BlockElements\InteractiveBlockElement;
use Slack\Objects\BlockElements\Concerns;
use Slack\Objects\CompositionObjects\ConfirmationDialog;

/**
 *This is like a cross between a button and a select menu
 * when a user clicks on this overflow button, they will
 * be presented with a list of options to choose from.
 *
 * https://api.slack.com/reference/block-kit/block-elements#overflow
 */
class OverflowMenu extends InteractiveBlockElement
{

    use Concerns\HasConfirm,
        Concerns\HasOptions;

    /**
     * Build a new Instance.
     *
     * @param string                  $action_id [description]
     * @param array                   $options   [description]
     * @param ConfirmationDialog|null $confirm   [description]
     */
    public function __construct(string $action_id,
                                array $options = [],
                                ConfirmationDialog $confirm = null)
    {
        parent::__construct(InteractiveBlockElement::OverflowMenu, $action_id);
        $this->options = $options;
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
            'confirm' => $this->confirm
        ], function($val) {
            return !empty($val);
        }));
    }

}
