<?php

namespace Slack\Objects\BlockElements;

use Slack\Objects\BlockElements\BlockElement;

/**
 * An element to insert an image as part of a larger block of content.
 *
 * @link(https://api.slack.com/reference/block-kit/block-elements#image, more)
 */
class Image extends BlockElement
{

    /**
     * The URL of the image to be displayed.
     *
     * @var string
     */
    private $image_url = '';

    /**
     * A plain-text summary of the image. This should not contain any markup.
     *
     * @var string
     */
    private $alt_text = '';

    /**
     * Build new Instance.
     *
     * @param string $url The url of the image.
     * @param string $alt The alternative text of the image.
     */
    public function __construct(string $url = '', string $alt = '')
    {
        parent::__construct(BlockElement::Image);
        $this->url = $url;
        $this->alt = $alt;
    }

    /**
     * Set image URL.
     *
     * @param  string $url
     * @return Image
     */
    public function url(string $url)
    {
        $this->image_url = $url;
        return $this;
    }

    /**
     * Set alternative text.
     *
     * @param  string $text
     * @return Image
     */
    public function alt(string $text)
    {
        $this->alt_text = $text;
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
        ]);
    }

}
