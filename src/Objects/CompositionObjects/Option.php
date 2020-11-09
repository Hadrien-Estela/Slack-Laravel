<?php

namespace Slack\Objects\CompositionObjects;

use JsonSerializable;

/**
 * An object containing some text, formatted either as plain_text or using mrkdwn.
 *
 * https://api.slack.com/reference/block-kit/composition-objects#option
 */
class Option implements JsonSerializable
{

    /**
     * A text object that defines the text shown in the option on the menu.
     *
     * @var Slack\Objects\CompositionObjects\Text
     */
    private $text;

    /**
     * The string value that will be passed to your app when this option is chosen.
     *
     * @var string
     */
    private $value = '';

    /**
     * A plain_text only text object that defines a line of descriptive text
     * shown below the text field beside the radio button.
     *
     * @var Slack\Objects\CompositionObjects\Text
     */
    private $description;

    /**
     * A URL to load in the user's browser when the option is clicked
     *
     * @var string
     */
    private $url;

    /**
     * Build a new instance.
     *
     * @param string       $text        option text
     * @param string       $value       option value
     * @param bool|boolean $markdown    is markdown
     * @param string|null  $description description
     * @param string|null  $url         url
     */
    public function __construct(string $text,
                        string $value = 'null',
                        bool $markdown = false,
                        string $description = null,
                        string $url = null)
    {
        $this->text = new Text($markdown ? Text::Markdown : Text::Plain, $text);
        $this->value = $value;
        $this->description = isset($description) ? new Text(Text::Plain, $description) : null;
        $this->url = $url;
    }

    /**
     * Set the text.
     *
     * @param  string       $text
     * @param  bool|boolean $markdown
     * @return \Slack\Objects\CompositionObjects\Option
     */
    public function text(string $text, bool $markdown = false)
    {
        $this->text = new Text($markdown ? Text::Markdown : Text::Plain, $text);
        return $this;
    }

    /**
     * Set the value
     *
     * @param  string $value
     * @return \Slack\Objects\CompositionObjects\Option
     */
    public function value(string $value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * Set the description.
     *
     * @param  string $description
     * @return \Slack\Objects\CompositionObjects\Option
     */
    public function description(string $description)
    {
        $this->description = new Text(Text::Plain, $description);
        return $this;
    }

    /**
     * Set the url
     *
     * @param  string $url
     * @return \Slack\Objects\CompositionObjects\Option
     */
    public function url(string $url)
    {
        $this->url = $url;
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
            'text' => $this->text,
            'value' => $this->value
        ],array_filter([
            'description' => $this->description,
            'url' => $this->url
        ], function($val) {
            return !empty($val);
        }));
    }

}
