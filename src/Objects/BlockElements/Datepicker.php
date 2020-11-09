<?php

namespace Slack\Objects\BlockElements;

use Slack\Objects\BlockElements\InteractiveBlockElement;
use Slack\Objects\BlockElements\Concerns;
use Slack\Objects\CompositionObjects\ConfirmationDialog;
use Slack\Objects\CompositionObjects\Text;

/**
 * An element which lets users easily select a date from a calendar style UI.
 *
 * https://api.slack.com/reference/block-kit/block-elements#datepicker
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
     * Build a new instance.
     *
     * @param string                  $action_id    [description]
     * @param string|null             $placeholder  [description]
     * @param \DateTime|null          $initial_date [description]
     * @param ConfirmationDialog|null $confirm      [description]
     */
    public function __construct(string $action_id,
                                string $placeholder = null,
                                \DateTime $initial_date = null,
                                ConfirmationDialog $confirm = null)
    {
        parent::__construct(InteractiveBlockElement::Datepicker, $action_id);
        $this->placeholder = isset($placeholder) ? new Text(Text::Plain, $placeholder) : null;
        $this->initial_date = isset($initial_date) ? $initial_date->format('Y-m-d') : null;
        $this->confirm = $confirm;
    }

    /**
     * Set the initiale picker date.
     *
     * @param  \DateTime $date
     * @return \Slack\Objects\BlockElements\Datepicker
     */
    public function initialDate(\DateTime $date)
    {
        $this->initial_date = $date->format('Y-m-d');
        return $this;
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

        ], array_filter([
            'placeholder' => $this->placeholder,
            'initial_date' => $this->initial_date,
            'confirm' => $this->confirm
        ], function($val) {
            return !empty($val);
        }));
    }

}
