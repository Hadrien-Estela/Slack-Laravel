<?php

namespace Slack\Objects\Attachments;

use JsonSerializable;
use Slack\Objects\Blocks\Block;

/**
 * Secondary content can be attached to messages
 * @link(https://api.slack.com/reference/messaging/attachments, more)
 *
 * @package Slack\Objects\Attachments
 */
class Attachment implements JsonSerializable
{

    /**
     * Changes the color of the border on the left side of this attachment
     * from the default gray. Can either be one of good (green),
     * warning (yellow), danger (red), or any hex color code (eg. #439FE0)
     * Default value is gray
     *
     * @var string|null
     */
    private $color;

    /**
     * An array of layout blocks
     *
     * @var \Slack\Objects\Blocks\Block[]
     */
    private $blocks = [];

    /**
     * A valid URL that displays a small 16px by 16px image to the left
     * of the author_name text. Will only work if author_name is present.
     *
     * @var string|null
     */
    private $author_icon;

    /**
     * A valid URL that will hyperlink the author_name text. Will only
     * work if author_name is present.
     *
     * @var string|null
     */
    private $author_link;

    /**
     * Small text used to display the author's name.
     *
     * @var string|null
     */
    private $author_name;

    /**
     * A plain text summary of the attachment used in clients that don't
     * show formatted text (eg. IRC, mobile notifications).
     *
     * @var string|null
     */
    private $fallback;

    /**
     * An array of field objects that get displayed in a table-like way.
     * For best results, include no more than 2-3 field objects.
     *
     * @var \Slack\Objects\Attachments\AttachmentField[]
     */
    private $fields = [];

    /**
     * Some brief text to help contextualize and identify an attachment.
     * Limited to 300 characters, and may be truncated further when displayed
     * to users in environments with limited screen real estate.
     *
     * @var string|null
     */
    private $footer;

    /**
     * A valid URL to an image file that will be displayed beside the footer text.
     * Will only work if author_name is present. We'll render what you provide
     * at 16px by 16px. It's best to use an image that is similarly sized.
     *
     * @var string|null
     */
    private $footer_icon;

    /**
     * A valid URL to an image file that will be displayed at the bottom of the attachment.
     * We support GIF, JPEG, PNG, and BMP formats.
     * Large images will be resized to a maximum width of 360px or a maximum height of 500px,
     * while still maintaining the original aspect ratio. Cannot be used with thumb_url.
     *
     * @var string|null
     */
    private $image_url;

    /**
     * An array of field names that should be formatted by mrkdwn syntax.
     *
     * @var string[]
     */
    private $mrkdwn_in = [];

    /**
     * Text that appears above the message attachment block.
     * It can be formatted as plain text, or with mrkdwn by including it
     * in the mrkdwn_in field.
     *
     * @var string|null
     */
    private $pretext;

    /**
     * The main body text of the attachment.
     * It can be formatted as plain text, or with mrkdwn by including it
     * in the mrkdwn_in field.
     *
     * @var string|null
     */
    private $text;

    /**
     * A valid URL to an image file that will be displayed as a thumbnail
     * on the right side of a message attachment. We currently support the
     * following formats: GIF, JPEG, PNG, and BMP.
     *
     * For best results, please use images that are already 75px by 75px.
     *
     * @var string|null
     */
    private $thumb_url;

    /**
     * Large title text near the top of the attachment.
     *
     * @var string|null
     */
    private $title;

    /**
     * A valid URL that turns the title text into a hyperlink.
     *
     * @var string|null
     */
    private $title_link;

    /**
     * An integer Unix timestamp that is used to related your attachment to a specific time.
     * The attachment will display the additional timestamp value as part of the attachment's footer.
     *
     * @var int
     */
    private $ts;

    /**
     * Set attachment's color.
     *
     * @param string $hex
     * @return $this
     */
    public function color(string $hex)
    {
        $this->color = $hex;
        return $this;
    }

    /**
     * Add success color.
     *
     * @return $this
     */
    public function success()
    {
        $this->color = 'good';
        return $this;
    }

    /**
     * Add warning color.
     *
     * @return $this
     */
    public function warning()
    {
        $this->color = 'warning';
        return $this;
    }

    /**
     * Add danger color.
     *
     * @return $this
     */
    public function error()
    {
        $this->color = 'danger';
        return $this;
    }

    /**
     * Add block.
     *
     * @param \Slack\Objects\Blocks\Block $block
     * @return $this
     */
    public function block(Block $block)
    {
        array_push($this->blocks, $block);
        return $this;
    }

    /**
     * Set author's icon.
     *
     * @param string $url
     * @return $this
     */
    public function authorIcon(string $url)
    {
        $this->author_icon = $url;
        return $this;
    }

    /**
     * Set author's link.
     *
     * @param string $url
     * @return $this
     */
    public function authorLink(string $url)
    {
        $this->author_link = $url;
        return $this;
    }

    /**
     * Set author's name
     *
     * @param string $authorName
     * @return $this
     */
    public function authorName(string $authorName)
    {
        $this->author_name = $authorName;
        return $this;
    }

    /**
     * Set attachment's fallback
     *
     * @param string $fallback
     * @return $this
     */
    public function fallback(string $fallback)
    {
        $this->fallback = $fallback;
        return $this;
    }

    /**
     * Add field.
     *
     * @param \Slack\Objects\Attachments\AttachmentField $field
     * @return $this
     */
    public function field(AttachmentField $field)
    {
        array_push($this->fields, $field);
        return $this;
    }

    /**
     * Set attachment's footer
     *
     * @param string $footer
     * @return $this
     */
    public function footer(string $footer)
    {
        $this->footer = $footer;
        return $this;
    }

    /**
     * Set footer's icon
     *
     * @param string $url
     * @return $this
     */
    public function footerIcon(string $url)
    {
        $this->footer_icon = $url;
        return $this;
    }

    /**
     * Set attachment's image.
     *
     * @param string $url
     * @return $this
     */
    public function image(string $url)
    {
        $this->image_url = $url;
        return $this;
    }

    /**
     * Add markdown field.
     *
     * @param string $field field name
     * @return $this
     */
    public function markdown(string $field)
    {
        array_push($this->mrkdwn_in, $field);
        return $this;
    }

    /**
     * Set attachment's pretext.
     *
     * @param string $pretext
     * @return $this
     */
    public function pretext(string $pretext)
    {
        $this->pretext = $pretext;
        return $this;
    }

    /**
     * Set attachment's text.
     *
     * @param string $text
     * @return $this
     */
    public function text(string $text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Set attachment's thumb icon.
     *
     * @param string $url
     * @return $this
     */
    public function thumb(string $url)
    {
        $this->thumb_url = $url;
        return $this;
    }

    /**
     * Set attachment's title.
     *
     * @param string $title
     * @return $this
     */
    public function title(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Set title link.
     *
     * @param string $url
     * @return $this
     */
    public function titleLink(string $url)
    {
        $this->title_link = $url;
        return $this;
    }

    /**
     * Set UNIX timestamp.
     *
     * @param int $timestamp
     * @return $this
     */
    public function timestamp(int $timestamp)
    {
        $this->ts = $timestamp;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_filter([
            'color' => $this->color,
            'blocks' => $this->blocks(),
            'author_icon' => $this->author_icon,
            'author_link' => $this->author_link,
            'author_name' => $this->author_name,
            'fallback' => $this->fallback,
            'fields' => $this->fields(),
            'footer' => $this->footer,
            'footer_icon' => $this->footer_icon,
            'image_url' => $this->image_url,
            'mrkdwn_in' => $this->mrkdwn_in,
            'pretext' => $this->pretext,
            'text' => $this->text,
            'thumb_url' => $this->thumb_url,
            'title' => $this->title,
            'title_link' => $this->title_link,
            'ts' => $this->ts
        ], function($val) {
            return !empty($val);
        });
    }

    /**
     * Get fields payload.
     *
     * @return array|null
     */
    private function fields()
    {
        $fields = array();
        foreach ($this->fields as $field)
            array_push($fields, $field->jsonSerialize());
        return $fields;
    }

    /**
     * Get blocks payload.
     *
     * @return array
     */
    private function blocks()
    {
        $blocks = array();
        foreach ($this->blocks as $block)
            array_push($blocks, $block->jsonSerialize());
        return $blocks;
    }

}
