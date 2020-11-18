<?php

namespace Slack\Objects\BlockElements;

use DateTime;
use Slack\Objects\BlockElements\Concerns;
use Slack\Objects\CompositionObjects\ConfirmationDialog;
use Slack\Objects\CompositionObjects\Text;

/**
 * An element which allows selection of a time of day.
 *
 * @link(https://api.slack.com/reference/block-kit/block-elements#timepicker, more)
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
     *  Build a new instance.
     *
     * @param string                  $action_id    [description]
     * @param string|null             $placeholder  [description]
     * @param DateTime|null          $initial_time [description]
     * @param ConfirmationDialog|null $confirm      [description]
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
     * Set the initiale picker time.
     *
     * @param  DateTime $date
     * @return Timepicker
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
