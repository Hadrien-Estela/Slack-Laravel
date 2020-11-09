<?php

namespace Slack\Objects\Blocks;

/**
 * A content divider, like an <hr>, to split up different blocks inside of a message.
 *
 * https://api.slack.com/reference/block-kit/blocks#divider
 */
class DividerBlock extends Block
{

    /**
     * Build a new instance.
     */
    public function __construct()
    {
        parent::__construct(Block::Divider);
    }

}
