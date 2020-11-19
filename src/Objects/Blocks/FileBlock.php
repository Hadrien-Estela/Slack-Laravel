<?php

namespace Slack\Objects\Blocks;

/**
 * Displays a remote file. You can't add this block to app surfaces directly,
 * but it will show up when retrieving messages that contain remote files.
 * @link(https://api.slack.com/reference/block-kit/blocks#file, more)
 *
 * @package Slack\Objects\Blocks
 */
class FileBlock extends Block
{

    /**
     * The external unique ID for this file.
     *
     * @var string
     */
    private $external_id;

    /**
     * At the moment, source will always be remote for a remote file.
     *
     * @var string
     */
    private $source = 'remote';

    /**
     * FileBlock constructor.
     *
     * @param string $file_id
     */
    public function __construct(string $file_id)
    {
        parent::__construct(Block::Header);
        $this->external_id = $file_id;
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return array_merge(parent::jsonSerialize(), [
            'external_id' => $this->external_id,
            'source' => $this->source
        ]);
    }

}
