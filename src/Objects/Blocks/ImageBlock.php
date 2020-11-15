<?php

namespace Slack\Objects\Blocks;

use Slack\Objects\CompositionObjects\Text;

/**
 * A simple image block, designed to make those cat photos really pop.
 *
 * @link(https://api.slack.com/reference/block-kit/blocks#image, more)
 */
class ImageBlock extends Block
{

    /**
     * The URL of the image to be displayed.
     * Max length of 3000 characters.
     *
     * @var string
     */
    private $image_url = '';

    /**
     * A plain-text summary of the image.
     * Max length of 2000 characters.
     *
     * @var string
     */
    private $alt_text = '';

    /**
     * An optional title for the image.
     * Max length of 2000 characters.
     *
     * @var Text
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
        $this->image_url = substr($url,0,3000);
        $this->alt_text = substr($alt,0,2000);
        $this->title = substr($title,0,2000);
    }

    /**
     * Set image URL.
     * Max length of 3000 characters.
     *
     * @param  string $url
     * @return ImageBlock
     */
    public function url(string $url)
    {
        $this->image_url = substr($url,3000);
        return $this;
    }

    /**
     * Set alt text.
     * Max length of 2000 characters.
     *
     * @param  string $text
     * @return ImageBlock
     */
    public function alt(string $text)
    {
        $this->alt_text = substr($text,0,2000);
        return $this;
    }

    /**
     * Set title.
     * Max length of 2000 characters.
     *
     * @param  string $title
     * @return ImageBlock
     */
    public function title(string $title)
    {
        $this->title = new Text(Text::Plain, substr($title,0,2000));
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
            'image_url' => $this->image_url,
            'alt_text' => $this->alt_text
        ], array_filter([
            'title' => $this->title
        ], function($val) {
            return !empty($val);
        }));
    }

}
