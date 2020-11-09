<?php

namespace Slack\Objects\Blocks;

/**
 * Displays message context, which can include both images and text.
 *
 * https://api.slack.com/reference/block-kit/blocks#context
 */
class ContextBlock extends Block
{

    /**
     * An array of image elements and text objects.
     *
     * @var string
     */
    private $elements = [];

    /**
     * Build a new block instance.
     *
     * @param Slack\Objects\CompositionObjects\Text|Slack\Objects\BlockElements\Image $element The elements of the block.
     */
    public function __construct(array $elements = [])
    {
        parent::__construct(Block::Context);
        $this->elements = $elements;
    }

    /**
     * Add an element.
     *
     * @param  Slack\Objects\CompositionObjects\Text|Slack\Objects\BlockElements\Image $element
     * @return \Slack\Objects\Blocks\ContextBlock
     */
    public function element($element)
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

}
