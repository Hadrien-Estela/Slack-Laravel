<?php

namespace Slack\Objects\Blocks;

use Slack\Objects\CompositionObjects\Text;
use Slack\Objects\BlockElements\BlockElement;

/**
 * A section is one of the most flexible blocks available.
 * it can be used as a simple text block, in combination with text fields,
 * or side-by-side with any of the available block elements.
 *
 * https://api.slack.com/reference/block-kit/blocks#section
 */
class SectionBlock extends Block
{

    /**
     * The text for the block, in the form of a text object.
     *
     * @var Slack\Objects\CompositionObjects\Text
     */
    private $text;

    /**
     * An array of text objects.
     *
     * @var array
     */
    private $fields = [];

    /**
     * One of the available Block elements.
     *
     * @var Slack\Objects\BlockElements\BlockElement;
     */
    private $accessory;

    /**
     * Build a new block instance.
     *
     * @param string       $text
     * @param bool|boolean $markdown
     */
    public function __construct(string $text = '', bool $markdown = false)
    {
        parent::__construct(Block::Section);
        $this->text = new Text($markdown ? Text::Markdown : Text::Plain, $text);
    }

    /**
     * Set the main text.
     *
     * @param  string   $text
     * @param  boolean  $markdown
     * @return \Slack\Objects\Blocks\SectionBlock
     */
    public function text(string $text, bool $markdown = false)
    {
        $this->text = new Text($markdown ? Text::Markdown : Text::Plain, $text);
        return $this;
    }

    /**
     * Add additionnal text.
     *
     * @param  Text   $field
     * @return \Slack\Objects\Blocks\SectionBlock
     */
    public function field(Text $field)
    {
        array_push($this->fields, $field);
        return $this;
    }

    /**
     * Set Accessory.
     *
     * @param  BlockElement $element
     * @return \Slack\Objects\Blocks\SectionBlock
     */
    public function accessory(BlockElement $element)
    {
        $this->accessory = $element;
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
            'text' => $this->text
        ], array_filter([
            'fields' => $this->fields,
            'accessory' => $this->accessory
        ], function($val) {
            return !empty($val);
        }));
    }

    /**
     * Get fields as serializable array.
     *
     * @return array
     */
    private function fields()
    {
        $fields = array();
        foreach ($this->fields as $field)
            array_push($fields, $field->jsonSerialize());
        return $fields;
    }

}
