<?php

namespace Slack\Objects\CompositionObjects;

use JsonSerializable;

/**
 * An object containing some text, formatted either as plain_text or using mrkdwn.
 * @link(https://api.slack.com/reference/block-kit/composition-objects#option_group, more)
 *
 * @package Slack\Objects\CompositionObjects
 */
class OptionGroup implements JsonSerializable
{

    /**
     * A plain_text only text object that defines the label shown above this group of options.
     * Max length of 75 characters.
     *
     * @var \Slack\Objects\CompositionObjects\Text
     */
    private $label;

    /**
     * An array of option objects that belong to this specific group.
     * Maximum of 100 items.
     *
     * @var \Slack\Objects\CompositionObjects\Option[]
     */
    private $options;

    /**
     * OptionGroup constructor.
     *
     * @param string $label
     * @param \Slack\Objects\CompositionObjects\Option[] $options
     */
    public function __construct(string $label, array $options = [])
    {
        $this->label = new Text(Text::Plain, $label);
        $this->options = $options;
    }

    /**
     * Set the label.
     * Max length of 75 characters.
     *
     * @param string $label
     * @return $this
     */
    public function label(string $label)
    {
        $this->label->text($label);
        return $this;
    }

    /**
     * Add an option.
     * Maximum of 100 items.
     *
     * @param \Slack\Objects\CompositionObjects\Option $option
     * @return $this
     */
    public function option(Option $option)
    {
        array_push($this->options, $option);
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'label' => $this->label,
            'options' => $this->options()
        ];
    }

    /**
     * Get the options payload.
     *
     * @return array
     */
    private function options()
    {
        $options = array();
        foreach ($this->options as $option)
            array_push($options, $option->jsonSerialize());
        return $options;
    }

}
