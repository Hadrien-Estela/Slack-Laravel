<?php

namespace Slack\Objects\BlockElements;

use Slack\Objects\BlockElements\Concerns;
use Slack\Objects\CompositionObjects\Text;
use Slack\Objects\CompositionObjects\ConfirmationDialog;

/**
 * An interactive component that inserts a button. The button can be a trigger
 * for anything from opening a simple link to starting a complex workflow.
 *
 * @link(https://api.slack.com/reference/block-kit/block-elements#button, more)
 */
class Button extends InteractiveBlockElement
{

    use Concerns\HasConfirm;

    /**
     * A text object that defines the button's text.
     * Max length of 75 characters.
     *
     * @var Text
     */
    private $text;

    /**
     * A URL to load in the user's browser when the button is clicked.
     * Max length of 3000 characters.
     *
     * @var string|null
     */
    private $url;

    /**
     * The value to send along with the interaction payload.
     * Max length of 2000 characters.
     *
     * @var string|null
     */
    private $value;

    /**
     * Decorates buttons with alternative visual color schemes.
     *
     * @var string|null
     */
    private $style;

    /**
     * Build a new instance.
     *
     * @param string                  $action_id [description]
     * @param string                  $text      [description]
     * @param string|null             $value     [description]
     * @param string|null             $url       [description]
     * @param ConfirmationDialog|null $confirm   [description]
     */
    public function __construct(string $action_id,
                                string $text = 'Button',
                                string $value = null,
                                string $url = null,
                                ConfirmationDialog $confirm = null)
    {
        parent::__construct(InteractiveBlockElement::Button, $action_id);
        $this->text = new Text(Text::Plain, substr($text,0,75));
        $this->value = substr($value,0,3000);
        $this->url = substr($url,0,2000);
        $this->confirm = $confirm;
    }

    /**
     * Set the button's text.
     * Max length of 75 characters.
     *
     * @param  string $text
     * @return Button
     */
    public function text(string $text)
    {
        $this->text->text(substr($text,0,75));
        return $this;
    }

    /**
     * Set the Url to open on click.
     * Max length of 3000 characters.
     *
     * @param  string $url
     * @return Button
     */
    public function url(string $url)
    {
        $this->url = substr($url,0,3000);
        return $this;
    }

    /**
     * Set the value of the Button.
     * Max length of 2000 characters.
     *
     * @param  string $value
     * @return Button
     */
    public function value(string $value)
    {
        $this->value = substr($value,0,2000);
        return $this;
    }

    /**
     * Set button style to `primary`
     *
     * @return Button
     */
    public function primary()
    {
        $this->style = 'primary';
        return $this;
    }

    /**
     * Set button style to `danger`
     *
     * @return Button
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
        return array_merge(parent::jsonSerialize(), [
            'text' => $this->text
        ], array_filter([
            'url' => $this->url,
            'value' => $this->value,
            'style' => $this->style,
            'confirm' => $this->confirm
        ], function($val) {
            return !empty($val);
        }));
    }

}
