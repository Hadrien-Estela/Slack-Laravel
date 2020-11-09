<?php

namespace Slack\Objects\Blocks;

use Slack\Objects\CompositionObjects\Text;
use Slack\Objects\BlockElements\InteractiveBlockElement;

/**
 * A block that is used to hold interactive elements.
 *
 * https://api.slack.com/reference/block-kit/blocks#actions
 */
class ActionsBlock extends Block
{

    /**
     * An array of interactive element.
     *
     * @var array of Slack\Objects\BlockElements\InteractiveBlockElement
     */
    private $elements = [];

    /**
     * Build a new block instance.
     */
    public function __construct()
    {
        parent::__construct(Block::Actions);
    }

    /**
     * Add an interactive element.
     *
     * @param  Slack\Objects\BlockElements\InteractiveBlockElement $element
     * @return \Slack\Objects\Blocks\ActionsBlock
     */
    public function element(InteractiveBlockElement $element)
    {
        array_push($this->elements, $element);
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
            'elements' => $this->elements()
        ]);
    }

    /**
     * Get elements as serializable array.
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
     * Check if block is empty
     *
     * @return boolean
     */
    public function isEmpty()
    {
        return empty($this->elements);
    }

}
