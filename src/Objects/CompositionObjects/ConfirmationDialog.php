<?php

namespace Slack\Laravel\Objects\CompositionObjects;

use JsonSerializable;

/**
 * An object that defines a dialog that provides a confirmation step to any interactive element.
 * This dialog will ask the user to confirm their action by offering a confirm and deny buttons.
 * @link(https://api.slack.com/reference/block-kit/composition-objects#confirm, more)
 *
 * @package Slack\Laravel\Objects\CompositionObjects
 */
class ConfirmationDialog implements JsonSerializable
{

    /**
     * A plain_text-only text object that defines the dialog's title.
     * Max length of 100 characters.
     *
     * @var \Slack\Laravel\Objects\CompositionObjects\Text
     */
    private $title;

    /**
     * A text object that defines the explanatory text that appears in the confirm dialog.
     * Max length of 300 characters.
     *
     * @var \Slack\Laravel\Objects\CompositionObjects\Text
     */
    private $text;

    /**
     * A plain_text-only text object to define the text of the button that confirms the action.
     * Max length of 30 characters.
     *
     * @var \Slack\Laravel\Objects\CompositionObjects\Text
     */
    private $confirm;

    /**
     * A plain_text-only text object to define the text of the button that cancels the action.
     * Max length of 30 characters.
     *
     * @var \Slack\Laravel\Objects\CompositionObjects\Text
     */
    private $deny;

    /**
     * Defines the color scheme applied to the confirm button.
     *
     * @var string
     */
    private $style;

    /**
     * ConfirmationDialog constructor.
     *
     * @param string $title
     * @param string $text
     * @param bool $markdown
     * @param string $confirm
     * @param string $deny
     */
    public function __construct(string $title = 'Confirm',
                            string $text = 'Are you sure ?',
                            bool $markdown = false,
                            string $confirm = 'Confirm',
                            string $deny = 'Deny')
    {
        $this->title = new Text(Text::Plain, substr($title, 0,100));
        $this->text = new Text($markdown ? Text::Markdown : Text::Plain, substr($text, 0,300));
        $this->confirm = new Text(Text::Plain, substr($confirm, 0,30));
        $this->deny = new Text(Text::Plain, substr($deny, 0,30));
    }

    /**
     * Set the confirm dialog title.
     * Max length of 100 characters.
     *
     * @param  string $title
     * @return ConfirmationDialog
     */
    public function title(string $title)
    {
        $this->title->text(substr($title, 0,100));
        return $this;
    }

    /**
     * Set the confirm dialog text.
     * Max length of 300 characters.
     *
     * @param  string $text
     * @param boolean $markdown
     * @return ConfirmationDialog
     */
    public function text(string $text, bool $markdown = false)
    {
        $this->text = new Text($markdown ? Text::Markdown : Text::Plain, substr($text, 0,300));
        return $this;
    }

    /**
     * Set the `confirm` button text.
     * Max length of 30  characters.
     *
     * @param  string $label
     * @return ConfirmationDialog
     */
    public function confirm(string $label)
    {
        $this->confirm->text(substr($label, 0,30));
        return $this;
    }

    /**
     * Set the `deny` button text.
     * Max length of 30 characters.
     *
     * @param  string $label
     * @return ConfirmationDialog
     */
    public function deny(string $label)
    {
        $this->deny->text(substr($label, 0,30));
        return $this;
    }

    /**
     * Set confirm button style to `primary`.
     *
     * @return ConfirmationDialog
     */
    public function primary()
    {
        $this->style = 'primary';
        return $this;
    }

    /**
     * Set confirm button style to `danger`.
     *
     * @return ConfirmationDialog
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
