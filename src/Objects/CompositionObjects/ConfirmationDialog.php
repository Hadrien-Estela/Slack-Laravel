<?php

namespace Slack\Objects\CompositionObjects;

use JsonSerializable;
use Slack\Objects\CompositionObjects\Text;

class ConfirmationDialog implements JsonSerializable
{

    /**
     * A plain_text-only text object that defines the dialog's title.
     *
     * @var Slack\Objects\CompositionObjects\Text
     */
    private $title;

    /**
     * A text object that defines the explanatory text that appears in the confirm dialog.
     *
     * @var Slack\Objects\CompositionObjects\Text
     */
    private $text;

    /**
     * A plain_text-only text object to define the text of the button that confirms the action.
     *
     * @var Slack\Objects\CompositionObjects\Text
     */
    private $confirm;

    /**
     * A plain_text-only text object to define the text of the button that cancels the action.
     *
     * @var Slack\Objects\CompositionObjects\Text
     */
    private $deny;

    /**
     * Defines the color scheme applied to the confirm button.
     *
     * @var string
     */
    private $style;

    /**
     * Build a new Instance
     *
     * @param string $title     The dialog title
     * @param string $text      The dialog text
     * @param string $markdown  Should use markdown for the text
     * @param string $confirm   The confirm button text
     * @param string $deny      The deny button text
     */
    public function __construct(string $title = 'Confirm',
                            string $text = 'Are you sure ?',
                            bool $markdown = false,
                            string $confirm = 'Confirm',
                            string $deny = 'Deny')
    {
        $this->title = new Text(Text::Plain, $title);
        $this->text = new Text($markdown ? Text::Markdown : Text::Plain, $text);
        $this->confirm = new Text(Text::Plain, $confirm);
        $this->deny = new Text(Text::Plain, $deny);
    }

    /**
     * Set the confirm dialog title.
     *
     * @param  string $title
     * @return \Slack\Objects\CompositionObjects\ConfirmationDialog
     */
    public function title(string $title)
    {
        $this->title->text($title);
        return $this;
    }

    /**
     * Set the confirm dialog text.
     *
     * @param  string $title
     * @return \Slack\Objects\CompositionObjects\ConfirmationDialog
     */
    public function text(string $text, bool $markdown = false)
    {
        $this->text = new Text($markdown ? Text::Markdown : Text::Plain, $text);
        return $this;
    }

    /**
     * Set the `confirm` button text.
     *
     * @param  string $title
     * @return \Slack\Objects\CompositionObjects\ConfirmationDialog
     */
    public function confirm(string $confirm)
    {
        $this->confirm->text($confirm);
        return $this;
    }

    /**
     * Set the `deny` button text.
     *
     * @param  string $title
     * @return \Slack\Objects\CompositionObjects\ConfirmationDialog
     */
    public function deny(string $deny)
    {
        $this->deny->text($deny);
        return $this;
    }

    /**
     * Set confirm button style to `primary`
     *
     * @return \Slack\Objects\CompositionObjects\ConfirmationDialog
     */
    public function primary()
    {
        $this->style = 'primary';
        return $this;
    }

    /**
     * Set confirm button style to `danger`
     *
     * @return \Slack\Objects\CompositionObjects\ConfirmationDialog
     */
    public function danger()
    {
        $this->style = 'danger';
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
            'title' => $this->title,
            'text' => $this->text,
            'confirm' => $this->confirm,
            'deny' => $this->deny
        ], array_filter([
            'style' => $this->style
        ], function($val) {
            return !empty($val);
        }));
    }

}
