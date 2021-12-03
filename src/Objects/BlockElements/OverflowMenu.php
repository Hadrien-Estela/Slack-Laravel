<?php

namespace Slack\Laravel\Objects\BlockElements;

use Slack\Laravel\Objects\BlockElements\Concerns;
use Slack\Laravel\Objects\CompositionObjects\ConfirmationDialog;

/**
 *This is like a cross between a button and a select menu
 * when a user clicks on this overflow button, they will
 * be presented with a list of options to choose from.
 * @link(https://api.slack.com/reference/block-kit/block-elements#overflow, more)
 *
 * @package Slack\Laravel\Objects\BlockElements
 */
class OverflowMenu extends InteractiveBlockElement
{

    use Concerns\HasConfirm,
        Concerns\HasOptions;

    /**
     * OverflowMenu constructor.
     *
     * @param string $action_id
     * @param array $options
     * @param \Slack\Laravel\Objects\CompositionObjects\ConfirmationDialog|null $confirm
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
