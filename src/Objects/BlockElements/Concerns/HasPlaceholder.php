<?php

namespace Slack\Objects\BlockElements\Concerns;

use Slack\Objects\CompositionObjects\Text;

trait HasPlaceholder
{

    /**
     * A plain_text only text object that defines the placeholder text.
     *
     * @varText|null
     */
    private $placeholder;

    /**
     * Set the placeholder.
     *
     * @param  string $text
     * @return BlockElement
     */
    public function placeholder(string $placeholder)
    {
        $this->placeholder = new Text(Text::Plain, $placeholder);
        return $this;
    }

}
