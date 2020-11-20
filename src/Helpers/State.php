<?php

namespace Slack\Helpers;

use Illuminate\Support\Traits\Macroable;
use Exception;

/**
 * Helper for `state` object interaction payload.
 */
class State
{

    use Macroable;

    /**
     * Find a block by ID in the state payload.
     *
     * @param Object $state
     * @param string $block_id
     * @return Object|null
     */
    public static function block(Object $state, string $block_id)
    {
        try
        {
            return $state->values->$block_id;
        }
        catch (Exception $e)
        {
            return null;
        }
    }

    /**
     * Find an action by ID in the state payload.
     *
     * @param Object $state
     * @param string $action_id
     * @return Object|null
     */
    public static function action(Object $state, string $action_id)
    {
        if (!isset($state->values))
            return null;

        foreach ($state->values as $block_id => $block_value)
            foreach ($block_value as $id => $value)
                if ($id == $action_id)
                    return $value;
    }

    /**
     * Get the array of actions in the state payload
     *
     * @param Object $state
     * @return array
     */
    public static function actions(Object $state)
    {
        $values = array();
        foreach ($state->values as $block_id => $block_value)
            foreach ($block_value as $action_id => $action_value)
                $values[$action_id] = $action_value;
        return $values;
    }

    /**
     * Get the default (first) action of a block.
     *
     * @param Object $state
     * @param string $block_id
     * @return Object|null
     */
    public static function defaultAction(Object $state, string $block_id)
    {
        try
        {
            $block = $state->values->$block_id;
            foreach ($block as $action)
                return $action;
        }
        catch (Exception $e)
        {
            return null;
        }
    }

}
