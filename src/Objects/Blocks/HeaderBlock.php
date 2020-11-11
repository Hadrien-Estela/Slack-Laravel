<?php

namespace Slack\Objects\Blocks;

use Slack\Objects\CompositionObjects\Text;

/**
 * A header is a plain-text block that displays in a larger, bold font.
 * Use it to delineate between different groups of content in your app's surfaces.
 *
 * @link(https://api.slack.com/reference/block-kit/blocks#header, more)
 */
class HeaderBlock extends Block
{

    /**
     * The text for the block, in the form of a plain_text text object.
     * Maximum length for the text in this field is 150 characters.
     *
     * @var Text
     */
    private $text = '';

    /**
     * Build a new block instance.
     *
     * @param string $text The text content.
     */
    public function __construct(string $text = '')
    {
        parent::__construct(Block::Header);
        $this->text = new Text(Text::Plain, $text);
    }

    /**
     * Set header block's text
     *
     * @param  string $text
     * @return HeaderBlock
     */
    public function text(string $text)
    {
        $this->text->text($text);
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
        ]);
    }

}
