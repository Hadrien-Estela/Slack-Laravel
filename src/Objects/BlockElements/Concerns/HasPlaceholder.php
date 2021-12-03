<?php

namespace Slack\Laravel\Objects\BlockElements\Concerns;

use Slack\Laravel\Objects\CompositionObjects\Text;

/**
 * Trait for Block elements with `placeholder` attribute.
 *
 * @package Slack\Laravel\Objects\BlockElements\Concerns
 */
trait HasPlaceholder
{

    /**
     * A plain_text only text object that defines the placeholder text.
     * Max length of 150 characters.
     *
     * @var \Slack\Laravel\Objects\CompositionObjects\Text|null
     */
    private $placeholder;

    /**
     * Set the placeholder.
     *
     * @param string $placeholder
     * @return $this
     */
    public function placeholder(string $placeholder)
    {
        $this->placeholder = new Text(Text::Plain,substr($placeholder,0,150));
        return $this;
    }

}
