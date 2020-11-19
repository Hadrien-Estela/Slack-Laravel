<?php

namespace Slack\Objects\Blocks;

/**
 * A content divider, like an <hr>, to split up different blocks inside of a message.
 * @link(https://api.slack.com/reference/block-kit/blocks#divider, more)
 *
 * @package Slack\Objects\Blocks
 */
class DividerBlock extends Block
{

    /**
     * DividerBlock constructor.
     */
    public function __construct()
    {
        parent::__construct(Block::Divider);
    }

}
