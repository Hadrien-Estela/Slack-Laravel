<?php

namespace Slack\Laravel\Objects\CompositionObjects;

use JsonSerializable;

/**
 * An object containing some text, formatted either as plain_text or using mrkdwn.
 * @link(https://api.slack.com/reference/block-kit/composition-objects#option, more)
 *
 * @package Slack\Laravel\Objects\CompositionObjects
 */
class Option implements JsonSerializable
{

    /**
     * A text object that defines the text shown in the option on the menu.
     * Max length of 75 characters.
     *
     * @var \Slack\Laravel\Objects\CompositionObjects\Text
     */
    private $text;

    /**
     * The string value that will be passed to your app when this option is chosen.
     * Max length of 74 characters.
     *
     * @var string
     */
    private $value;

    /**
     * A plain_text only text object that defines a line of descriptive text
     * shown below the text field beside the radio button.
     * Max length of 75 characters.
     *
     * @var \Slack\Laravel\Objects\CompositionObjects\Text
     */
    private $description;

    /**
     * A URL to load in the user's browser when the option is clicked.
     * Max length of 3000 characters.
     *
     * @var string
     */
    private $url;

    /**
     * Option constructor.
     *
     * @param string $text
     * @param string $value
     * @param bool $markdown
     * @param string|null $description
     * @param string|null $url
     */
    public function __construct(string $text,
                        string $value = 'null',
                        bool $markdown = false,
                        string $description = null,
                        string $url = null)
    {
        $this->text = new Text($markdown ? Text::Markdown : Text::Plain, substr($text,0,75));
        $this->value = substr($value,0,75);
        $this->description = isset($description) ? new Text(Text::Plain, substr($description,0,75)) : null;
        $this->url = substr($url,0,3000);
    }

    /**
     * Create instance from object.
     *
     * @param Object $option_object
     * @return $this
     */
    public static function formObject(Object $option_object)
    {
        return new Option($option_object->text,
                            $option_object->value,
                            $option_object->text->type = 'plain_text');
    }

    /**
     * Set the text.
     * Max length of 75 characters.
     *
     * @param string $text
     * @param bool $markdown
     * @return $this
     */
    public function text(string $text, bool $markdown = false)
    {
        $this->text = new Text($markdown ? Text::Markdown : Text::Plain, substr($text,0,75));
        return $this;
    }

    /**
     * Set the value.
     * Max length of 75 characters.
     *
     * @param string $value
     * @return $this
     */
    public function value(string $value)
    {
        $this->value = substr($value,0,75);
        return $this;
    }

    /**
     * Set the description.
     * Max length of 75 characters.
     *
     * @param string $description
     * @return $this
     */
    public function description(string $description)
    {
        $this->description = new Text(Text::Plain, substr($description,0,75));
        return $this;
    }

    /**
     * Set the url.
     * Max length of 3000 characters.
     *
     * @param string $url
     * @return $this
     */
    public function url(string $url)
    {
        $this->url = substr($url,0,3000);
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
