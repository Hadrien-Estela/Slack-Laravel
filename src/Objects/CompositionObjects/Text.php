<?php

namespace Slack\Objects\CompositionObjects;

use JsonSerializable;

/**
 * An object containing some text, formatted either as plain_text or using mrkdwn.
 * @link(https://api.slack.com/reference/block-kit/composition-objects#text, more)
 *
 * @package Slack\Objects\CompositionObjects
 */
class Text implements JsonSerializable
{

    public const Plain = 'plain_text';
    public const Markdown = 'mrkdwn';

    /**
     * The formatting to use for this text object.
     *
     * @var string
     */
    private $type;

    /**
     * The text for the block.
     *
     * @var string
     */
    private $text;

    /**
     * Indicates whether emojis in a text field should be escaped into the colon emoji format.
     *
     * @var bool|null
     */
    private $emoji;

    /**
     * When set to false (as is default) URLs will be auto-converted into links.
     *
     * @var bool|null
     */
    private $verbatim;

    /**
     * Text constructor.
     *
     * @param string $type
     * @param string $text
     * @param bool|null $emoji
     * @param bool|null $verbatim
     */
    public function __construct(string $type,
                        string $text,
                        bool $emoji = null,
                        bool $verbatim = null)
    {
        $this->type = $type;
        $this->text = $text;
        $this->emoji = $emoji;
        $this->verbatim = $verbatim;
    }

    /**
     * Set text.
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
     * Escape emojis.
     *
     * @return $this
     */
    public function escapeEmoji()
    {
        $this->emoji = true;
        return $this;
    }

    /**
     * Force verbatim text.
     *
     * @return $this
     */
    public function verbatim()
    {
        $this->verbatim = true;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge([
            'type' => $this->type,
            'text' => $this->text,
        ],array_filter([
            'verbatim' => $this->verbatim
        ], function($val) {
            return !empty($val) && $this->type == Text::Markdown;
        }),array_filter([
            'emoji' => $this->emoji
        ], function($val) {
            return !empty($val) && $this->type == Text::Plain;
        }));
    }

}
