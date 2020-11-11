<?php

namespace Slack\Objects\BlockElements;

use JsonSerializable;

/**
 * Base class for block Elements.
 *
 * @link(https://api.slack.com/reference/block-kit/block-elements, more)
 */
abstract class BlockElement implements JsonSerializable
{

    /**
     * Types of available elements
     */
    const Image = 'image';

    /**
     * The type of element.
     *
     * @var string
     */
    private $type;

    /**
     * Build a new instance.
     *
     * @param string $type The element's type.
     */
    public function __construct(string $type)
    {
        $this->type = $type;
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'type' => $this->type,
        ];
    }

}
