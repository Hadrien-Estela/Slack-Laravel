<?php

namespace Slack\Laravel\Objects\Blocks;

use Slack\Laravel\Objects\CompositionObjects\Text;
use Slack\Laravel\Objects\BlockElements\BlockElement;

/**
 * A section is one of the most flexible blocks available.
 * it can be used as a simple text block, in combination with text fields,
 * or side-by-side with any of the available block elements.
 * @link(https://api.slack.com/reference/block-kit/blocks#section, more)
 *
 * @package Slack\Laravel\Objects\Blocks
 */
class SectionBlock extends Block
{

    /**
     * The text for the block, in the form of a text object.
     * Max length of 3000 characters.
     *
     * @var \Slack\Laravel\Objects\CompositionObjects\Text
     */
    private $text;

    /**
     * An array of text objects.
     * Max length of 2000 characters.
     *
     * @var \Slack\Laravel\Objects\CompositionObjects\Text[]
     */
    private $fields;

    /**
     * One of the available Block elements.
     *
     * @var \Slack\Laravel\Objects\BlockElements\BlockElement;
     */
    private $accessory;

    /**
     * SectionBlock constructor.
     *
     * @param string $text
     * @param bool $markdown
     * @param \Slack\Laravel\Objects\CompositionObjects\Text[] $fields
     * @param \Slack\Laravel\Objects\BlockElements\BlockElement|null $accessory
     */
    public function __construct(string $text = '',
                                bool $markdown = false,
                                array $fields = [],
                                BlockElement $accessory = null)
    {
        parent::__construct(Block::Section);
        $this->text = new Text($markdown ? Text::Markdown : Text::Plain, substr($text,0,3000));
        $this->fields = $fields;
        $this->accessory = $accessory;
    }

    /**
     * Set the main text.
     * Max length of 3000 characters.
     *
     * @param string $text
     * @param bool $markdown
     * @return $this
     */
    public function text(string $text, bool $markdown = false)
    {
        $this->text = new Text($markdown ? Text::Markdown : Text::Plain, substr($text,0,3000));
        return $this;
    }

    /**
     * Add additional text.
     *
     * @param \Slack\Laravel\Objects\CompositionObjects\Text $field
     * @return $this
     */
    public function field(Text $field)
    {
        array_push($this->fields, $field);
        return $this;
    }

    /**
     * Set Accessory.
     *
     * @param \Slack\Laravel\Objects\BlockElements\BlockElement $element
     * @return $this
     */
    public function accessory(BlockElement $element)
    {
        $this->accessory = $element;
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
            'text' => $this->text
        ], array_filter([
            'fields' => $this->fields,
            'accessory' => $this->accessory
        ], function($val) {
            return !empty($val);
        }));
    }

}
