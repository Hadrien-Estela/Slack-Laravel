<?php

namespace Slack\Objects\CompositionObjects;

use JsonSerializable;
use Slack\Objects\CompositionObjects\Text;
use Slack\Objects\CompositionObjects\Option;

/**
 * An object containing some text, formatted either as plain_text or using mrkdwn.
 *
 * https://api.slack.com/reference/block-kit/composition-objects#option_group
 */
class OptionGroup implements JsonSerializable
{

    /**
     * A plain_text only text object that defines the label shown above this group of options.
     *
     * @var Slack\Objects\CompositionObjects\Text
     */
    private $label;

    /**
     * An array of option objects that belong to this specific group.
     *
     * @var array
     */
    private $options = [];

    /**
     * Build a new instance.
     *
     * @param string $label   the group label
     * @param array  $options the group options
     */
    public function __construct(string $label = '', array $options = [])
    {
        $this->label = new Text(Text::Plain, $label);
        $this->options = $options;
    }

    /**
     * Set the label.
     *
     * @param  string $label
     * @return \Slack\Objects\CompositionObjects\OptionGroup
     */
    public function label(string $label)
    {
        $this->label->text($label);
        return $this;
    }

    /**
     * Add an option.
     *
     * @param  Slack\Objects\CompositionObjects\Option $option
     * @return \Slack\Objects\CompositionObjects\OptionGroup
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

    private function options()
    {
        $options = array();
        foreach ($this->options as $option)
            array_push($options, $option->jsonSerialize());
        return $options;
    }

}
