<?php

namespace Slack\Objects\BlockElements;

use Slack\Objects\BlockElements\BlockElement;

/**
 * Base class for interactive elements.
 */
abstract class InteractiveBlockElement extends BlockElement
{

    const Button = 'button';
    const Checkbox = 'checkboxes';
    const Datepicker = 'datepicker';
    const TextInput = 'plain_text_input';
    const RadioButton = 'radio_buttons';
    const Timepicker = 'timepicker';
    const OverflowMenu = 'overflow';

    /**
     * An identifier for the action.
     *
     * @var string
     */
    private $action_id = '';

    /**
     * Build new Instance.
     *
     * @param string $url The url of the image.
     * @param string $alt The alternative text of the image.
     */
    public function __construct(string $type, string $action_id)
    {
        parent::__construct($type);
        $this->action_id = $action_id;
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [
            'action_id' => $this->action_id
        ], array_filter([

        ], function($val) {
            return !empty($val);
        }));
    }

}
