<?php

namespace Slack\Objects\Blocks;

use JsonSerializable;

/**
 * Blocks are a series of components that can be combined to create
 * visually rich and compellingly interactive messages.
 *
 * https://api.slack.com/reference/block-kit/blocks
 */
abstract class Block implements JsonSerializable
{

    /**
     * Types of block.
     */
    const Actions = 'actions';
    const Context = 'context';
    const Divider = 'divider';
    const File = 'file';
    const Header = 'header';
    const Image = 'image';
    const Input = 'input';
    const Section = 'section';

    /**
     * The type of block.
     *
     * @var string
     */
    private $type;

    /**
     * A string acting as a unique identifier for a block.
     * If not specified, one will be generated. Maximum length for this field is 255 characters.
     *
     * @var string
     */
    private $id;

    /**
     * Build a new block instance.
     *
     * @param string $type The type of block.
     */
    public function __construct(string $type)
    {
        $this->type = $type;
    }

    /**
     * Set the blosk id
     *
     * @param  string $id
     * @return \Slack\Objects\Blocks\Block
     */
    public function id(string $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_filter([
            'type' => $this->type,
            'block_id' => $this->id
        ], function($val) {
            return !empty($val);
        });
    }

}
