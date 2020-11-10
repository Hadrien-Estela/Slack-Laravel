<?php

namespace Slack\Factories;

use Slack\Objects\SlackView;

/**
 * https://api.slack.com/surfaces/modals/using#response_actions
 */
class ResponseActionFactory
{

    public function update(SlackView $view)
    {
        return response()->json([
            'response_action' => 'update',
            'view' => $view
        ]);
    }

    public function push(SlackView $view)
    {
        return response()->json([
            'response_action' => 'push',
            'view' => $view
        ]);
    }

    public function clear()
    {
        return response()->json([
            'response_action' => 'clear'
        ]);
    }

    public function errors(array $errors)
    {
        return response()->json([
            'response_action' => 'errors',
            'errors' => $view
        ]);
    }

    public function options(array $options)
    {
        return response()->json([
            'options' => $options
        ]);
    }

}
