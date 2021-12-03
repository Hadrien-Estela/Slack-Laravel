<?php

namespace Slack\Laravel\Objects\BlockElements;

/**
 * Base class for interactive elements.
 *
 * @package Slack\Laravel\Objects\BlockElements
 */
abstract class InteractiveBlockElement extends BlockElement
{

    protected const Button = 'button';
    protected const Checkbox = 'checkboxes';
    protected const Datepicker = 'datepicker';
    protected const TextInput = 'plain_text_input';
    protected const RadioButton = 'radio_buttons';
    protected const Timepicker = 'timepicker';
    protected const OverflowMenu = 'overflow';

    /**
     * An identifier for the action.
     * Max length of 255 characters.
     *
     * @var string
     */
    private $action_id;

    /**
     * InteractiveBlockElement constructor.
     *
     * @param string $type
     * @param string $action_id
     */
    public function __construct(string $type, string $action_id)
    {
        parent::__construct($type);
        $this->action_id = substr($action_id,0,255);
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
