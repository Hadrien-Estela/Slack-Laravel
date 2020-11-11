<?php

namespace Slack\Objects\CompositionObjects;

use JsonSerializable;

/**
 * Determines when a plain-text input element will return
 * a block_actionsinteraction payload.
 *
 * @link(https://api.slack.com/reference/block-kit/composition-objects#dispatch_action_config, more)
 */
class DispatchActionConfig implements JsonSerializable
{

    const OnSubmit = 'on_enter_pressed';
    const OnChange = 'on_character_entered';

    /**
     * An array of interaction types that you would like to receive
     * a block_actions payload for.
     *
     * @var string[]
     */
    private $trigger_actions_on = [];

    /**
     * Build a new Instance.
     *
     * @param boolean $onSubmit
     * @param boolean $onChange
     */
    public function __construct(bool $onSubmit, bool $onChange)
    {
        if (isset($onSubmit))
            array_push($this->trigger_actions_on, self::OnSubmit);

        if (isset($onChange))
            array_push($this->trigger_actions_on, self::OnChange);
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge([

        ],array_filter([
            'trigger_actions_on' => $this->trigger_actions_on
        ], function($val) {
            return !empty($val);
        }));
    }

}
