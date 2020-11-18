<?php

namespace Slack\Factories;

use Slack\Objects\SlackView;

/**
 * Build a response action to a slack interaction request.
 * https://api.slack.com/surfaces/modals/using#response_actions
 */
class ResponseActionFactory
{

    /**
     * Update view action.
     *
     * @param  SlackView $view The content view to send as update.
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SlackView $view)
    {
        return response()->json([
            'response_action' => 'update',
            'view' => $view
        ]);
    }

    /**
     * Push view action.
     *
     * @param  SlackView $view The content to push
     * @return \Illuminate\Http\JsonResponse
     */
    public function push(SlackView $view)
    {
        return response()->json([
            'response_action' => 'push',
            'view' => $view
        ]);
    }

    /**
     * clear views action.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function clear()
    {
        return response()->json([
            'response_action' => 'clear'
        ]);
    }

    /**
     * Errors action.
     *
     * @param  array $errors The key value pair of errors to return.
     * @return \Illuminate\Http\JsonResponse
     */
    public function errors(array $errors)
    {
        return response()->json([
            'response_action' => 'errors',
            'errors' => $errors
        ]);
    }

    /**
     * Suggestion options response.
     *
     * @param  Option[] $options The suggestions to return.
     * @return \Illuminate\Http\JsonResponse
     */
    public function options(array $options)
    {
        return response()->json([
            'options' => $options
        ]);
    }

}
