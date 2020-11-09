<?php

namespace Slack\Objects\Blocks;

use Slack\Objects\CompositionObjects\Text;

/**
 * A simple image block, designed to make those cat photos really pop.
 *
 * https://api.slack.com/reference/block-kit/blocks#image
 */
class ImageBlock extends Block
{

    /**
     * The URL of the image to be displayed.
     *
     * @var string
     */
    private $image_url = '';

    /**
     * A plain-text summary of the image.
     *
     * @var string
     */
    private $alt_text = '';

    /**
     * An optional title for the image.
     *
     * @var Slack\Objects\CompositionObjects\Text
     */
    private $title;

    /**
     * Build a new block instance.
     *
     * @param string $url The url of the image.
     * @param string $alt The alt text of the image.
     * @param string $title The optional title of the image.
     */
    public function __construct(string $url = '', string $alt = '', Text $title = null)
    {
        parent::__construct(Block::Image);
        $this->image_url = $url;
        $this->alt_text = $alt;
        $this->title = $title;
    }

    /**
     * Set image URL
     *
     * @param  string $url
     * @return \Slack\Objects\Blocks\ImageBlock
     */
    public function url(string $url)
    {
        $this->image_url = $url;
        return $this;
    }

    /**
     * Set alt text.
     *
     * @param  string $text
     * @return \Slack\Objects\Blocks\ImageBlock
     */
    public function alt(string $text)
    {
        $this->alt_text =$text;
        return $this;
    }

    /**
     * Set title.
     *
     * @param  string $title
     * @return \Slack\Objects\Blocks\ImageBlock
     */
    public function title(string $title)
    {
        $this->title = new Text(Text::Plain, $title);
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
            'image_url' => $this->image_url,
            'alt_text' => $this->alt_text
        ], array_filter([
            'title' => $this->title
        ], function($val) {
            return !empty($val);
        }));
    }

}
