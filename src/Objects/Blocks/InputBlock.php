<?php

namespace Slack\Objects\Blocks;

use Slack\Objects\CompositionObjects\Text;
use Slack\Objects\BlockElements\InteractiveBlockElement;

/**
 * A block that collects information from users.
 *
 * https://api.slack.com/reference/block-kit/blocks#input
 */
class InputBlock extends Block
{

    /**
     * A label that appears above an input element in the form.
     *
     * @var Slack\Objects\CompositionObjects\Text
     */
    private $label;

    /**
     * The input element.
     *
     * @var Slack\Objects\BlockElements\InteractiveBlockElement
     */
    private $element;

    /**
     * A boolean that indicates whether or not the use of elements
     * in this block should dispatch a block_actions payload.
     * Defaults to false.
     *
     * @var boolean
     */
    private $dispatch_action;

    /**
     * An optional hint that appears below an input element in a lighter grey.
     *
     * @var Slack\Objects\CompositionObjects\Text
     */
    private $hint;

    /**
     * A boolean that indicates whether the input element may be empty when
     * a user submits the modal.
     * Defaults to false.
     *
     * @var boolean
     */
    private $optional;

    /**
     * Build a new block instance.
     *
     * @param string                       $label   The input label
     * @param InteractiveBlockElement|null $element The input element.
     */
    public function __construct(string $label = 'Label',
                                InteractiveBlockElement $element = null,
                                bool $optional = null,
                                string $hint = null)
    {
        parent::__construct(Block::Input);
        $this->label = new Text(Text::Plain, $label);
        $this->element = $element;
        $this->optional = $optional;
        if ($hint)
            $this->hint = new Text(Text::Plain, $hint);
    }

    /**
     * Set the label.
     *
     * @param  string $label
     * @return \Slack\Objects\Blocks\InputBlock
     */
    public function label(string $label)
    {
        $this->label->text($label);
        return $this;
    }

    /**
     * Set the input element.
     *
     * @param  InteractiveBlockElement $element
     * @return \Slack\Objects\Blocks\InputBlock
     */
    public function element(InteractiveBlockElement $element)
    {
        $this->element = $element;
        return $this;
    }

    /**
     * Should dispatch the action.
     *
     * @param  boolean $dispatch
     * @return \Slack\Objects\Blocks\InputBlock
     */
    public function dispatch(bool $dispatch)
    {
        $this->dispatch = $dispatch;
        return $this;
    }

    /**
     * Set input Hint.
     *
     * @param  string $hint
     * @return \Slack\Objects\Blocks\InputBlock
     */
    public function hint(string $hint)
    {
        $this->hint = new Text(Text::Plain, $hint);
        return $this;
    }

    /**
     * Set Input as optional.
     *
     * @param  boolean $optional
     * @return \Slack\Objects\Blocks\InputBlock
     */
   public function optional(bool $optional)
    {
        $this->optional = $optional;
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
