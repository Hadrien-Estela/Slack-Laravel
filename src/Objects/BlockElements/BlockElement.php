<?php

namespace Slack\Objects\BlockElements;

use JsonSerializable;

/**
 * Base class for block Elements.
 * @link(https://api.slack.com/reference/block-kit/block-elements, more)
 *
 * @package Slack\Objects\BlockElements
 */
abstract class BlockElement implements JsonSerializable
{

    protected const Image = 'image';

    /**
     * The type of element.
     *
     * @var string
     */
    private $type;

    /**
     * BlockElement constructor.
     *
     * @param string $type
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
