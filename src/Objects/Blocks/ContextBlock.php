<?php

namespace Slack\Laravel\Objects\Blocks;

/**
 * Displays message context, which can include both images and text.
 * @link(https://api.slack.com/reference/block-kit/blocks#context, more)
 *
 * @package Slack\Laravel\Objects\Blocks
 */
class ContextBlock extends Block
{

    /**
     * An array of image elements and text objects.
     *
     * @var array
     */
    private $elements;

    /**
     * ContextBlock constructor.
     *
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        parent::__construct(Block::Context);
        $this->elements = $elements;
    }

    /**
     * Add an element.
     *
     * @param \Slack\Laravel\Objects\CompositionObjects\Text|\Slack\Laravel\Objects\BlockElements\Image $element
     * @return $this
     */
    public function element($element)
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

}
