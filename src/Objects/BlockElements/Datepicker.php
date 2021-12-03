<?php

namespace Slack\Laravel\Objects\BlockElements;

use DateTime;
use Slack\Laravel\Objects\BlockElements\Concerns;
use Slack\Laravel\Objects\CompositionObjects\ConfirmationDialog;
use Slack\Laravel\Objects\CompositionObjects\Text;

/**
 * An element which lets users easily select a date from a calendar style UI.
 * @link(https://api.slack.com/reference/block-kit/block-elements#datepicker, more)
 *
 * @package Slack\Laravel\Objects\BlockElements
 */
class Datepicker extends InteractiveBlockElement
{

    use Concerns\HasConfirm,
        Concerns\HasPlaceholder;

    /**
     * The initial date that is selected when the element is loaded.
     * This should be in the format YYYY-MM-DD.
     *
     * @var string|null
     */
    private $initial_date;

    /**
     * Datepicker constructor.
     *
     * @param string $action_id
     * @param string|null $placeholder
     * @param \DateTime|null $initial_date
     * @param \Slack\Laravel\Objects\CompositionObjects\ConfirmationDialog|null $confirm
     */
    public function __construct(string $action_id,
                                string $placeholder = null,
                                DateTime $initial_date = null,
                                ConfirmationDialog $confirm = null)
    {
        parent::__construct(InteractiveBlockElement::Datepicker, $action_id);
        $this->placeholder = isset($placeholder) ? new Text(Text::Plain, $placeholder) : null;
        $this->initial_date = isset($initial_date) ? $initial_date->format('Y-m-d') : null;
        $this->confirm = $confirm;
    }

    /**
     * Set the initial picker date.
     *
     * @param DateTime $date
     * @return $this
     */
    public function initialDate(DateTime $date)
    {
        $this->initial_date = $date->format('Y-m-d');
        return $this;
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
            'placeholder' => $this->placeholder,
            'initial_date' => $this->initial_date,
            'confirm' => $this->confirm
        ], function($val) {
            return !empty($val);
        }));
    }

}
