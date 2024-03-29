<?php

namespace Slack\Laravel\Objects\BlockElements;

use Slack\Laravel\Objects\BlockElements\Concerns;
use Slack\Laravel\Objects\CompositionObjects\Text;
use Slack\Laravel\Objects\CompositionObjects\DispatchActionConfig as DispatchActionConfigAlias;

/**
 * A plain-text input, similar to the HTML <input> tag,
 * creates a field where a user can enter freeform data.
 * It can appear as a single-line field or a larger textarea using the multiline flag.
 * @link(https://api.slack.com/reference/block-kit/block-elements#input, more)
 *
 * @package Slack\Laravel\Objects\BlockElements
 */
class TextInput extends InteractiveBlockElement
{

    use Concerns\HasPlaceholder;

    /**
     * The initial value in the plain-text input when it is loaded.
     *
     * @var string|null
     */
    private $initial_value;

    /**
     * Indicates whether the input will be a single line (false) or a larger textarea (true).
     * Defaults to false.
     *
     * @var bool|null
     */
    private $multiline;

    /**
     * The minimum length of input that the user must provide.
     * If the user provides less, they will receive an error.
     *
     * @var int|null
     */
    private $min_length;

    /**
     * The maximum length of input that the user can provide.
     * If the user provides more, they will receive an error.
     * Default is 3000
     *
     * @var int|null
     */
    private $max_length;

    /**
     * A dispatch configuration object that determines when during
     * text input the element returns a block_actions payload.
     *
     * @var DispatchActionConfigAlias|null
     */
    private $dispatch_action_config;

    /**
     * TextInput constructor.
     *
     * @param string $action_id
     * @param string|null $placeholder
     * @param string|null $initialValue
     * @param bool|null $multiline
     * @param int|null $minLength
     * @param int|null $maxLength
     * @param \Slack\Laravel\Objects\CompositionObjects\DispatchActionConfig|null $dispatchConfig
     */
    public function __construct(string $action_id,
                                string $placeholder = null,
                                string $initialValue = null,
                                bool $multiline = null,
                                int $minLength = null,
                                int $maxLength = null,
                                DispatchActionConfigAlias $dispatchConfig = null)
    {
        parent::__construct(InteractiveBlockElement::TextInput, $action_id);
        $this->placeholder = isset($placeholder) ? new Text(Text::Plain, $placeholder) : null;
        $this->initial_value = $initialValue;
        $this->multiline = $multiline;
        $this->min_length = $minLength;
        $this->max_length = $maxLength;
        $this->dispatch_action_config = $dispatchConfig;
    }

    /**
     * Set the initial value.
     *
     * @param string $initialValue
     * @return $this
     */
    public function initialValue(string $initialValue)
    {
        $this->initial_value = $initialValue;
        return $this;
    }

    /**
     * make the input multiline.
     *
     * @return $this
     */
    public function multiline()
    {
        $this->multiline = true;
        return $this;
    }

    /**
     * Set the min length.
     *
     * @param int $min
     * @return $this
     */
    public function minLength(int $min)
    {
        $this->min_length= $min;
        return $this;
    }

    /**
     * Set the max length.
     *
     * @param int $max
     * @return $this
     */
    public function maxLength(int $max)
    {
        $this->max_length= $max;
        return $this;
    }

    /**
     * Set the dispatch config.
     *
     * @param \Slack\Laravel\Objects\CompositionObjects\DispatchActionConfig $config
     * @return $this
     */
    public function dispatchConfig(DispatchActionConfigAlias $config)
    {
        $this->dispatch_action_config = $config;
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
            'initial_value' => $this->initial_value,
            'multiline' => $this->multiline,
            'min_length' => $this->min_length,
            'max_length' => $this->max_length,
            'dispatch_action_config' => $this->dispatch_action_config
        ], function($val) {
            return !empty($val);
        }));
    }

}
