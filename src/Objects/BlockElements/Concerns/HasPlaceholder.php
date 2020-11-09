<?php

namespace Slack\Objects\BlockElements\Concerns;

use Slack\Objects\CompositionObjects\Text;

trait HasPlaceholder
{

    /**
     * A plain_text only text object that defines the placeholder text.
     *
     * @var \Slack\Objects\CompositionObjects\Text|null
     */
    private $placeholder;

    /**
     * Set the placeholder.
     *
     * @param  string $text
     * @return \Slack\Objects\BlockElements\BlockElement
     */
    public function placeholder(string $placeholder)
    {
        $this->placeholder = new Text(Text::Plain, $placeholder);
        return $this;
    }

}
