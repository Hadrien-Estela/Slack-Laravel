<?php

namespace Slack\Laravel\Objects\BlockElements;

use DateTime;
use Slack\Laravel\Objects\BlockElements\Concerns;
use Slack\Laravel\Objects\CompositionObjects\ConfirmationDialog;
use Slack\Laravel\Objects\CompositionObjects\Text;

/**
 * An element which allows selection of a time of day.
 * @link(https://api.slack.com/reference/block-kit/block-elements#timepicker, more)
 *
 * @package Slack\Laravel\Objects\BlockElements
 */
class Timepicker extends InteractiveBlockElement
{

    use Concerns\HasConfirm,
        Concerns\HasPlaceholder;

    /**
     * The initial time that is selected when the element is loaded.
     * This should be in the format HH:mm, where HH is the 24-hour
     * format of an hour (00 to 23) and mm is minutes with leading
     * zeros (00 to 59), for example 22:25 for 10:25pm.
     *
     * @var string|null
     */
    private $initial_time;

    /**
     * Timepicker constructor.
     *
     * @param string $action_id
     * @param string|null $placeholder
     * @param \DateTime|null $initial_time
     * @param \Slack\Laravel\Objects\CompositionObjects\ConfirmationDialog|null $confirm
     */
    public function __construct(string $action_id,
                                string $placeholder = null,
                                DateTime $initial_time = null,
                                ConfirmationDialog $confirm = null)
    {
        parent::__construct(InteractiveBlockElement::Timepicker, $action_id);
        $this->placeholder = isset($placeholder) ? new Text(Text::Plain, $placeholder) : null;
        $this->initial_time = isset($initial_time) ? $initial_time->format('H:i') : null;
        $this->confirm = $confirm;
    }

    /**
     * Set the initial picker time.
     *
     * @param \DateTime $date
     * @return $this
     */
    public function initialTime(DateTime $date)
    {
        $this->initial_time = $date->format('Y-m-d');
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
            'initial_time' => $this->initial_time,
            'confirm' => $this->confirm
        ], function($val) {
            return !empty($val);
        }));
    }

}
