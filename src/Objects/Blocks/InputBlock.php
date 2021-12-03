<?php

namespace Slack\Laravel\Objects\Blocks;

use Slack\Laravel\Objects\CompositionObjects\Text;
use Slack\Laravel\Objects\BlockElements\InteractiveBlockElement;

/**
 * A block that collects information from users.
 * @link(https://api.slack.com/reference/block-kit/blocks#input, more)
 *
 * @package Slack\Laravel\Objects\Blocks
 */
class InputBlock extends Block
{

    /**
     * A label that appears above an input element in the form.
     * Max length of 2000 characters.
     *
     * @var \Slack\Laravel\Objects\CompositionObjects\Text
     */
    private $label;

    /**
     * The input element.
     *
     * @var \Slack\Laravel\Objects\BlockElements\InteractiveBlockElement
     */
    private $element;

    /**
     * A boolean that indicates whether or not the use of elements
     * in this block should dispatch a block_actions payload.
     * Defaults to false.
     *
     * @var bool
     */
    private $dispatch_action;

    /**
     * An optional hint that appears below an input element in a lighter grey.
     * Max length of 2000 characters.
     *
     * @var \Slack\Laravel\Objects\CompositionObjects\Text
     */
    private $hint;

    /**
     * A boolean that indicates whether the input element may be empty when
     * a user submits the modal.
     * Defaults to false.
     *
     * @var bool
     */
    private $optional;

    /**
     * InputBlock constructor.
     *
     * @param string $label
     * @param \Slack\Laravel\Objects\BlockElements\InteractiveBlockElement|null $element
     * @param bool|null $optional
     * @param string|null $hint
     */
    public function __construct(string $label = 'Label',
                                InteractiveBlockElement $element = null,
                                bool $optional = null,
                                string $hint = null)
    {
        parent::__construct(Block::Input);
        $this->label = new Text(Text::Plain, substr($label,0,2000));
        $this->element = $element;
        $this->optional = $optional;
        if ($hint)
            $this->hint = new Text(Text::Plain, substr($hint,0,2000));
    }

    /**
     * Set the label.
     * Max length of 2000 characters.
     *
     * @param string $label
     * @return $this
     */
    public function label(string $label)
    {
        $this->label->text(substr($label,0,2000));
        return $this;
    }

    /**
     * Set the input element.
     *
     * @param \Slack\Laravel\Objects\BlockElements\InteractiveBlockElement $element
     * @return $this
     */
    public function element(InteractiveBlockElement $element)
    {
        $this->element = $element;
        return $this;
    }

    /**
     * Should dispatch the action.
     *
     * @param bool $dispatch
     * @return $this
     */
    public function dispatch(bool $dispatch)
    {
        $this->dispatch_action = $dispatch;
        return $this;
    }

    /**
     * Set input Hint.
     * Max length of 2000 characters.
     *
     * @param string $hint
     * @return $this
     */
    public function hint(string $hint)
    {
        $this->hint = new Text(Text::Plain, substr($hint,0,2000));
        return $this;
    }

    /**
     * Set Input as optional.
     *
     * @param bool $optional
     * @return $this
     */
   public function optional(bool $optional)
    {
        $this->optional = $optional;
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
            'label' => $this->label,
            'element' => $this->element
        ], array_filter([
            'dispatch_action'=> $this->dispatch_action,
            'hint'=> $this->hint,
            'optional'=> $this->optional
        ], function($val) {
            return !empty($val);
        }));
    }

}
