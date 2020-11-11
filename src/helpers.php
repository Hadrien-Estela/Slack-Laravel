<?php

use Slack\Factories\ResponseActionFactory;

if (! function_exists('slack_response_action'))
{
    /**
     * Return a new ResponseAction.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    function slack_response_action()
    {
        return app(ResponseActionFactory::class);
    }
}
