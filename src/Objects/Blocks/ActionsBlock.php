<?php

namespace Slack\Objects\Blocks;

use Slack\Objects\BlockElements\InteractiveBlockElement;

/**
 * A block that is used to hold interactive elements.
 * @link(https://api.slack.com/reference/block-kit/blocks#actions, more)
 *
 * @package Slack\Objects\Blocks
 */
class ActionsBlock extends Block
{

    /**
     * An array of interactive element.
     *
     * @var \Slack\Objects\BlockElements\InteractiveBlockElement[]
     */
    private $elements;

    /**
     * ActionsBlock constructor.
     *
     * @param \Slack\Objects\BlockElements\InteractiveBlockElement[] $elements
     */
    public function __construct(array $elements = [])
    {
        parent::__construct(Block::Actions);
        $this->elements = $elements;
    }

    /**
     * Add an interactive element.
     *
     * @param \Slack\Objects\BlockElements\InteractiveBlockElement $element
     * @return $this
     */
    public function element(InteractiveBlockElement $element)
    {
        array_push($this->elements, $element);
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
            'elements' => $this->elements()
        ]);
    }

    /**
     * Get elements payload.
     *
     * @return array
     */
    private function elements()
    {
        $elements = array();
        foreach ($this->elements as $element)
            array_push($elements, $element->jsonSerialize());
        return $elements;
    }

    /**
     * Check if block is empty.
     *
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->elements);
    }

}
