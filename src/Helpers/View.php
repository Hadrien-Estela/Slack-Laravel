<?php

namespace Slack\Helpers;

use Slack\Objects\SlackView;

/**
 * Class View
 *
 * @package Slack\Helpers
 */
class View
{
    /**
     * Get the data contained in a submitted view.
     *
     * @param Object $view
     * @return array
     */
    public static function metadata(Object $view)
    {
        if (empty($view->private_metadata))
            return array();

        return json_decode($view->private_metadata, true);
    }

    /**
     * Copy the metadata of a submitted view to a new View.
     *
     * @param Object $src_view
     * @param \Slack\Objects\SlackView $dst_view
     */
    public static function copy_metadata(Object $src_view, SlackView $dst_view)
    {
        $dst_view->metadata($src_view->private_metadata);
    }

    /**
     * Encode the metadata payload for a view.
     *
     * @param \Slack\Objects\SlackView $view
     * @param array $data
     */
    public static function encode_metadata(SlackView $view, array $data)
    {
        $view->metadata(json_encode($data));
    }
}
