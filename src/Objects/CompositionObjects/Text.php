<?php

namespace Slack\Objects\CompositionObjects;

use JsonSerializable;

/**
 * An object containing some text, formatted either as plain_text or using mrkdwn.
 *
 * https://api.slack.com/reference/block-kit/composition-objects#text
 */
class Text implements JsonSerializable
{

    const Plain = 'plain_text';
    const Markdown = 'mrkdwn';

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
    private $text = "";

    /**
     * Indicates whether emojis in a text field should be escaped into the colon emoji format.
     *
     * @var boolean|null
     */
    private $emoji;

    /**
     * When set to false (as is default) URLs will be auto-converted into links.
     *
     * @var boolean|null
     */
    private $verbatim;

    /**
     * Build a new instance.
     *
     * @param string    $type       The format type.
     * @param string    $text       The text content.
     * @param boolean   $emoji      Should escape emojis.
     * @param boolean   $verbatim   Is it verbatim.
     */
    public function __construct(string $type,
                        string $text = 'Empty Text',
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
     * @param  string $text
     * @return \Slack\Objects\CompositionObjects\Text
     */
    public function text(string $text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Escape emojis
     *
     * @return \Slack\Objects\CompositionObjects\Text
     */
    public function escapeEmoji()
    {
        $this->emoji = true;
        return $this;
    }

    /**
     * Force verbatim text
     *
     * @return \Slack\Objects\CompositionObjects\Text
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
