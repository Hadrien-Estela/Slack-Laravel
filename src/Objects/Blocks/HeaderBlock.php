<?php

namespace Slack\Objects\Blocks;

use Slack\Objects\CompositionObjects\Text;

/**
 * A header is a plain-text block that displays in a larger, bold font.
 * Use it to delineate between different groups of content in your app's surfaces.
 * @link(https://api.slack.com/reference/block-kit/blocks#header, more)
 *
 * @packages Slack\Objects\Blocks
 */
class HeaderBlock extends Block
{

    /**
     * The text for the block, in the form of a plain_text text object.
     * Maximum length for the text in this field is 150 characters.
     * Max length of 150 characters.
     *
     * @var \Slack\Objects\CompositionObjects\Text
     */
    private $text;

    /**
     * HeaderBlock constructor.
     *
     * @param string $text
     */
    public function __construct(string $text)
    {
        parent::__construct(Block::Header);
        $this->text = new Text(Text::Plain, substr($text,0,150));
    }

    /**
     * Set header block's text.
     * Max length of 150 characters.
     *
     * @param string $text
     * @return $this
     */
    public function text(string $text)
    {
        $this->text->text(substr($text,0,150));
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
