<?php

namespace Slack\Objects\BlockElements\Concerns;

use Slack\Objects\CompositionObjects\Option;
use Slack\Objects\CompositionObjects\OptionGroup;

/**
 * Trait for Block elements with `options` attribute.
 *
 * @package Slack\Objects\BlockElements\Concerns
 */
trait HasOptions
{

    /**
     * An array of option.
     *
     * @var \Slack\Objects\CompositionObjects\Option[]
     */
    private $options = [];

    /**
     * An option object that exactly matches one of the options within options.
     *
     * @var \Slack\Objects\CompositionObjects\Option
     */
    private $initial_option;

    /**
     * An array of option objects that exactly matches one or more of
     * the options within options.
     *
     * @var \Slack\Objects\CompositionObjects\Option[]
     */
    private $initial_options = [];

    /**
     * An array of option group objects.
     *
     * @var \Slack\Objects\CompositionObjects\OptionGroup[]
     */
    private $option_groups = [];

    /**
     * @param \Slack\Objects\CompositionObjects\Option $option
     * @param bool $initial
     * @return $this
     */
    public function option(Option $option, bool $initial = false)
    {
        array_push($this->options, $option);
        if ($initial)
        {
            $this->initial_option = $option;
            array_push($this->initial_options, $option);
        }
        return $this;
    }

    /**
     * Add an options group
     *
     * @param \Slack\Objects\CompositionObjects\OptionGroup $group
     * @param bool $initial
     * @return $this
     */
    public function group(OptionGroup $group, bool $initial = false)
    {
        array_push($this->option_groups, $group);
        return $this;
    }

    /**
     * Set the initial option.
     *
     * @param Option $option
     * @return $this
     */
    public function initialOption(Option $option)
    {
        $this->initial_option = $option;
        return $this;
    }

    /**
     * Set the initial options.
     *
     * @param Option[] $option
     * @return $this
     */
    public function initialOptions(array $options)
    {
        $this->initial_options = $options;
        return $this;
    }


    /**
     * Get the serializable options Array.
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

    /**
     * Get the serializable options Array.
     *
     * @return array
     */
    private function initial_options()
    {
        $options = array();
        foreach ($this->initial_options as $option)
            array_push($options, $option->jsonSerialize());
        return $options;
    }

    /**
     * Get the array of serializable option groups.
     *
     * @return array
     */
    private function groups()
    {
        $groups = array();
        foreach ($this->option_groups as $group)
            array_push($groups, $group->jsonSerialize());
        return $groups;
    }

}
