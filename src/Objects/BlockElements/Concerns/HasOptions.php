<?php

namespace Slack\Objects\BlockElements\Concerns;

use Slack\Objects\CompositionObjects\Option;
use Slack\Objects\CompositionObjects\OptionGroup;

trait HasOptions
{

    /**
     * An array of option.
     *
     * @var Option[]
     */
    private $options = [];

    /**
     * An option object that exactly matches one of the options within options.
     *
     * @var array Option|null
     */
    private $initial_option;

    /**
     * An array of option objects that exactly matches one or more of
     * the options within options.
     *
     * @var Option[]
     */
    private $initial_options = [];

    /**
     * An array of option group objects.
     *
     * @var OptionGroup[]
     */
    private $option_groups = [];

    /**
     * Add an option.
     *
     * @param  Option $option
     * @param  bool|boolean $initial
     * @return BlockElement
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
     * @param  OptionGroup      $group
     * @param  bool|boolean     $initial
     * @return BlockElement
     */
    public function group(OptionGroup $group, bool $initial = false)
    {
        array_push($this->option_groups, $group);
         if ($initial)
            $this->initial_option = $group;
        return $this;
    }

    /**
     * Set the initial option.
     *
     * @param  Option $option
     * @return BlockElement
     */
    public function initialOption(Option $option)
    {
        $this->initial_option = $option;
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
    private function initialOptions()
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
