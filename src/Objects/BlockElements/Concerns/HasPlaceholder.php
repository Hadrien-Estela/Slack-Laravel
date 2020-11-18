<?php /** @noinspection PhpPrivateFieldCanBeLocalVariableInspection */

namespace Slack\Objects\BlockElements\Concerns;

use Slack\Objects\CompositionObjects\Text;

/**
 * Trait for Block elements with `placeholder` attribute.
 */
trait HasPlaceholder
{

    /**
     * A plain_text only text object that defines the placeholder text.
     * Max length of 150 characters.
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
        $this->placeholder = new Text(Text::Plain,substr($placeholder,0,150));
        return $this;
    }

}
