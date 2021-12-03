<?php

namespace Slack\Laravel\Objects\Blocks;

use JsonSerializable;

/**
 * Blocks are a series of components that can be combined to create
 * visually rich and compellingly interactive messages.
 * @link(https://api.slack.com/reference/block-kit/blocks, more)
 *
 * @package Slack\Laravel\Objects\Blocks
 */
abstract class Block implements JsonSerializable
{

    /**
     * Types of block.
     */
    protected const Actions = 'actions';
    protected const Context = 'context';
    protected const Divider = 'divider';
    protected const File = 'file';
    protected const Header = 'header';
    protected const Image = 'image';
    protected const Input = 'input';
    protected const Section = 'section';

    /**
     * The type of block.
     *
     * @var string
     */
    private $type;

    /**
     * A string acting as a unique identifier for a block.
     * If not specified, one will be generated.
     * Max length of 255 characters.
     *
     * @var string
     */
    private $id;

    /**
     * Block constructor.
     *
     * @param string $type
     */
    protected function __construct(string $type)
    {
        $this->type = $type;
    }

    /**
     * Set the block id.
     * Max length of 255 characters.
     *
     * @param string $id
     * @return $this
     */
    public function id(string $id)
    {
        $this->id = substr($id,0,255);
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
