<?php

namespace Slack\Helpers;

use Illuminate\Support\Traits\Macroable;
use Slack\Objects\SlackView;

class View
{
    use Macroable;

    /**
     * Get a value of submitted view by its block id.
     *
     * @param  Object $view
     * @param  string $id
     * @return mixed
     */
    public static function value($view, string $id)
    {
        // Get the block by its ID i exists
        if (!isset($view->state->values->$id))
            return;

        $block = $view->state->values->$id;

        // Get the block action (Always contains a single entry)
        foreach ($block as $key => $value)
            return $value->value;
    }

    /**
     * Get all values of inputs contained in a submitted view.
     *
     * @param  Object $view
     * @return array
     */
    public static function values($view)
    {
        $values = array();

        foreach ($view->state->values as $key => $value)
        {
            foreach ($value as $action_id => $content)
                $values[$key] = $content->value;
        }
        return $values;
    }

    /**
     * Get the data contained in a submitted view
     *
     * @param  Object $view
     * @return array
     */
    public static function metadata($view)
    {
        if (empty($view->private_metadata))
            return array();

        return json_decode($view->private_metadata, true);
    }

    /**
     * Copy the metadata of a submitted view to a new View.
     *
     * @param  Object                       $src_view
     * @param  \Slack\Objects\SlackView $dst_view
     * @return array
     */
    public static function copy_metadata($src_view, SlackView &$dst_view)
    {
        $dst_view->metadata($src_view->private_metadata);
    }
}
